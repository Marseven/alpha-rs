<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Simulator;
use App\Models\SimulatorItem;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    //
    public function index()
    {
        $services = Service::all();
        $countries = Country::all();
        $simulators = Simulator::all();
        $sicks = Sick::where('status', STATUT_SIMULATOR)->get();
        $items = SimulatorItem::all();

        return view(
            'simulator.index',
            [
                'simulators' => $simulators,
                'services' => $services,
                'countries' => $countries,
                'sicks' => $sicks,
                'items' => $items,
                'title' => 'Simulateur'
            ]
        );
    }

    public function items()
    {

        $items = SimulatorItem::all();
        return view(
            'admin.simulator.items',
            [
                'items' => $items,
                'title' => 'Simulateur'
            ]
        );
    }

    public function search(Request $request, \App\Services\SimulationEngine $engine)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'country_id' => 'required|exists:countries,id',
            'sick_id' => 'required|exists:sicks,id',
        ]);

        // Compute + persist the breakdown (total = sum of the lines), server-side.
        $simulation = $engine->run(
            (int) $data['service_id'],
            (int) $data['country_id'],
            (int) $data['sick_id'],
            ['user_id' => auth()->id()],
        );

        return redirect()->route('simulation.show', $simulation->reference);
    }

    /** Detailed, referenceable result of a persisted simulation. */
    public function show(string $reference)
    {
        $simulation = \App\Models\Simulation::where('reference', $reference)
            ->with(['lines', 'service', 'country', 'sick'])
            ->firstOrFail();

        // A saved simulation is public via its non-sequential reference, but an
        // owned one is only shown to its owner (no cross-account leak).
        if ($simulation->user_id && (int) $simulation->user_id !== (int) auth()->id()) {
            abort(403);
        }

        return view('simulator.result', [
            'simulation' => $simulation,
            'title' => 'Résultat de la simulation',
        ]);
    }

    public function create(Request $request)
    {
        $request->validate($this->rowRules());

        $simulator = new Simulator();

        $simulator->country_id = $request->country_id;
        $simulator->service_id = $request->service_id;
        $simulator->sick_id = $request->sick_id;
        $simulator->simulator_item_id = $request->item_id;
        $simulator->status = STATUT_ENABLE;
        $simulator->user_id = auth()->user()->id;
        $this->applyRow($simulator, $request);

        if ($simulator->save()) {
            return back()->with('success', "L'élément a bien été créé !");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function update(Request $request, Simulator $simulator)
    {
        if ($request->has('delete')) {
            if ($simulator->delete()) {
                return back()->with('success', "L'élément a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $request->validate($this->rowRules());

            $simulator->country_id = $request->country_id;
            $simulator->service_id = $request->service_id;
            $simulator->sick_id = $request->sick_id;
            $simulator->simulator_item_id = $request->item_id;
            $this->applyRow($simulator, $request);

            if ($simulator->save()) {
                return back()->with('success', "L'élément a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }

    /** Validation for a catalog row (structured pricing + legacy label). */
    private function rowRules(): array
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'service_id' => 'required|exists:services,id',
            'sick_id' => 'required|exists:sicks,id',
            'item_id' => 'required|exists:simulator_items,id',
            'unit_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|numeric|min:0.01',
            'category' => 'nullable|string|max:120',
            'value' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ];
    }

    /** Apply the pricing + display fields to a catalog row. */
    private function applyRow(Simulator $simulator, Request $request): void
    {
        // value is kept as the legacy label/fallback; the column is NOT NULL.
        $simulator->value = $request->input('value', '') ?? '';
        $simulator->note = $request->note;
        $simulator->unit_price = $request->filled('unit_price') ? $request->unit_price : null;
        $simulator->quantity = $request->filled('quantity') ? $request->quantity : 1;
        $simulator->category = $request->category;
        $simulator->is_optional = $request->boolean('is_optional');
        $simulator->is_estimate = $request->boolean('is_estimate');
    }

    public function create_item(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
        ]);

        $item = new SimulatorItem();

        $item->label = $request->label;
        $item->status = STATUT_ENABLE;
        // NB: simulator_items has no user_id column (removed a broken assignment).

        if ($item->save()) {
            return back()->with('success', "L'élément a bien été créé !");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function update_item(Request $request, SimulatorItem $item)
    {
        if ($request->has('delete')) {
            if ($item->delete()) {
                return back()->with('success', "L'élément a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $item->label = $request->label;
            if ($item->save()) {
                return back()->with('success', "L'élément a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
