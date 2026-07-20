<?php

namespace Tests\Feature\Security;

use App\Http\Controllers\PaymentController;
use App\Services\PaymentAmountResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Payment amounts must be centralized and consistent across gateways so the
 * webhook amount-check (which compares the reported amount to the stored one)
 * cannot be bypassed by a per-gateway discrepancy.
 */
class PaymentAmountTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_quote_amount_comes_from_config(): void
    {
        config(['services.payment.quote_amount' => 50000]);
        $quote = $this->makeQuote($this->makeUser());

        $this->assertSame(50000.0, PaymentAmountResolver::forQuote($quote));
    }

    public function test_folder_amount_is_service_price_plus_folder_price(): void
    {
        $service = $this->makeService(); // price 50000
        $owner = $this->makeUser();
        $folder = $this->makeFolder($owner, $service);
        $folder->price = 2500;
        $folder->save();

        $this->assertSame(52500.0, PaymentAmountResolver::forFolder($folder));
    }

    public function test_singpay_stores_the_resolved_quote_amount(): void
    {
        config([
            'services.payment.quote_amount' => 50000,
            // The gateway refuses to call the PSP with missing credentials.
            'services.singpay.base_url' => 'https://gateway.test/v1/ext',
            'services.singpay.client_id' => 'CID',
            'services.singpay.client_secret' => 'SECRET',
            'services.singpay.wallet_id' => 'WALLET',
        ]);
        Http::fake([
            '*' => Http::response(['link' => 'https://pay.example/redirect'], 200),
        ]);

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)->get('/quote/pay/' . $quote->id);

        // The gateway was charged the same amount that we stored.
        Http::assertSent(fn ($request) => (float) $request['amount'] === 50000.0);
        $this->assertDatabaseHas('payments', [
            'quote_id' => $quote->id,
            'amount' => 50000,
        ]);
    }
}
