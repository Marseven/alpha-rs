<?php

namespace App\Http\Controllers;

use App\Models\Refill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profil(User $user){
        $user = User::find(Auth::user()->id);
        $user->load(['quotes', 'folders', 'payments']);
        $somme = 0;
        foreach($user->payments as $payment){
            $somme += $payment->amount;
        }

        return view('profile.show', [
            'user' =>$user,
            'quotes' => $user->quotes,
            'folders' =>$user->folders->count(),
            'somme' => $somme,
            'payments' => $user->payments,

        ]);
    }

    public function edit(User $user){
        $user = Auth::user();
        return view('profile.update-profile-information-form', compact('user'));
    }

    public function update(Request $request, User $user){
        $user->name = $request->name;
        $user->email = $request->email;

        $picture = FileController::picture($request->file('picture'));
        if($picture['state'] == false){
            return back()->withErrors($picture['message']);
        }

        $user->picture = $picture['url'];

        $user->save();
        return redirect('/profil');
    }

    public function editPassword(User $user){
        $user = Auth::user();
        return view('profile.update-password-form', compact('user'));
    }

    public function updatePassword(Request $request, User $user){
        $user->status = $request->status;
        $user->save();
        return redirect('/profil');
    }


}
