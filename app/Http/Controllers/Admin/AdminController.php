<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Refill;
use App\Models\Card;
use App\Models\Country;
use App\Models\Folder;
use App\Models\Hospital;
use App\Models\Payment;
use App\Models\Query;
use App\Models\Quote;
use App\Models\RequestCard;
use App\Models\Service;
use App\Models\Sick;
use App\Models\Town;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index(){
        $hospitals = Hospital::all();
        $folders = Folder::all()->count();
        $quotes = Quote::all()->count();
        $sicks = Sick::all()->count();
        $payments = Payment::all()->count();

        $hospitals_status = Hospital::all()->where('status', STATUT_ENABLE)->count();
        $folders_status = Folder::all()->where('status', STATUT_DO)->count();
        $sicks_status = Sick::all()->where('status', STATUT_APPROVE)->count();
        $payments_status = Payment::all()->where('status', STATUT_PAID)->count();

        return view('admin.dashboard', [
            'hospitals' => $hospitals,
            'folders' => $folders,
            'quotes' => $quotes,
            'sicks' => $sicks,
            'payments' => $payments,

            'hospitals_status' => $hospitals_status,
            'folders_status' => $folders_status,
            'sicks_status' => $sicks_status,
            'payments_status' => $payments_status,
        ]);
    }

    public function listHospitals(){
        Controller::he_can('Hospitals', 'look');
        $hospitals = Hospital::all();
        $hospitals->load(['country', 'town', 'sicks']);
        $towns = Town::all();
        $sicks = Sick::all();
        return view('admin.hospital.list', [
            'hospitals' => $hospitals,
            'towns' => $towns,
            'sicks' => $sicks,
        ]);
    }

    public function listFolders(){
        Controller::he_can('Folders', 'look');
        $folders = Folder::all();
        $quotes = Quote::all();
        return view('admin.folder.list', [
            'quotes' => $quotes,
            'folders' => $folders,
        ]);
    }

    public function listQuotes(){
        Controller::he_can('Quotes', 'look');
        $quotes = Quote::all();
        return view('admin.quote.list', compact('quotes'));
    }

    public function listServices(){
        Controller::he_can('Services', 'look');
        $services = Service::all();
        return view('admin.service.list', compact('services'));
    }

    public function listSicks(){
        Controller::he_can('Sicks', 'look');
        $sicks = Sick::all();
        return view('admin.sick.list', compact('sicks'));
    }

    public function listPayments(){
        Controller::he_can('Payments', 'look');
        $payments = Payment::all();
        return view('admin.payments.list', compact('payments'));
    }


    public function listCountries(){
        Controller::he_can('Countries', 'look');
        $countries = Country::all();
        return view('admin.country.list', [
            'countries' => $countries,
        ]);
    }

    public function listTowns(){
        Controller::he_can('Countries', 'look');
        $towns = Town::all();
        $towns->load(['country']);
        $countries = Country::all();
        return view('admin.country.town', [
            'towns' => $towns,
            'countries' => $countries,
        ]);
    }

}
