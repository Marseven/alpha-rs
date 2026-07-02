<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Restricts a route to users with a given workflow role (doctor|pharmacy).
 * Platform admins always pass. Usage: ->middleware('workflow_role:doctor')
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (! $user) {
            return redirect('/login');
        }

        if ($user->isPlatformAdmin() || $user->workflow_role === $role) {
            return $next($request);
        }

        abort(403, "Accès réservé au rôle : {$role}.");
    }
}
