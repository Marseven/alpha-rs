<?php

namespace Tests\Feature\Simulator;

use App\Models\Simulation;
use App\Models\Simulator;
use App\Models\SimulatorItem;
use App\Services\SimulationEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * P2-b engine: total = sum of the mandatory lines (quantity x unit price),
 * optional postes excluded from the headline total, legacy free-text values
 * still contribute, and the result is persisted with a reference.
 */
class SimulationEngineTest extends TestCase
{
    use RefreshDatabase;

    private function catalogRow(array $attrs): Simulator
    {
        $item = SimulatorItem::create(['label' => $attrs['label'] ?? 'Poste', 'status' => STATUT_ENABLE]);

        $row = new Simulator();
        $row->value = $attrs['value'] ?? '';
        $row->note = null;
        $row->simulator_item_id = $item->id;
        $row->service_id = $attrs['service_id'] ?? 1;
        $row->country_id = $attrs['country_id'] ?? 2;
        $row->sick_id = $attrs['sick_id'] ?? 3;
        $row->user_id = 1;
        $row->status = $attrs['status'] ?? STATUT_ENABLE;
        $row->unit_price = $attrs['unit_price'] ?? null;
        $row->quantity = $attrs['quantity'] ?? 1;
        $row->category = $attrs['category'] ?? null;
        $row->is_optional = $attrs['is_optional'] ?? false;
        $row->is_estimate = $attrs['is_estimate'] ?? true;
        $row->save();

        return $row;
    }

    public function test_total_is_the_sum_of_mandatory_lines(): void
    {
        $this->catalogRow(['label' => 'Consultation', 'unit_price' => 50000, 'category' => 'Médical']);
        $this->catalogRow(['label' => 'Hébergement', 'unit_price' => 60000, 'quantity' => 5, 'category' => 'Séjour']); // 300000
        $this->catalogRow(['label' => 'Assurance', 'unit_price' => 25000, 'is_optional' => true]);

        $simulation = (new SimulationEngine())->run(1, 2, 3);

        // 50000 + (5 x 60000) = 350000, the optional 25000 excluded.
        $this->assertSame('350000.00', (string) $simulation->total);
        $this->assertCount(3, $simulation->lines);

        $hebergement = $simulation->lines->firstWhere('label', 'Hébergement');
        $this->assertSame('300000.00', (string) $hebergement->amount);
        $this->assertSame('5.00', (string) $hebergement->quantity);
    }

    public function test_the_result_is_persisted_with_a_reference(): void
    {
        $this->catalogRow(['label' => 'Consultation', 'unit_price' => 40000]);

        $simulation = (new SimulationEngine())->run(1, 2, 3);

        $this->assertStringStartsWith('SIM-', $simulation->reference);
        $this->assertDatabaseHas('simulations', ['reference' => $simulation->reference, 'total' => 40000]);
        $this->assertDatabaseHas('simulation_lines', ['simulation_id' => $simulation->id, 'label' => 'Consultation']);
    }

    public function test_legacy_free_text_value_still_contributes_to_the_total(): void
    {
        // No structured unit_price; only the legacy string.
        $this->catalogRow(['label' => 'Transport', 'unit_price' => null, 'value' => '100 000 FCFA']);

        $simulation = (new SimulationEngine())->run(1, 2, 3);

        $this->assertSame('100000.00', (string) $simulation->total);
    }

    public function test_disabled_catalog_rows_are_ignored(): void
    {
        $this->catalogRow(['label' => 'Actif', 'unit_price' => 50000, 'status' => STATUT_ENABLE]);
        $this->catalogRow(['label' => 'Désactivé', 'unit_price' => 999999, 'status' => STATUT_DISABLE]);

        $simulation = (new SimulationEngine())->run(1, 2, 3);

        $this->assertSame('50000.00', (string) $simulation->total);
        $this->assertCount(1, $simulation->lines);
    }

    public function test_no_matching_tariff_yields_a_zero_total_and_no_lines(): void
    {
        $simulation = (new SimulationEngine())->run(99, 99, 99);

        $this->assertSame('0.00', (string) $simulation->total);
        $this->assertCount(0, $simulation->lines);
    }
}
