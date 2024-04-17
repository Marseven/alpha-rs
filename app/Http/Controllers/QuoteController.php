<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Mail\QuoteMessage;
use App\Mail\QuoteAdminMessage;
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
use Swift_TransportException;

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
                'title' => 'Devis'
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
                'title' => 'Devis'
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

        if ($request->file('join_piece_passport') != null) {
            $join_piece_passport = FileController::quote_file($request->file('join_piece_passport'));
            if ($join_piece_passport['state'] == false) {
                return back()->with('error', $join_piece_passport['message']);
            }

            $quote->join_piece_passport = $join_piece_passport['url'];
        } else {
            return back()->with('error', "Veuillez joindre le dossier médicale.");
        }

        if ($request->file('join_piece_rapport') != null) {
            $join_piece_rapport = FileController::quote_file($request->file('join_piece_rapport'));
            if ($join_piece_rapport['state'] == false) {
                return back()->with('error', $join_piece_rapport['message']);
            }

            $quote->join_piece_rapport = $join_piece_rapport['url'];
        } else {
            return back()->with('error', "Veuillez joindre le dossier médicale.");
        }

        if ($request->file('join_piece_examen') != null) {
            $join_piece_exam = FileController::quote_file($request->file('join_piece_examen'));
            if ($join_piece_exam['state'] == false) {
                return back()->with('error', $join_piece_exam['message']);
            }

            $quote->join_piece_exam = $join_piece_exam['url'];
        } else {
            return back()->with('error', "Veuillez joindre le dossier médicale.");
        }


        $quote->status = STATUT_RECEIVE;

        $quote->service_id = $request->service_id;
        $quote->country_id = $request->country_id;

        $admins = User::where('security_role_id', '<=', 2)->get();

        if (Auth::user()) {
            $quote->user_id = auth()->user()->id;
            if ($quote->save()) {
                try {
                    $result = Mail::to($quote->user->email)->queue(new QuoteMessage($quote));
                    $result1 = Mail::to('reliefservices21@gmail.com')->queue(new QuoteAdminMessage($quote));
                    foreach ($admins as $admin) {
                        $result = Mail::to($admin->email)->queue(new QuoteAdminMessage($quote));
                    }
                } catch (Swift_TransportException $e) {
                    echo $e->getMessage();
                }
                return back()->with('success', 'Le devis a été envoyé avec succès.');
            } else {
                return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
            }
        } else {
            $email_exist = User::where('email', $request->email)->count();
            if ($email_exist > 0) {
                return back()->with('error', "Cette email exiiste déjà, connectez-vous pour faire une nouvelle demande.");
            } else {
                $user = new User();
                $user->name = $request->firstname . ' ' . $request->lastname;
                $user->email = $request->email;

                if ($user->save()) {
                    $status = Password::sendResetLink(
                        $request->only('email')
                    );

                    if ($status === Password::RESET_LINK_SENT) {
                        $quote->user_id = $user->id;
                        $quote->save();

                        try {
                            $result = Mail::to($quote->user->email)->queue(new QuoteMessage($quote));
                            $result1 = Mail::to('reliefservices21@gmail.com')->queue(new QuoteAdminMessage($quote));
                            foreach ($admins as $admin) {
                                $result = Mail::to($admin->email)->queue(new QuoteAdminMessage($quote));
                            }
                        } catch (Swift_TransportException $e) {
                            echo $e->getMessage();
                        }
                        Auth::guard()->login($user);
                        return redirect('profil')->with('success', 'Le devis a été envoyé avec succès.');
                    } else {
                        return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
                    }
                } else {
                    return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
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
                return back()->with('success', 'Le devis a été supprimée.');
            } else {
                return back()->with('error', 'La devis n\'a pas été supprimée.');
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
                return back()->with('success', 'Le devis a été mise à jour.');
            } else {
                return back()->with('error', 'Le devis n\'a pas été mise à jour.');
            }
        }
    }

    public function updateState(Request $request, $quote)
    {
        $quote = Quote::find($quote);
        $devis = FileController::quote_file($request->file('devis'));
        if ($devis['state'] == false) {
            return back()->with('error', $devis['message']);
        }

        $quote->devis = $devis['url'];
        $quote->status = $request->status;
        $quote->response = $request->response;
        $quote->load(['user']);
        if ($quote->save()) {
            try {
                $result = Mail::to($quote->user->email)->queue(new StatusMessage($quote, "quote"));
            } catch (Swift_TransportException $e) {
                echo $e->getMessage();
            }
            return back()->with('success', "Le status du devis a bien été mis à jour !");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function pay(Quote $quote)
    {
        return PaymentController::singpay('quote', $quote);
    }

    public function payment(Quote $quote)
    {
        $service = Service::find($quote->service_id);
        dd($service);
        return view(
            'quote.pay',
            [
                'quote' => $quote,
                'service' => $service,
                'title' => 'Paiement'
            ]
        );
    }
}
