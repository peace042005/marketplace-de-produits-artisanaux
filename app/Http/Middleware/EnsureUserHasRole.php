<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restreint l'accès d'une route à un ou plusieurs rôles.
 *
 * Rôles : 1 = Administrateur, 2 = Artisan, 3 = Client.
 * Usage : ->middleware('role:2') ou ->middleware('role:1,2')
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array((int) $user->role_id, array_map('intval', $roles), true)) {
            return redirect('/');
        }

        return $next($request);
    }
}
