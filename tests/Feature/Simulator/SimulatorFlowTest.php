<?php

namespace Tests\Feature\Simulator;

use App\Models\Country;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Simulation;
use App\Models\Simulator;
use App\Models\SimulatorItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * End-to-end public flow: POST /simulate computes + persists, then redirects to
 * a referenceable result page that shows the detailed breakdown and the total.
 */
class SimulatorFlowTest extends TestCase
{
    use RefreshDatabase;

    private function domain(): array
    {
        $service = new Service();
        $service->label = 'Évacuation sanitaire';
        $service->description = 'd';
        $service->price = '150000';
        $service->picture = 'p.png';
        $service->user_id = 1;
        $service->status = STATUT_ENABLE;
        $service->save();

        $country = new Country();
        $country->label = 'Israël';
        $country->code = 'IL';
        $country->flag = 'il.png';
        $country->status = STATUT_ENABLE;
        $country->user_id = 1;
        $country->save();

        $sick = new Sick();
        $sick->label = 'Cardiologie';
        $sick->description = 'd';
        $sick->status = (string) STATUT_SIMULATOR;
        $sick->user_id = 1;
        $sick->save();

        $item = SimulatorItem::create(['label' => 'Consultation spécialisée', 'status' => STATUT_ENABLE]);
        $row = new Simulator();
        $row->value = '';
        $row->simulator_item_id = $item->id;
        $row->service_id = $service->id;
        $row->country_id = $country->id;
        $row->sick_id = $sick->id;
        $row->user_id = 1;
        $row->status = STATUT_ENABLE;
        $row->unit_price = 50000;
        $row->quantity = 1;
        $row->category = 'Médical';
        $row->save();

        return compact('service', 'country', 'sick');
    }

    public function test_simulate_computes_persists_and_redirects_to_the_result(): void
    {
        ['service' => $service, 'country' => $country, 'sick' => $sick] = $this->domain();

        $response = $this->post('/simulate', [
            'service_id' => $service->id,
            'country_id' => $country->id,
            'sick_id' => $sick->id,
        ]);

        $this->assertSame(1, Simulation::count());
        $simulation = Simulation::first();
        $response->assertRedirect(route('simulation.show', $simulation->reference));
        $this->assertSame('50000.00', (string) $simulation->total);
    }

    public function test_result_page_shows_the_breakdown_and_total(): void
    {
        ['service' => $service, 'country' => $country, 'sick' => $sick] = $this->domain();

        $ref = $this->post('/simulate', [
            'service_id' => $service->id,
            'country_id' => $country->id,
            'sick_id' => $sick->id,
        ]);
        $simulation = Simulation::first();

        $this->get(route('simulation.show', $simulation->reference))
            ->assertOk()
            ->assertSee($simulation->reference)
            ->assertSee('Consultation spécialisée')
            ->assertSee('Estimation globale')
            ->assertSee('50 000'); // formatted total
    }

    public function test_an_owned_simulation_is_not_visible_to_another_user(): void
    {
        $owner = \App\Models\User::factory()->create();
        $simulation = Simulation::create(['user_id' => $owner->id, 'total' => 0]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('simulation.show', $simulation->reference))
            ->assertForbidden();
    }

    public function test_invalid_input_is_rejected(): void
    {
        $this->post('/simulate', ['service_id' => 999, 'country_id' => 999, 'sick_id' => 999])
            ->assertSessionHasErrors(['service_id', 'country_id', 'sick_id']);

        $this->assertSame(0, Simulation::count());
    }
}
