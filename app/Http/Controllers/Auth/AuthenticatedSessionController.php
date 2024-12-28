<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Vérifier le rôle de l'utilisateur connecté
        if (auth()->user()->role_id === 1) {
            // Si le rôle est 1 (par exemple, administrateur)
            return redirect('/ventes/data'); // Rediriger vers le tableau de bord administrateur
        } elseif (auth()->user()->role_id === 2) {
            // Si le rôle est 2 (par exemple, Artisan)
            return redirect('/artisan/profil'); // Rediriger vers le tableau de bord artisan
        } elseif (auth()->user()->role_id === 3) {
            // Si le rôle est 3 (par exemple, Client)
            return redirect('/home'); // Rediriger vers le tableau de bord client
        }

        // Si aucun rôle spécifique, rediriger vers la page par défaut
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
