<?php

use App\Http\Controllers\AbonnementsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Type_abonnementsController;
use App\Http\Controllers\UsersController;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rôles : 1 = Administrateur, 2 = Artisan, 3 = Client.
| L'accès par rôle est géré par le middleware `role` (EnsureUserHasRole).
|
*/

// ---------------------------------------------------------------------
// Pages publiques et authentification
// ---------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::post('/logout', function () {
    Auth::logout();

    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function () {
    // Redirige chaque utilisateur vers l'espace correspondant à son rôle
    Route::get('/dashboard', function () {
        return redirect(auth()->user()->homePath());
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------------------------------------------------------
// Espace Administrateur (rôle 1)
// ---------------------------------------------------------------------

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/ventes/data', [AbonnementsController::class, 'getData'])->name('subscriptions.data');
    Route::get('/abonnements/data', [AbonnementsController::class, 'index_admin'])->name('abonnements.data');

    Route::resource('type_abonnements', Type_abonnementsController::class)->except(['show']);
});

// ---------------------------------------------------------------------
// Abonnements de l'artisan connecté (rôles 1 et 2)
// ---------------------------------------------------------------------

Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::resource('abonnements', AbonnementsController::class)->except(['show']);
});

// ---------------------------------------------------------------------
// Espace Artisan (rôle 2)
// ---------------------------------------------------------------------

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/janvier/accueil', [Type_abonnementsController::class, 'index'])->name('artisan.accueil');
    Route::get('/janvier/type_abonnements', [Type_abonnementsController::class, 'index'])->name('artisan.type_abonnements');

    Route::get('/artisan/profil', function () {
        return view('janvier.profil.index', ['user' => auth()->user()]);
    })->name('artisan.profil.index');
    Route::get('/modifprofil', [UsersController::class, 'edit'])->name('artisan.profil.edit');
    Route::put('/profil', [UsersController::class, 'update'])->name('artisan.profil.update');

    Route::get('/artisan/article', [ArticlesController::class, 'index'])->name('janvier.article.index');
    Route::resource('/artisan/article', ArticlesController::class)->except(['index', 'show'])->names([
        'create' => 'article.create',
        'store' => 'articles.store',
        'edit' => 'articles.edit',
        'update' => 'articles.update',
        'destroy' => 'articles.destroy',
    ]);

    Route::get('/artisan/abonnement', [AbonnementsController::class, 'index'])->name('janvier.abonnement.index');

    Route::get('/artisan/commandes', [CommandesController::class, 'commandesIndex'])->name('janvier.commandes.index');
    Route::post('/commande/{commande}/changer-statut', [CommandesController::class, 'changerStatut'])->name('commande.changerStatut');
});

// ---------------------------------------------------------------------
// Espace Client (rôle 3) — pages React via Inertia
// ---------------------------------------------------------------------

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Home');
    })->name('client.home');

    Route::get('/profil', function () {
        return Inertia::render('Profil', ['user' => auth()->user()]);
    })->name('client.profil');

    Route::get('/commandes', function () {
        $commandes = auth()->user()->commandes()
            ->where('statut', 0)
            ->orderBy('date_commande', 'desc')
            ->get();

        return Inertia::render('Commandes', ['commandes' => $commandes]);
    })->name('client.commandes');

    Route::get('/achats', function () {
        $achats = auth()->user()->commandes()
            ->where('statut', 1)
            ->orderBy('date_commande', 'desc')
            ->get();

        return Inertia::render('Achats', ['achats' => $achats]);
    })->name('client.achats');

    Route::get('/avis', function () {
        $avis = Avis::where('created_by', auth()->id())
            ->orderBy('date_avis', 'desc')
            ->get();

        return Inertia::render('Avis', ['avis' => $avis]);
    })->name('client.avis');

    Route::get('/api/articles', [ArticlesController::class, 'getArticles'])->name('client.articles');
    Route::post('/commandes', [CommandesController::class, 'store'])->name('client.commandes.store');
});
