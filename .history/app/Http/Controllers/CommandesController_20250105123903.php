<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Detail;
use Illuminate\Support\Facades\Log;




class CommandesController extends Controller
{
    
    // public function showCommandesArtisan()
    // {
    //     // Récupérer l'artisan authentifié (assurez-vous que l'utilisateur est un artisan)
    //     $artisan = auth()->user();

    //     // Vérifier si l'utilisateur est un artisan (role_id = 2)
    //     if ($artisan->role_id !== 2) {
    //         // Si l'utilisateur n'est pas un artisan, on peut rediriger ou afficher un message d'erreur
    //         return redirect()->route('home')->with('error', 'Accès interdit : Vous n\'êtes pas un artisan.');
    //     }

    //     // Récupérer les commandes reçues par l'artisan (l'artisan est authentifié)
    //     $commandes = $artisan->commandesReçues;  // Récupère les commandes reçues par l'artisan

    //     // Passer les commandes à la vue
    //     return view('janvier.commandes.index', compact('commandes'));
    // }
    

    public function commandesIndex()
    {
            $artisanId = Auth::id(); // Récupérer l'ID de l'artisan connecté

        // Récupérer les commandes où les articles de la commande appartiennent à l'artisan
        $commandes = Commande::whereHas('details.article', function($query) use ($artisanId) {
            // Filtrer les articles qui appartiennent à l'artisan
            $query->where('user_id', $artisanId);
        })->with('details.article')  // Charger les articles avec les détails
        ->get();

        return view('janvier.commandes.index', compact('commandes'));
    }

    
     
    public function index()
    {
        $commandes = Commande::all();
        return view("commandes.index", compact("commandes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        return view("commandes.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        try {
            // Log des données reçues
            Log::info('Données reçues lors de la commande:', $request->all());

            // Validation des données
            $validated = $request->validate([
                'article_id' => 'required|exists:articles,id',
                'quantite' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
            ]);

            // Récupérer l'utilisateur connecté
            $user = auth()->user();

            // Créer la commande
            $commande = Commande::create([
                'user_id' => $user->id,
                'total' => $request->total,
            ]);

            // Trouver l'article
            $article = Article::find($request->article_id);

            // Ajouter le détail de la commande dans la table `details`
            Detail::create([
                'commande_id' => $commande->id,
                'article_id' => $article->id,
                'quantite' => $request->quantite,
                'prix' => $article->prix,
            ]);

            // Retourner la réponse avec la commande créée
            return response()->json([
                'message' => 'Commande créée avec succès',
                'commande' => $commande,
            ], 201);

        } catch (\Exception $e) {
            // Log l'exception pour déboguer
            Log::error('Erreur lors de la commande: ' . $e->getMessage());

            // Retourner l'erreur
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Commande::find($id);
        return view("commandes.show", compact("commande"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commande = Commande::find($id);
        return view("commandes.edit", compact("commande"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::find($id);
        $commande->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::find($id);
        $commande->delete();
    }
}
