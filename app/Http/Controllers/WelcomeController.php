<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{

    public function index(){
        $services = Service::limit(4)->get();
        $towns = Town::limit(3)->get();
        $towns->load(['country']);
        return view('welcome', [
            'services' => $services,
            'towns' => $towns,
        ]);
    }

    public function contact(Request $request){

        Mail::to('m.cherone@reliefservices.space')->queue(new QueryMessage($request->all()));

        return back()->with('succes',"Votre mail a été envoyé, nous reviendrons vers vous au plus tôt.");
    }

    public function search(Request $request){
        $keyword = $request->q;
        $sicks = Sick::where('label', 'LIKE', '%'.$keyword.'%')->get();
        $sicks->load(['hospitals']);

        $towns = [];
        $i = 0;

        if($sicks->count() > 0){
            foreach($sicks->hospitals as $hospital){
                $town = Town::find($hospital->town_id);
                $town->load(['country']);
                $towns[$i] = $town;
                $i++;
            }
        }

        return view('search', [
            'towns' => $towns,
        ]);


    }
}
