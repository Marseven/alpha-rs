<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

class WelcomeController extends Controller
{

    public function index()
    {
        $services = Service::limit(4)->get();
        $countries = Country::all();
        $towns = Town::limit(6)->get();
        $sicks = Sick::all();
        $towns->load(['country']);
        return view('welcome', [
            'services' => $services,
            'towns' => $towns,
            'sicks' => $sicks,
            'countries' => $countries,
        ]);
    }

    public function contact(Request $request)
    {
        try {
            Mail::to('mebodoaristide@gmail.com')->queue(new QueryMessage($request->all()));
        } catch (Swift_TransportException $e) {
            return back()->with('error',  $e->getMessage());
        }
        return back()->with('success', "Votre mail a été envoyé, nous reviendrons vers vous au plus tôt.");
    }

    public function search(Request $request)
    {
        $keyword = $request->q;
        $sicks = Sick::where('label', 'LIKE', '%' . $keyword . '%')->paginate(10);

        $towns = [];

        if ($sicks->count() > 0) {
            $i = 0;
            foreach ($sicks as $sick) {
                $sql = DB::table('hospital_sick')->where([
                    'sick_id' => $sick->id
                ])->get();

                foreach ($sql as $t) {
                    $hospital = Hospital::find($t->hospital_id);
                    $town = Town::find($hospital->town_id);
                    $town->load(['country']);
                    if (!in_array($town, $towns)) {
                        $towns[$i] = $town;
                        $i++;
                    }
                }
            }
        }

        return view('search', [
            'towns' => $towns,
            'keyword' => $keyword,
        ]);
    }
}
