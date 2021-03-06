<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Mail\StatusMessage;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Service;
use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use PHPUnit\Framework\Constraint\Count;

class QuoteController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['quotes']);
        return view(
            'quotes.list',
            [
                'quotes' => $user->quotes,
            ]
        );
    }

    public function add($type = null, $id = null)
    {
        $services = Service::all();
        $countries = Country::all();

        $service_check = false;
        $country_check = false;

        if ($type == "town") {
            $town = Town::find($id);
            $country_check = Country::find($town->country_id);
        } elseif ($type == "service") {
            $service_check = Service::find($id);
        }

        return view(
            'quote.add',
            [
                'services' => $services,
                'countries' => $countries,
                'service_check' => $service_check,
                'country_check' => $country_check,
            ]
        );
    }

    public function create(Request $request)
    {

        $quote = new Quote();

        $quote->reference = $this->str_random(8);

        $quote->lastname = $request->lastname;

        $quote->firstname = $request->firstname;
        $quote->birthday = $request->birthday;

        $quote->gender = $request->gender;

        $quote->email = $request->email;
        $quote->phone = $request->phone;

        $quote->category = $request->category;

        $join_piece = FileController::quote_file($request->file('join_piece'));
        if ($join_piece['state'] == false) {
            return back()->with('error', $join_piece['message']);
        }

        $quote->join_piece = $join_piece['url'];


        $quote->status = STATUT_RECEIVE;

        $quote->service_id = $request->service_id;
        $quote->country_id = $request->country_id;


        if (Auth::user()) {
            $quote->user_id = auth()->user()->id;
            if ($quote->save()) {

                if (Auth::user()) {
                    return PaymentController::singpay('quote', $quote);
                } else {
                    return back()->with('error', 'Une erreur s\'est produite, Veuillez r??essayer !');
                }
            } else {
                return back()->with('error', 'Une erreur s\'est produite, Veuillez r??essayer !');
            }
        } else {
            $email_exist = User::where('email', $request->email)->count();
            if ($email_exist > 0) {
                return back()->with('error', "Cette email exiiste d??j??, connectez-vous pour faire une nouvelle demande.");
            } else {
                $user = new User();
                $user->name = $request->firstname . ' ' . $request->lastname;
                $user->email = $request->email;

                if ($user->save()) {
                    $status = Password::sendResetLink(
                        $request->only('email')
                    );

                    //$user->sendEmailVerificationNotification();

                    if ($status === Password::RESET_LINK_SENT) {
                        $quote->user_id = $user->id;
                        $quote->save();
                        return PaymentController::singpay('quote', $quote);
                    } else {
                        return back()->with('error', 'Une erreur s\'est produite, Veuillez r??essayer !');
                    }
                } else {
                    return back()->with('error', 'Une erreur s\'est produite, Veuillez r??essayer !');
                }
            }
        }
    }

    public function edit(Quote $quote)
    {
        if (auth()->user()->id == $quote->user_id) {
            return view('edit', compact('quote'));
        } else {
            return back();
        }
    }

    public function update(Request $request, Quote $quote)
    {
        Controller::he_can('Quotes', 'updat');

        if (isset($_POST['delete'])) {
            if ($quote->delete()) {
                return back()->with('success', 'Le devis a ??t?? supprim??e.');
            } else {
                return back()->with('error', 'La devis n\'a pas ??t?? supprim??e.');
            }
        } else {
            $quote->lastname = $request->lastname;

            $quote->firstname = $request->firstname;
            $quote->birthday = $request->birthday;

            $quote->genre = $request->genre;

            $quote->email = $request->email;
            $quote->phone = $request->phone;

            $quote->category = $request->category;

            $join_piece = FileController::quote_file($request->file('join_piece'));
            if ($join_piece['state'] == false) {
                return back()->with('error', $join_piece['message']);
            }

            $quote->join_piece = $join_piece['url'];
            if ($quote->save()) {
                return back()->with('success', 'Le devis a ??t?? mise ?? jour.');
            } else {
                return back()->with('error', 'Le devis n\'a pas ??t?? mise ?? jour.');
            }
        }
    }

    public function updateState(Request $request, $quote)
    {
        $quote = Quote::find($quote);
        $quote->status = $request->status;
        $quote->response = $request->response;
        $quote->load(['user']);
        if ($quote->save()) {
            Mail::to($quote->user->email)->queue(new StatusMessage($quote, "quote"));
            return back()->with('success', "Le status du devis a bien ??t?? mis ?? jour !");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function pay(Quote $quote)
    {
        return PaymentController::singpay('quote', $quote);
    }
}
