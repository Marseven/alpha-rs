<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Models\Hospital;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $sicks = Sick::all()->where('label', 'LIKE', '%'.$keyword.'%');
        $towns = [];

        if($sicks->count() > 0){
            $i = 0;
            foreach($sicks as $sick){
                $sql = DB::table('hospital_sick')->where([
                    'sick_id' => $sick->id
                ])->get();
                foreach($sql as $t){
                    $hospital = Hospital::find($t->hospital_id);
                    $town = Town::find($hospital->town_id);
                    $town->load(['country']);
                    $towns[$i] = $town;
                    $i++;
                }
            }
        }

        return view('search', [
            'towns' => $towns,
        ]);


    }
}
