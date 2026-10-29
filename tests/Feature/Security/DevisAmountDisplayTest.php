<?php

namespace Tests\Feature\Security;

use App\Models\Service;
use App\Services\PaymentAmountResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The devis page must display the EXACT amount that will be charged, and that
 * amount is the chosen service price. In production the page showed the service
 * price (e.g. 1 000 for "Elite") while the gateway billed a flat 50 000 — the
 * fee now follows the service price, so display == charge for every service.
 */
class DevisAmountDisplayTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function servicePriced(string $label, string $price): Service
    {
        $service = new Service();
        $service->label = $label;
        $service->description = 'd';
        $service->price = $price;
        $service->picture = 'p.png';
        $service->user_id = 1;
        $service->status = STATUT_ENABLE;
        $service->save();

        return $service;
    }

    public function test_devis_page_and_charge_both_use_the_service_price(): void
    {
        // A flat config fee is set but must be ignored in favour of the service price.
        config(['services.payment.quote_amount' => 50000]);

        $service = $this->servicePriced('Elite', '1000');
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner, $service);

        $this->actingAs($owner)
            ->get('/quote/payment/' . $quote->id)
            ->assertOk()
            ->assertSee('Payer 1 000 XAF')      // what the client sees
            ->assertDontSee('Payer 50 000 XAF'); // not the old flat fee

        // ...and it is exactly what the gateway + webhook will use.
        $this->assertSame(1000.0, PaymentAmountResolver::for('quote', $quote));
    }

    public function test_a_different_service_charges_its_own_price(): void
    {
        $service = $this->servicePriced('Évacuation', '150000');
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner, $service);

        $this->assertSame(150000.0, PaymentAmountResolver::for('quote', $quote));
        $this->actingAs($owner)
            ->get('/quote/payment/' . $quote->id)
            ->assertOk()
            ->assertSee('Payer 150 000 XAF');
    }
}
