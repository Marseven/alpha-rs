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

class WelcomeController extends Controller
{

    public function index()
    {
        $services = Service::limit(4)->get();
        $countries = Country::all();
        $towns = Town::limit(6)->get();
        $sicks = Sick::limit(10)->get();
        $towns->load(['country']);
        return view('welcome', [
            'services' => $services,
            'towns' => $towns,
            'sicks' => $sicks,
            'countries' => $countries,
            'title' => 'Se faire soigner à l’étranger'
        ]);
    }

    public function faq()
    {
        return view('faq', [
            'title' => 'Foires aux Questions'
        ]);
    }

    public function pc()
    {
        return view('pc', [
            'title' => 'Politiques de Confidentialités'
        ]);
    }

    public function cgu()
    {
        return view('cgu', [
            'title' => 'Conditions générales d\'utilisation'
        ]);
    }

    public function contactForm()
    {
        return view('contact', [
            'title' => 'Contact'
        ]);
    }

    public function contact(Request $request)
    {
        try {
            Mail::to('reliefservices21@gmail.com')->queue(new QueryMessage($request->all()));
        } catch (\Throwable $e) {
            return back()->with('error',  $e->getMessage());
        }
        return back()->with('success', "Votre mail a été envoyé, nous reviendrons vers vous au plus tôt.");
    }

    public function search(Request $request)
    {
        $keyword = $request->q;

        // Eager-load the whole chain to avoid the previous N+1 (one query per
        // hospital and per town): sick -> hospitals -> town -> country.
        $sicks = Sick::where('label', 'LIKE', '%' . $keyword . '%')
            ->with('hospitals.town.country')
            ->paginate(10);

        $towns = $sicks
            ->flatMap(fn ($sick) => $sick->hospitals)
            ->map(fn ($hospital) => $hospital->town)
            ->filter()
            ->unique('id')
            ->values();

        return view('search', [
            'towns' => $towns,
            'keyword' => $keyword,
            'title' => 'Recherche'
        ]);
    }
}
