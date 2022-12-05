<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Refill;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function profil(User $user)
    {
        $user = User::find(Auth::user()->id);
        $user->load(['quotes', 'folders', 'payments']);
        $somme = 0;
        foreach ($user->payments as $payment) {
            $somme += $payment->amount;
        }

        foreach ($user->payments as $payment) {
            $delais = Controller::delais_hour($payment->created_at);
            if ($delais >= 1) {
                if ($payment->status == STATUT_PENDING) {
                    $payment->delete();
                }
            }
        }

        $services = Service::all();
        $countries = Country::all();

        return view('profile.show', [
            'user' => $user,
            'quotes' => $user->quotes,
            'folders' => $user->folders->count(),
            'somme' => $somme,
            'payments' => $user->payments,
            'services' => $services,
            'countries' => $countries,

        ]);
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        return view('profile.update-profile-information-form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $email_exist = User::where('email', $request->email)->count();
        if ($email_exist > 0) {
            return back()->with('error', "Cette email existe déjà.");
        } else {
            $user->email = $request->email;
        }
        $user->phone = $request->phone;

        $picture = FileController::user($request->file('picture'));
        if ($picture['state'] == false) {
            return back()->withErrors($picture['message']);
        }

        $user->picture = $picture['url'];

        $user->save();
        return redirect('/profil');
    }

    public function editPassword(User $user)
    {
        $user = Auth::user();
        return view('profile.update-password-form', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Mot de Passe mis à jour !');
    }
}
