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
            ]
        );
    }

    public function search(Request $request)
    {

        $simulators = Simulator::where('service_id', $request->service_id)->where('country_id', $request->country_id)->where('sick_id', $request->sick_id)->get();
        $service_id = Service::find($request->service_id);
        $country_id = Country::find($request->country_id);
        $sick_id = Sick::find($request->sick_id);

        $services = Service::all();
        $countries = Country::all();
        $sicks = Sick::all();


        return view(
            'simulator.result',
            [
                'simulators' => $simulators,
                'service_id' => $service_id,
                'country_id' => $country_id,
                'services' => $services,
                'sick_id' => $sick_id,
                'countries' => $countries,
                'sicks' => $sicks,
            ]
        );
    }

    public function create(Request $request)
    {

        $simulator = new Simulator();

        $simulator->value = $request->value;
        $simulator->note = $request->note;
        $simulator->country_id = $request->country_id;
        $simulator->service_id = $request->service_id;
        $simulator->sick_id = $request->sick_id;
        $simulator->simulator_item_id = $request->item_id;
        $simulator->status = STATUT_ENABLE;
        $simulator->user_id = auth()->user()->id;

        if ($simulator->save()) {
            return back()->with('success', "L'élément a bien été créé !");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function edit(Simulator $simulator)
    {

        if (auth()->user()->id == $simulator->user_id) {
            return view('edit', compact('simulator'));
        } else {
            return redirect('/simulator');
        }
    }

    public function update(Request $request, Simulator $simulator)
    {
        if (isset($_POST['delete'])) {
            if ($simulator->delete()) {
                return back()->with('success', "L'élément a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $simulator->value = $request->value;
            $simulator->note = $request->note;
            $simulator->country_id = $request->country_id;
            $simulator->service_id = $request->service_id;
            $simulator->sick_id = $request->sick_id;
            $simulator->simulator_item_id = $request->item_id;
            if ($simulator->save()) {
                return back()->with('success', "L'élément a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }

    public function create_item(Request $request)
    {

        $item = new SimulatorItem();

        $item->label = $request->label;
        $item->status = STATUT_ENABLE;
        $item->user_id = auth()->user()->id;

        if ($item->save()) {
            return back()->with('success', "L'élément a bien été créé !");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function update_item(Request $request, SimulatorItem $item)
    {
        if (isset($_POST['delete'])) {
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
