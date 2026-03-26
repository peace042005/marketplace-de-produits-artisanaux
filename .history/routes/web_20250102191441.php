<?php

use App\Models\Avis;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbonnementsController;
use App\Http\Controllers\Type_abonnementsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/layout', function () {
    return view('layout.index');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



// Protéger les routes avec l'authentification
Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        // Vérifier si l'utilisateur connecté a le rôle de client
        if (auth()->check() && auth()->user()->role_id !== 3) {
            return redirect('/'); // Redirige vers la page par défaut si ce n'est pas un client
        }

        // Si tout va bien, afficher la page Home en React
        return Inertia::render('Home'); // Page d'accueil pour les clients
    })->middleware(['auth'])->name('client.home');

    Route::get('/api/articles', [ArticlesController::class, 'getArticles']);
    Route::post('/commandes', [CommandesController::class, 'store']);

    Route::get('/profil', function () {
        if (auth()->user()->role_id !== 3) {
            return redirect('/');
        }

        return Inertia::render('Profil', [
            'user' => auth()->user(),
        ]);
    });

    Route::get('/commandes', function () {
        if (auth()->user()->role_id !== 3) {
            return redirect('/');
        }

        $user = auth()->user();

        $commandes = $user->commandes()
            ->where('statut', 0)
            ->orderBy('date_commande', 'desc')
            ->get();

        return Inertia::render('Commandes', [
            'commandes' => $commandes,
        ]);
    });

    Route::get('/achats', function () {
        if (auth()->user()->role_id !== 3) {
            return redirect('/');
        }

        $user = auth()->user();

        $achats = $user->commandes()
            ->where('statut', 1)
            ->orderBy('date_commande', 'desc')
            ->get();

        return Inertia::render('Achats', [
            'achats' => $achats,
        ]);
    });

    Route::get('/avis', function () {
        if (auth()->user()->role_id !== 3) {
            return redirect('/');
        }

        $user = auth()->user();

        $avis = Avis::where('created_by', $user->id)
            ->orderBy('date_avis', 'desc')
            ->get();

        return Inertia::render('Avis', [
            'avis' => $avis,
        ]);
    });
});

// Routes publiques
Route::get('/test', function() {
    return Inertia::render('Try');
});

// Authentification (déjà inclus avec la commande artisan)
require __DIR__.'/auth.php';









//Marcela
Route::middleware(['auth'])->group(function () {

    Route::get('/ventes/data', function () {
        if (auth()->user()->role_id !== 1) {
            return redirect('/'); // Redirection si l'utilisateur n'a pas le rôle requis
        }

        $controller = app(App\Http\Controllers\AbonnementsController::class);
        return $controller->getData(request()); // Injection explicite de la requête
    })->name('subscriptions.data');

    Route::get('/abonnements/data', function () {
        if (auth()->user()->role_id !== 1) {
            return redirect('/'); // Redirection si l'utilisateur n'a pas le rôle requis
        }

        $controller = app(App\Http\Controllers\AbonnementsController::class);
        return $controller->index_admin(request()); // Injection explicite de la requête
    })->name('abonnements.data');

    Route::get('/type_abonnements', function () {
        if (auth()->user()->role_id !== 1) {
            return redirect('/');
        }
        return app(App\Http\Controllers\Type_abonnementsController::class)->index();
    })->name('type_abonnements.index');

    Route::resource('type_abonnements', Type_abonnementsController::class)->except([
        'index'
    ])->names([
        'create' => 'type_abonnements.create',
        'store' => 'type_abonnements.store',
        'show' => 'type_abonnements.show',
        'edit' => 'type_abonnements.edit',
        'update' => 'type_abonnements.update',
        'destroy' => 'type_abonnements.destroy',
    ]);

    Route::get('/abonnements', function () {
        if (auth()->user()->role_id !== 1) {
            return redirect('/');
        }
        return app(App\Http\Controllers\AbonnementsController::class)->index();
    })->name('abonnements.index');

    Route::resource('abonnements', AbonnementsController::class)->except([
        'index'
    ])->names([
        'create' => 'abonnements.create',
        'store' => 'abonnements.store',
        'show' => 'abonnements.show',
        'edit' => 'abonnements.edit',
        'update' => 'abonnements.update',
        'destroy' => 'abonnements.destroy',
    ]);
});
//  Route::get('/abonnement', [AbonnementsController::class, 'index_admin']);

