<?php

namespace Tests\Feature\Simulator;

use App\Models\Country;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Simulator;
use App\Models\SimulatorItem;
use App\Services\SimulationEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

/**
 * The admin can now set the structured pricing (unit_price, quantity, category,
 * optional/estimate) on catalog rows through the UI — no SQL — and it drives the
 * engine's total.
 */
class AdminTariffTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function refs(): array
    {
        $service = new Service();
        $service->label = 'Évacuation'; $service->description = 'd'; $service->price = '150000';
        $service->picture = 'p.png'; $service->user_id = 1; $service->status = STATUT_ENABLE; $service->save();

        $country = new Country();
        $country->label = 'Israël'; $country->code = 'IL'; $country->flag = 'f.png';
        $country->status = STATUT_ENABLE; $country->user_id = 1; $country->save();

        $sick = new Sick();
        $sick->label = 'Cardiologie'; $sick->description = 'd';
        $sick->status = (string) STATUT_SIMULATOR; $sick->user_id = 1; $sick->save();

        $item = SimulatorItem::create(['label' => 'Hébergement', 'status' => STATUT_ENABLE]);

        return compact('service', 'country', 'sick', 'item');
    }

    public function test_admin_creates_a_priced_catalog_row(): void
    {
        ['service' => $s, 'country' => $c, 'sick' => $k, 'item' => $i] = $this->refs();

        $this->actingAs($this->makeAdmin())
            ->post('/admin/simulator', [
                'country_id' => $c->id, 'service_id' => $s->id, 'sick_id' => $k->id, 'item_id' => $i->id,
                'unit_price' => 60000, 'quantity' => 5, 'category' => 'Séjour', 'is_estimate' => '1',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('simulators', [
            'service_id' => $s->id, 'unit_price' => 60000, 'quantity' => 5, 'category' => 'Séjour',
            'is_optional' => false, 'is_estimate' => true,
        ]);

        // The engine picks it up: 5 x 60000 = 300000.
        $simulation = (new SimulationEngine())->run($s->id, $c->id, $k->id);
        $this->assertSame('300000.00', (string) $simulation->total);
    }

    public function test_admin_edits_the_unit_price(): void
    {
        ['service' => $s, 'country' => $c, 'sick' => $k, 'item' => $i] = $this->refs();
        $row = new Simulator();
        $row->value = ''; $row->simulator_item_id = $i->id; $row->service_id = $s->id;
        $row->country_id = $c->id; $row->sick_id = $k->id; $row->user_id = 1; $row->status = STATUT_ENABLE;
        $row->unit_price = 60000; $row->quantity = 1; $row->save();

        $this->actingAs($this->makeAdmin())
            ->post('/admin/simulator/' . $row->id, [
                'country_id' => $c->id, 'service_id' => $s->id, 'sick_id' => $k->id, 'item_id' => $i->id,
                'unit_price' => 80000, 'quantity' => 2, 'category' => 'Séjour', 'is_optional' => '1',
            ])
            ->assertRedirect();

        $row->refresh();
        $this->assertSame('80000.00', (string) $row->unit_price);
        $this->assertSame('2.00', (string) $row->quantity);
        $this->assertTrue($row->is_optional);
    }

    public function test_a_non_numeric_unit_price_is_rejected(): void
    {
        ['service' => $s, 'country' => $c, 'sick' => $k, 'item' => $i] = $this->refs();

        $this->actingAs($this->makeAdmin())
            ->post('/admin/simulator', [
                'country_id' => $c->id, 'service_id' => $s->id, 'sick_id' => $k->id, 'item_id' => $i->id,
                'unit_price' => 'gratuit',
            ])
            ->assertSessionHasErrors('unit_price');

        $this->assertSame(0, Simulator::count());
    }
}
