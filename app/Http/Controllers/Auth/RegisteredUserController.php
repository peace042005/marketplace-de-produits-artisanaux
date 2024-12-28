<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des champs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['required', 'string', 'max:20'],
            'sexe' => ['required', 'in:masculin,féminin'],
            'role_id' => ['required', 'in:2,3'], // 2: Artisan, 3: Client
            'date_naissance' => ['required', 'date'],
            'poids' => ['nullable', 'numeric', 'min:0'],
            'taille' => ['nullable', 'numeric', 'min:0'],
            'adresse' => ['required', 'string', 'max:255'],
            'biographie' => ['nullable', 'string'],
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Gestion de la photo de profil
        $photoProfilPath = null;
        if ($request->hasFile('photo_profil')) {
            $photoProfilPath = $request->file('photo_profil')->store('photos_profil', 'public');
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'sexe' => $request->sexe,
            'role_id' => $request->role_id,
            'date_naissance' => $request->date_naissance,
            'poids' => $request->poids,
            'taille' => $request->taille,
            'adresse' => $request->adresse,
            'biographie' => $request->biographie,
            'photo_profil' => $photoProfilPath,
            'password' => Hash::make($request->password),
        ]);

        // Déclenchement de l'événement Registered
        event(new Registered($user));

        // Connexion automatique de l'utilisateur
        Auth::login($user);


        // Redirection selon le rôle
        if ($user->role_id === 1) {
            return redirect('/ventes/data'); // Rediriger vers le tableau de bord administrateur
        } elseif ($user->role_id === 2) {
            return redirect('/artisan/profil'); // Rediriger vers le tableau de bord artisan
        } elseif ($user->role_id === 3) {
            return redirect('/home'); // Rediriger vers le tableau de bord client
        }

        // Si aucun rôle spécifique, rediriger vers la page par défaut
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
