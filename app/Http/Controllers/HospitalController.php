<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hospital;
use App\Models\Hospitals;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Sick;
use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    //

    public function index()
    {
        $hospitals = Hospital::all();
        return view(
            'hospitals.list',
            [
                'hospitals' => $hospitals,
                'title' => 'Hôpital'
            ]
        );
    }

    public function create(Request $request)
    {

        $hospital = new Hospital();

        $hospital->label = $request->label;
        $hospital->description = $request->description;
        $hospital->town_id = $request->town_id;
        $country = Town::find($request->town_id);
        $hospital->country_id = $country->country_id;

        $picture_1 = FileController::picture($request->file('picture_1'));
        if ($picture_1['state'] == false) {
            return back()->with('error', $picture_1['message']);
        }

        $hospital->picture_1 = $picture_1['url'];

        $picture_2 = FileController::picture($request->file('picture_2'));
        if ($picture_2['state'] == false) {
            return back()->with('error', $picture_2['message']);
        }

        $hospital->picture_2 = $picture_2['url'];

        $hospital->status = STATUT_ENABLE;
        $hospital->user_id = auth()->user()->id;

        if ($hospital->save()) {
            return back()->with('success', "L'hôpital a bien été créé !");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function edit(Hospital $hospital)
    {

        if (auth()->user()->id == $hospital->user_id) {
            return view('edit', compact('hospital'));
        } else {
            return redirect('/hospital');
        }
    }

    public function update(Request $request, Hospital $hospital)
    {
        Controller::he_can('hospitals', 'updat');

        if (isset($_POST['delete'])) {
            if ($hospital->delete()) {
                return back()->with('success', "L'hôpital a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $hospital->label = $request->label;
            $hospital->description = $request->description;

            $hospital->town_id = $request->town_id;
            $town = Town::find($request->town_id);
            $hospital->country_id = $town->country_id;

            if ($request->file('picture_1')) {
                $picture_1 = FileController::picture($request->file('picture_1'));

                if ($picture_1['state'] == false) {
                    return back()->with('error', $picture_1['message']);
                }

                $hospital->picture_1 = $picture_1['url'];
            }

            if ($request->file('picture_2')) {
                $picture_2 = FileController::picture($request->file('picture_2'));

                if ($picture_2['state'] == false) {
                    return back()->with('error', $picture_2['message']);
                }

                $hospital->picture_2 = $picture_2['url'];
            }

            $hospital->status = $request->status;
            if ($hospital->save()) {
                return back()->with('success', "L'hôpital a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }

    public function sick(Request $request)
    {

        $sicks = Sick::all();

        foreach ($sicks as $sick) {
            if ($request->get('sick-' . $sick->id) == "on") {
                DB::table('hospital_sick')->where([
                    'hospital_id' => $request->get('hospital'),
                    'sick_id' => $sick->id
                ])->delete();
                DB::table('hospital_sick')->insert([
                    'hospital_id' => $request->get('hospital'),
                    'sick_id' => $sick->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Maladies affectées !');
    }
}
