<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Models\RequestCard;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //

    public function index()
    {

        $services = Service::all();
        return view('services.list',
        [
            'services' => $services,
        ]);
    }

    public function create(Request $request)
    {
        Controller::he_can('Services', 'creat');
    	$service = new Service();
        $service->label = $request->label;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->price_promo = $request->price_promo;
        $service->begin_promo = $request->begin_promo;
        $service->end_promo = $request->end_promo;
        $picture = FileController::picture($request->file('picture'));

        if($picture['state'] == false){
            return back()->with('error',$picture['message']);
        }

        $service->picture = $picture['url'];
        $service->status = $request->status;
    	$service->user_id = auth()->user()->id;

        if($service->save()){
            return back()->with('succes', "Le service a bien été créée !");
        }else{
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function update(Request $request, Service $service)
    {
        Controller::he_can('Services', 'updat');

    	if(isset($_POST['delete'])) {
    		if($service->delete()){
                return back()->with('succes', "Le service bien été supprimée !");
            }else{
                return back()->with('error', "Une erreur s'est produite.");
            }
    	}else{
            $service->label = $request->label;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->price_promo = $request->price_promo;
            $service->begin_promo = $request->begin_promo;
            $service->end_promo = $request->end_promo;

            if($request->file('picture')){
                $picture = FileController::picture($request->file('picture'));

                if($picture['state'] == false){
                    return back()->with('error',$picture['message']);
                }
                $service->picture = $picture['url'];
            }

            $service->status = $request->status;
	    	if($service->save()){
                return back()->with('succes', "Le service a bien été mis à jour !");
            }else{
                return back()->with('error', "Une erreur s'est produite.");
            }
    	}
    }
}
