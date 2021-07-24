<?php

namespace App\Http\Middleware;

use App\Models\SecurityObject;
use App\Models\SecurityRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()){
            $role = SecurityRole::find(Auth::user()->security_role_id);
            if($role){
                $espace = SecurityObject::find($role->security_object_id);
                if($espace->name == 'admin' || $espace->name == 'Admin'){
                    return $next($request);
                }
            }
        }

        return redirect('/')->with('error',"Vous n'avez pas accès à cet espace.");
    }
}
