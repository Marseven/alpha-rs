<?php

namespace App\Services;

use App\Models\Simulation;
use App\Models\Simulator;

/**
 * Turns the tariff catalog (simulators) into a computed, persisted estimate.
 *
 * For a (service, country, pathology) triple it reads the enabled catalog rows,
 * builds one breakdown line per poste (amount = quantity x unit price), sums the
 * mandatory lines into the total, freezes the tariff version, and saves the
 * Simulation + its lines so it has a reference and can be retrieved / e-mailed /
 * attached to a folder.
 */
class SimulationEngine
{
    /**
     * @param  array{name?:string,email?:string,phone?:string,user_id?:int|null,folder_id?:int|null}  $context
     */
    public function run(int $serviceId, int $countryId, int $sickId, array $context = []): Simulation
    {
        $rows = Simulator::where('service_id', $serviceId)
            ->where('country_id', $countryId)
            ->where('sick_id', $sickId)
            ->where('status', STATUT_ENABLE) // ignore disabled catalog rows
            ->with('item')
            ->get();

        $lines = [];
        $total = 0.0;

        foreach ($rows as $row) {
            $quantity = (float) ($row->quantity ?? 1);
            if ($quantity <= 0) {
                $quantity = 1.0;
            }
            $unitPrice = $row->resolvedUnitPrice();
            $amount = round($quantity * $unitPrice, 2);

            $lines[] = [
                'category' => $row->category,
                'label' => $row->item?->label ?: ($row->value ?: 'Poste'),
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'amount' => $amount,
                'is_optional' => (bool) $row->is_optional,
                'is_estimate' => $row->is_estimate === null ? true : (bool) $row->is_estimate,
                'source_simulator_id' => $row->id,
            ];

            // Optional postes are shown but excluded from the headline total.
            if (! $row->is_optional) {
                $total += $amount;
            }
        }

        $simulation = Simulation::create([
            'service_id' => $serviceId,
            'country_id' => $countryId,
            'sick_id' => $sickId,
            'user_id' => $context['user_id'] ?? null,
            'folder_id' => $context['folder_id'] ?? null,
            'contact_name' => $context['name'] ?? null,
            'contact_email' => $context['email'] ?? null,
            'contact_phone' => $context['phone'] ?? null,
            'total' => round($total, 2),
            'currency' => config('relief.simulator.currency', 'XAF'),
            'tariff_version' => config('relief.simulator.tariff_version', 'v1'),
            'valid_until' => now()->addDays((int) config('relief.simulator.validity_days', 30)),
            'status' => 'saved',
        ]);

        if ($lines) {
            $simulation->lines()->createMany($lines);
        }

        return $simulation->load('lines');
    }
}
