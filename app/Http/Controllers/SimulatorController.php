<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Service;
use App\Models\Simulator;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    //
    public function index()
    {
        $services = Service::all();
        $countries = Country::all();
        $simulators = Simulator::all();

        return view(
            'simulator.index',
            [
                'simulators' => $simulators,
                'services' => $services,
                'countries' => $countries,
            ]
        );
    }

    public function search(Request $request)
    {

        $simulators = Simulator::where('service_id', $request->service_id)->where('country_id', $request->country_id)->get();
        $service_id = Service::find($request->service_id);
        $country_id = Country::find($request->country_id);

        $services = Service::all();
        $countries = Country::all();

        return view(
            'simulator.result',
            [
                'simulators' => $simulators,
                'service_id' => $service_id,
                'country_id' => $country_id,
                'services' => $services,
                'countries' => $countries,
            ]
        );
    }

    public function create(Request $request)
    {

        $simulator = new Simulator();

        $simulator->label = $request->label;
        $simulator->price_min = $request->price_min;
        $simulator->price_max = $request->price_max;
        $simulator->periode = $request->periode;
        $simulator->country_id = $request->country_id;
        $simulator->service_id = $request->service_id;
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
            $simulator->label = $request->label;
            $simulator->price_min = $request->price_min;
            $simulator->price_max = $request->price_max;
            $simulator->periode = $request->periode;
            $simulator->country_id = $request->country_id;
            $simulator->service_id = $request->service_id;
            if ($simulator->save()) {
                return back()->with('success', "L'élément a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
