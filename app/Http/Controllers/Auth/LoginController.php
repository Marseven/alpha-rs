<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PROFIL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // A suspended account must not obtain a session, even with valid
            // credentials (the password stays known to the admin who set it).
            if (Auth::user()->isSuspended()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', "Ce compte a été suspendu. Contactez Relief Services.");
            }

            $request->session()->regenerate();

            return redirect()->intended($this->homeFor(Auth::user()));
        }

        return back()->with('error', 'Email ou Mot de passe incorrect !');
    }

    /** Landing page after login, based on the user's role/space. */
    private function homeFor($user): string
    {
        if ($user->isPlatformAdmin()) {
            return '/admin/dashboard';
        }

        return match ($user->workflow_role) {
            'doctor' => '/doctor/cases',
            'cnamgs' => '/cnamgs/cases',
            default => '/profil',
        };
    }
}
