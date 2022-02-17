<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Country;
use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    //

    public function index()
    {

        $contries = Country::all();
        return view(
            'admin.contries.list',
            [
                'contries' => $contries,
            ]
        );
    }

    public function towns()
    {
        $towns = Town::find(Auth::user()->id);
        $contries = Country::all();
        return view(
            'admin.contries.list',
            [
                'towns' => $towns,
                'contries' => $contries,
            ]
        );
    }

    public function create(Request $request)
    {

        $country = new Country();

        $country->label = $request->label;
        $country->code = $request->code;
        $picture = FileController::picture($request->file('flag'));
        if ($picture['state'] == false) {
            return back()->with('error', $picture['message']);
        }

        $country->flag = $picture['url'];
        $country->status = STATUT_ENABLE;
        $country->user_id = auth()->user()->id;

        dd($country);

        if ($country->save()) {
            return back()->with('success', 'Le pays a bien été créé.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function update(Request $request, Country $country)
    {

        Controller::he_can('Countries', 'updat');

        if (isset($_POST['delete'])) {
            if ($country->delete()) {
                return back()->with('success', "Le pays a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $country->label = $request->label;
            $country->code = $request->code;
            $picture = FileController::picture($request->file('flag'));
            if ($picture['state'] == false) {
                return back()->with('error', $picture['message']);
            }

            $country->flag = $picture['url'];
            $country->status = STATUT_ENABLE;
            $country->status = $request->status;
            if ($country->save()) {
                return back()->with('succes', "Le pays a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }


    public function createTown(Request $request)
    {

        $town = new Town();

        $town->label = $request->label;
        $town->code = $request->code;
        $picture = FileController::picture($request->file('picture'));
        if ($picture['state'] == false) {
            return back()->with('error', $picture['message']);
        }
        $town->picture = $picture['url'];
        $town->status = STATUT_ENABLE;
        $town->country_id = $request->country_id;
        $town->user_id = auth()->user()->id;

        if ($town->save()) {
            return back()->with('success', 'La ville a été créé avec succes.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function updateTown(Request $request, Town $town)
    {

        Controller::he_can('Countries', 'updat');

        if (isset($_POST['delete'])) {
            if ($town->delete()) {
                return back()->with('succes', "La ville a bien été supprimée !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        } else {
            $town->label = $request->label;
            $town->code = $request->code;
            $town->status = $request->status;
            $town->country_id = $request->country_id;
            if ($town->save()) {
                return back()->with('succes', "La ville a bien été mis à jour !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }
    }
}
