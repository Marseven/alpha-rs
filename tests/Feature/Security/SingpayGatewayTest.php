<?php

namespace Tests\Feature\Security;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Characterization tests for the outbound Singpay charge initiation.
 *
 * They pin the observable behaviour — redirect target on success, failure
 * branch, the folder path, and the exact request contract sent to the gateway
 * — BEFORE the logic is extracted into App\Services\Payments\SingpayGateway,
 * so the extraction is provably behaviour-preserving.
 */
class SingpayGatewayTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    /**
     * The gateway now refuses to call the PSP with missing credentials, so these
     * tests must describe a properly configured environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.singpay.base_url' => 'https://gateway.test/v1/ext',
            'services.singpay.client_id' => 'CID',
            'services.singpay.client_secret' => 'SECRET',
            'services.singpay.wallet_id' => 'WALLET',
        ]);
    }

    public function test_singpay_redirects_to_gateway_link_on_success(): void
    {
        config(['services.payment.quote_amount' => 50000]);
        Http::fake(['*' => Http::response(['link' => 'https://pay.example/redirect'], 200)]);

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)
            ->get('/quote/pay/' . $quote->id)
            ->assertRedirect('https://pay.example/redirect');
    }

    public function test_singpay_returns_error_when_gateway_response_is_null(): void
    {
        config(['services.payment.quote_amount' => 50000]);
        // Non-JSON body → json_decode() yields null → failure branch.
        Http::fake(['*' => Http::response('not-json', 200)]);

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)
            ->get('/quote/pay/' . $quote->id)
            ->assertRedirect()
            ->assertSessionHas('error');
    }

    public function test_singpay_folder_path_stores_pending_payment_and_charges_gateway(): void
    {
        Http::fake(['*' => Http::response(['link' => 'https://pay.example/f'], 200)]);

        $service = $this->makeService(); // price 50000
        $owner = $this->makeUser();
        $folder = $this->makeFolder($owner, $service);
        $folder->price = 2500;
        $folder->save();

        $this->actingAs($owner)->post('/folder/pay/' . $folder->id);

        Http::assertSent(fn ($request) => (float) $request['amount'] === 52500.0);
        $this->assertDatabaseHas('payments', [
            'folder_id' => $folder->id,
            'amount' => 52500,
            'status' => STATUT_PENDING,
            'customer_id' => $owner->id,
            'time_out' => 30,
        ]);
    }

    public function test_singpay_request_sends_expected_headers_and_payload(): void
    {
        config([
            'services.singpay.wallet_id' => 'WALLET',
            'services.singpay.client_id' => 'CID',
            'services.singpay.client_secret' => 'SECRET',
            'services.singpay.disbursement_wallet_id' => 'DISB',
            'services.payment.quote_amount' => 50000,
        ]);
        Http::fake(['*' => Http::response(['link' => 'https://pay.example/redirect'], 200)]);

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)->get('/quote/pay/' . $quote->id);

        Http::assertSent(function ($request) use ($quote) {
            $body = $request->data();

            return $request->hasHeader('x-wallet', 'WALLET')
                && $request->hasHeader('x-client-id', 'CID')
                && $request->hasHeader('x-client-secret', 'SECRET')
                && $body['portefeuille'] === 'WALLET'
                && $body['disbursement'] === 'DISB'
                && $body['client_msisdn'] === $quote->phone
                && $body['redirect_success'] === $body['redirect_error']
                && str_contains($body['redirect_success'], '/callback-singpay/quote/' . $quote->id . '/');
        });
    }

    public function test_singpay_stored_reference_matches_the_callback_url(): void
    {
        config(['services.payment.quote_amount' => 50000]);
        Http::fake(['*' => Http::response(['link' => 'https://pay.example/redirect'], 200)]);

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)->get('/quote/pay/' . $quote->id);

        $payment = Payment::where('quote_id', $quote->id)->firstOrFail();
        Http::assertSent(fn ($request) => str_contains($request->data()['redirect_success'], '/' . $payment->reference));
    }
}
