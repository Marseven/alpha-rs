<?php

namespace Tests\Feature\Simulator;

use App\Models\Simulation;
use App\Models\SimulationLine;
use App\Models\Simulator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * P2-a storage model: a Simulation header with SimulationLine breakdown, plus
 * the numeric pricing on the legacy Simulator catalog.
 */
class SimulationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_simulation_gets_a_unique_non_sequential_reference(): void
    {
        $a = Simulation::create(['total' => 0]);
        $b = Simulation::create(['total' => 0]);

        $this->assertStringStartsWith('SIM-', $a->reference);
        $this->assertNotSame($a->reference, $b->reference);
    }

    public function test_lines_relate_to_their_simulation(): void
    {
        $simulation = Simulation::create(['total' => 0, 'currency' => 'XAF']);
        SimulationLine::create([
            'simulation_id' => $simulation->id,
            'category' => 'Hébergement',
            'label' => 'Hôtel médicalisé',
            'quantity' => 5,
            'unit_price' => 60000,
            'amount' => 300000,
        ]);

        $this->assertCount(1, $simulation->fresh()->lines);
        $this->assertSame('300000.00', (string) $simulation->lines->first()->amount);
        $this->assertTrue($simulation->lines->first()->is_estimate); // default
    }

    public function test_catalog_resolves_the_structured_unit_price(): void
    {
        $row = new Simulator();
        $row->unit_price = 50000;
        $row->value = 'ignored when unit_price is set';

        $this->assertSame(50000.0, $row->resolvedUnitPrice());
    }

    public function test_catalog_falls_back_to_parsing_the_legacy_value(): void
    {
        $row = new Simulator();
        $row->unit_price = null;
        $row->value = '60 000 FCFA';

        $this->assertSame(60000.0, $row->resolvedUnitPrice());
    }

    public function test_catalog_returns_zero_for_a_non_numeric_legacy_value(): void
    {
        $row = new Simulator();
        $row->unit_price = null;
        $row->value = 'sur devis';

        $this->assertSame(0.0, $row->resolvedUnitPrice());
    }
}
