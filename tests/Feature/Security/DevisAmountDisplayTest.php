<?php

namespace Tests\Feature\Security;

use App\Models\Service;
use App\Services\PaymentAmountResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The devis page must display the EXACT amount that will be charged (the quote
 * flat fee resolved by PaymentAmountResolver), never the service price. In
 * production the page showed 1 000 (service "Elite") while Singpay billed 50 000
 * (the flat quote fee) — display and charge must agree.
 */
class DevisAmountDisplayTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_devis_page_shows_the_charged_amount_not_the_service_price(): void
    {
        config(['services.payment.quote_amount' => 50000]);

        // A service priced very differently from the flat quote fee.
        $service = new Service();
        $service->label = 'Elite';
        $service->description = 'd';
        $service->price = '1000';
        $service->picture = 'p.png';
        $service->user_id = 1;
        $service->status = STATUT_ENABLE;
        $service->save();

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner, $service);

        $response = $this->actingAs($owner)->get('/quote/payment/' . $quote->id)->assertOk();

        // Shows the charged amount (50 000), and the Payer button matches.
        $response->assertSee('Payer 50 000 XAF');
        $response->assertDontSee('Payer 1 000 XAF');

        // And the displayed amount equals what the gateway + webhook will use.
        $this->assertSame(50000.0, PaymentAmountResolver::for('quote', $quote));
    }
}
