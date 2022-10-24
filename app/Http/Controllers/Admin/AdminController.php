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
use App\Models\Simulator;
use App\Models\Town;
use App\Models\User;
use DoctrineExtensions\Query\Mysql\Now;

class AdminController extends Controller
{
    //
    public function index()
    {
        $hospitals = Hospital::all()->count();
        $folders = Folder::all()->count();
        $countries = Country::all()->count();
        $quotes = Quote::limit(10)->get();
        $users = User::all()->where('secure_role_id', '<>', 1)->count();

        $folders_end = Folder::where('status', STATUT_DO)->count();
        $folders_pending = Folder::where('status', STATUT_PENDING)->count();

        $folders_today = Folder::where('created_at', Now())->count();

        $payments = Payment::all();
        $payment_total = 0;
        foreach ($payments as $payment) {
            $payment_total += $payment->amount;
        }

        $hospitals_status = Hospital::all()->where('status', STATUT_ENABLE)->count();
        $folders_status = Folder::all()->where('status', STATUT_DO)->count();

        $payment = Payment::all()->where('status', STATUT_PAID);
        $payment_pay = 0;
        foreach ($payment as $pay) {
            $payment_pay += $pay->amount;
        }

        return view('admin.dashboard', [
            'hospitals' => $hospitals,
            'folders' => $folders,
            'folders_end' => $folders_end,
            'folders_pending' => $folders_pending,
            'folders_today' => $folders_today,
            'quotes' => $quotes,
            'countries' => $countries,
            'users' => $users,
            'payment_total' => $payment_total,
            'payment_pay' => $payment_pay,
        ]);
    }

    public function listHospitals()
    {
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

    public function listFolders()
    {
        Controller::he_can('Folders', 'look');
        $folders = Folder::all();
        $quotes = Quote::all();
        return view('admin.folder.list', [
            'quotes' => $quotes,
            'folders' => $folders,
        ]);
    }

    public function listQuotes()
    {
        Controller::he_can('Quotes', 'look');
        $quotes = Quote::all();
        return view('admin.quote.list', compact('quotes'));
    }

    public function listServices()
    {
        Controller::he_can('Services', 'look');
        $services = Service::all();
        return view('admin.service.list', compact('services'));
    }

    public function listSicks()
    {
        Controller::he_can('Sicks', 'look');
        $sicks = Sick::all();
        return view('admin.sick.list', compact('sicks'));
    }

    public function listPayments()
    {
        Controller::he_can('Payments', 'look');
        $payments = Payment::all();
        return view('admin.payments.list', compact('payments'));
    }


    public function listCountries()
    {
        Controller::he_can('Countries', 'look');
        $countries = Country::all();
        return view('admin.country.list', [
            'countries' => $countries,
        ]);
    }

    public function listSimulators()
    {
        $simulators = Simulator::all();
        $services = Service::all();
        $countries = Country::all();
        $sicks = Sick::all();
        return view('admin.simulator.list', [
            'simulators' => $simulators,
            'services' => $services,
            'countries' => $countries,
            'sicks' => $sicks,
        ]);
    }

    public function listTowns()
    {
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