// Route::get('/abonnements/create', [AbonnementsController::class, 'create'])->name('abonnements.create');



//Janvier

Route::get('janvier/accueil', [Type_abonnementsController::class,  'index'])->name('type_abonnement.index');

Route::get('janvier/type_abonnements', [Type_abonnementsController::class,  'index'])->name('type_abonnement.index');

Route::resource('janvier/article',ArticlesController::class);

Route::post('/janvier/type_abonnements', [Type_abonnementsController::class, 'store'])->name('type_abonnement.store');

Route::get('/artisan/profil', function () {
    $user = auth()->user(); // Récupère l'utilisateur connecté
    return view('janvier.profil.index', compact('user'));
})->name('artisan.profil.index');

Route::get('/modifprofil', [UsersController::class, 'edit'])->name('artisan.profil.edit');
Route::put('/profil', [UsersController::class, 'update'])->name('artisan.profil.update');

Route::get('/artisan/article', function () {
    if (auth()->user()->role_id !== 2) {
        return redirect('/');
    }
    return app(App\Http\Controllers\ArticlesController::class)->index();
})->name('janvier.article.index');

Route::resource('/artisan/article', ArticlesController::class)->except([
    'index'
])->names([
    'create' => 'articles.create',
    'store' => 'articles.store',
    'show' => 'articles.show',
    'edit' => 'articles.edit',
    'update' => 'articles.update',
    'destroy' => 'articles.destroy',
]);

// Route protégée avec le middleware auth
Route::get('/abonnements', [AbonnementsController::class, 'index'])->name('abonnements.index')->middleware('auth');
Route::get('/commandes', [AbonnementsController::class, 'index'])->name('abonnements.index')->middleware('auth');





 


// Route pour afficher les types d'abonnement
// Route::get('/artisan/abonnement', [AbonnementsController::class, 'tyabonnements'])->name('janvier.abonnement.index');

// // Route pour s'abonner
// Route::post('/artisan/abonnements/{typeAbonnement}', [AbonnementsController::class, 'subscribe'])->name('janvier.abonnement.subscribe');




Route::middleware(['auth'])->group(function () {

    // Route::post('/abonnements/subscribe/{type_abonnement}', [AbonnementsController::class, 'subscribe'])->name('abonnements.subscribe');
    

    Route::get('janvier/accueil', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/'); // Redirection si rôle incorrect
        }
        return app(Type_abonnementsController::class)->index();
    })->name('type_abonnement.index');

    Route::get('janvier/type_abonnements', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(Type_abonnementsController::class)->index();
    })->name('type_abonnement.index');

    Route::resource('janvier/article', ArticlesController::class)->except(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::post('/janvier/type_abonnements', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(Type_abonnementsController::class)->store(request());
    })->name('type_abonnement.store');

    Route::get('/artisan/profil', function () {
        // Vérifie si l'utilisateur est authentifié et si son rôle est 'artisan' (role_id 2)
        if (!auth()->check() || auth()->user()->role_id !== 2) {
            return redirect('/'); // Redirige vers la page d'accueil si l'utilisateur n'est pas un artisan
        }
    
        // Récupère l'utilisateur authentifié
        $user = auth()->user();
    
        // Renvoie la vue du profil avec les données de l'utilisateur
        return view('janvier.profil.index', compact('user'));
    })->name('artisan.profil.index')->middleware('auth');
    

    Route::get('/modifprofil', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(UsersController::class)->edit();
    })->name('artisan.profil.edit');

    Route::put('/profil', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(UsersController::class)->update(request());
    })->name('artisan.profil.update');

    Route::get('/artisan/article', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(ArticlesController::class)->index();
    })->name('janvier.article.index');

    Route::resource('/artisan/article', ArticlesController::class)->except([
    'index'
    ])->names([
        'create' => 'article.create',
        'store' => 'articles.store',
        'show' => 'articles.show',
        'edit' => 'articles.edit',
        'update' => 'articles.update',
        'destroy' => 'articles.destroy',
    ]);

    Route::get('/artisan/abonnement', function () {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(AbonnementsController::class)->index();
    })->name('janvier.abonnement.index');

    Route::post('/artisan/abonnements/{typeAbonnement}', function ($typeAbonnement) {
        if (auth()->user()->role_id !== 2) {
            return redirect('/');
        }
        return app(AbonnementsController::class)->subscribe($typeAbonnement);
    })->name('janvier.abonnement.subscribe');
});















