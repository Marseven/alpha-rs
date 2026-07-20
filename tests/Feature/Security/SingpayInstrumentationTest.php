<?php

namespace Tests\Feature\Security;

use App\Models\Payment;
use App\Services\Payments\SingpayGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Robustness of the Singpay charge initiation — the half of the payment problem
 * that does NOT depend on the (still unconfirmed) Singpay contract.
 *
 * Everything here is exercised with mocks: it proves the application handles
 * each gateway outcome correctly. It does NOT prove a real transaction works,
 * which still requires live credentials and a sandbox run.
 */
class SingpayInstrumentationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function configure(): void
    {
        config([
            'services.singpay.base_url' => 'https://gateway.test/v1/ext',
            'services.singpay.client_id' => 'CID',
            'services.singpay.client_secret' => 'SECRET',
            'services.singpay.wallet_id' => 'WALLET',
            'services.payment.quote_amount' => 50000,
        ]);
    }

    public function test_error_payload_with_http_error_is_not_treated_as_success(): void
    {
        $this->configure();
        // The old check was `json_decode($body) !== null`, so this decodable
        // error body counted as success and produced redirect(null).
        Http::fake(['*' => Http::response(['error' => 'unauthorized'], 401)]);

        $quote = $this->makeQuote($this->makeUser());
        $result = (new SingpayGateway())->initiate('quote', $quote);

        $this->assertFalse($result['ok']);
        $this->assertNull($result['link']);
        $this->assertSame('gateway', $result['reason']);
        $this->assertDatabaseCount('payments', 0);
    }

    public function test_http_200_without_a_link_is_not_treated_as_success(): void
    {
        $this->configure();
        Http::fake(['*' => Http::response(['status' => 'pending'], 200)]);

        $quote = $this->makeQuote($this->makeUser());
        $result = (new SingpayGateway())->initiate('quote', $quote);

        $this->assertFalse($result['ok']);
        $this->assertDatabaseCount('payments', 0);
    }

    public function test_missing_configuration_aborts_before_calling_the_gateway(): void
    {
        config([
            'services.singpay.base_url' => 'https://gateway.test/v1/ext',
            'services.singpay.client_id' => null,
            'services.singpay.client_secret' => null,
            'services.singpay.wallet_id' => null,
            'services.payment.quote_amount' => 50000,
        ]);
        Http::fake();

        $quote = $this->makeQuote($this->makeUser());
        $result = (new SingpayGateway())->initiate('quote', $quote);

        $this->assertFalse($result['ok']);
        $this->assertSame('configuration', $result['reason']);
        Http::assertNothingSent(); // never send null credentials to the PSP
    }

    public function test_network_failure_is_caught_and_reported(): void
    {
        $this->configure();
        Http::fake(fn () => throw new ConnectionException('Connection timed out'));

        $quote = $this->makeQuote($this->makeUser());
        $result = (new SingpayGateway())->initiate('quote', $quote);

        $this->assertFalse($result['ok']);
        $this->assertSame('transport', $result['reason']);
    }

    public function test_double_submission_reuses_the_pending_payment(): void
    {
        $this->configure();
        Http::fake(['*' => Http::response(['link' => 'https://pay.test/go'], 200)]);

        $quote = $this->makeQuote($this->makeUser());
        $gateway = new SingpayGateway();

        $first = $gateway->initiate('quote', $quote);
        $second = $gateway->initiate('quote', $quote);

        $this->assertTrue($first['ok']);
        $this->assertTrue($second['ok']);
        // One charge, one reference — a double click no longer opens two payments.
        $this->assertDatabaseCount('payments', 1);
        $this->assertSame(
            1,
            Payment::where('quote_id', $quote->id)->distinct()->count('reference'),
        );
    }

    public function test_successful_charge_stores_a_single_pending_payment(): void
    {
        $this->configure();
        Http::fake(['*' => Http::response(['link' => 'https://pay.test/go'], 200)]);

        $quote = $this->makeQuote($this->makeUser());
        $result = (new SingpayGateway())->initiate('quote', $quote);

        $this->assertTrue($result['ok']);
        $this->assertSame('https://pay.test/go', $result['link']);
        $this->assertDatabaseHas('payments', [
            'quote_id' => $quote->id,
            'amount' => 50000,
            'status' => STATUT_PENDING,
        ]);
    }
}
