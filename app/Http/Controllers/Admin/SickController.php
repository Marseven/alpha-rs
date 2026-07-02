<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sick;
use Illuminate\Http\Request;


class SickController extends Controller
{
    //
    public function index()
    {

        $sicks = Sick::all();
        return view('sick.list',
        [
            'sicks' => $sicks,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|string|max:32',
        ]);

    	$sick = new Sick();

        $sick->label = $request->label;
        $sick->description = $request->description;
        $sick->status = $request->status;
        $sick->user_id = auth()->user()->id;

        if($sick->save()){
            return back()->with('success', 'La maladie a bien été crée');
        }else{
            return back()->with('error', 'Un problème est survenu.');
        }
    }


    public function update(Request $request, Sick $sick)
    {

        Controller::he_can('Sicks', 'updat');

        if($request->has('delete')) {
    		if($sick->delete()){
                return  back()->with('success', "La maladie a bien été supprimée !");
            }else{
                return back()->with('error', "Une erreur s'est produite.");
            }
    	}else{
            $request->validate([
                'label' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'required|string|max:32',
            ]);
            $sick->label = $request->label;
            $sick->description = $request->description;
    		$sick->status = $request->status;
	    	if($sick->save()){
                return  back()->with('success', "La maladie a bien été mis à jour !");
            }else{
                return back()->with('error', "Une erreur s'est produite.");
            }
    	}
    }
}
