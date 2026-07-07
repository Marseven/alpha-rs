<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hospital;
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
            'hospital.list',
            [
                'hospitals' => $hospitals,
                'title' => 'Hôpital'
            ]
        );
    }

    public function create(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'town_id' => 'required|exists:towns,id',
            'picture_1' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'picture_2' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $hospital = new Hospital();

        $hospital->label = $request->label;
        $hospital->description = $request->description;
        $hospital->town_id = $request->town_id;
        $country = Town::findOrFail($request->town_id);
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

    public function update(Request $request, Hospital $hospital)
    {
        Controller::he_can('hospitals', 'updat');

        if ($request->has('delete')) {
            if ($hospital->delete()) {
                return back()->with('success', "L'hôpital a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $request->validate([
                'label' => 'required|string|max:255',
                'description' => 'nullable|string',
                'town_id' => 'required|exists:towns,id',
                'status' => 'required|string|max:32',
                'picture_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
                'picture_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ]);
            $hospital->label = $request->label;
            $hospital->description = $request->description;

            $hospital->town_id = $request->town_id;
            $town = Town::findOrFail($request->town_id);
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

        $hospital = Hospital::findOrFail($request->get('hospital'));

        // Collect the checked diseases and sync() the pivot in one shot:
        // idempotent, no duplicate rows, no delete/insert race condition.
        $selected = Sick::all()
            ->filter(fn ($sick) => $request->get('sick-' . $sick->id) === 'on')
            ->pluck('id')
            ->all();

        $hospital->sicks()->sync($selected);

        return redirect()->back()->with('success', 'Maladies affectées !');
    }
}
