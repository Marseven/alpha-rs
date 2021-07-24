<?php

namespace App\Http\Controllers;

use App\Mail\QueryMessage;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Service;
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
        return view('quotes.list',
        [
            'quotes' => $user->quotes,
        ]);
    }

    public function add()
    {
        $services = Service::all();
        $countries = Country::all();
    	return view('quote.add',
        [
            'services' => $services,
            'countries' => $countries,
        ]);
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

        $join_piece = FileController::request_file($request->file('join_piece'));
        if($join_piece['state'] == false){
            return back()->with('error',$join_piece['message']);
        }

        $quote->join_piece = $join_piece['url'];


        $quote->status = STATUT_RECEIVE;

        $quote->service_id = $request->service_id;
        $quote->country_id = $request->country_id;


        if(Auth::user()) {
            $quote->user_id = auth()->user()->id;
        }else{
            $email_exist = User::all()->where('email', $request->email)->count();
            if($email_exist > 1){
                return back()->with('error',"Cette email exiiste déjà, connectez-vous pour faire une nouvelle demande.");
            }
        }

        if($quote->save()){

            if(Auth::user()){
                return back()->with('succes',"Votre demande a été envoyé, nous reviendrons vers vous au plus tôt.");
            }else{
                $user = new User();
                $user->name = $request->firstname.' '.$request->lastname;
                $user->email = $request->email;

                if($user->save()){
                    $status = Password::sendResetLink(
                        $request->only('email')
                    );

                    //$user->sendEmailVerificationNotification();

                    if($status === Password::RESET_LINK_SENT){
                        $quote->user_id = $user->id;
                        $quote->save();
                        return PaymentController::ebilling('quote', $quote);
                    } else{
                        return back()->with('error','Une erreur s\'est produite, Veuillez réessayer !');
                    }

                }else{
                    return back()->with('error','Une erreur s\'est produite, Veuillez réessayer !');
                }
            }
        }else{
            return back()->with('error','Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function edit(Quote $quote)
    {
    	if (auth()->user()->id == $quote->user_id)
        {
            return view('edit', compact('quote'));
        }else {
            return back();
        }
    }

    public function update(Request $request, Quote $quote)
    {
        Controller::he_can('Quotes', 'updat');

    	if(isset($_POST['delete'])) {
    		if($quote->delete()){
                return back()->with('success','Le devis a été supprimée.');
            }else{
                return back()->with('error', 'La devis n\'a pas été supprimée.');
            }
    	}else{
            $quote->lastname = $request->lastname;

            $quote->firstname = $request->firstname;
            $quote->birthday = $request->birthday;

            $quote->genre = $request->genre;

            $quote->email = $request->email;
            $quote->phone = $request->phone;

            $quote->category = $request->category;

            $join_piece = FileController::request_file($request->file('join_piece'));
            if($join_piece['state'] == false){
                return back()->with('error',$join_piece['message']);
            }

            $quote->join_piece = $join_piece['url'];
	    	if($quote->save()){
                return back()->with('success', 'Le devis a été mise à jour.');
            }else{
                return back()->with('error', 'Le devis n\'a pas été mise à jour.');
            }
    	}
    }

}
