<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        try {
            // 1. Validation des données
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'article_id' => 'required|exists:articles,id',
            ]);
    
            // 2. Récupérer l'article
            $article = Article::findOrFail($validated['article_id']);
            $prix = $article->prix;
    
            // 3. Créer la commande
            $commande = Commande::create([
                'user_id' => $validated['user_id'],
                'total' => $prix, // Le total est basé sur le prix de l'article, quantité fixée à 1
                'statut' => false,
            ]);
    
            // 4. Ajouter un détail avec quantité = 1
            $commande->details()->create([
                'article_id' => $validated['article_id'],
                'quantite' => 1, // Quantité fixée à 1
            ]);
    
            // 5. Retourner une réponse
            return view("commandes.create");
       
        } catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse
            return response()->json([
                'error' => 'Erreur lors de la création de la commande.',
                'details' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = auth()->user(); // Récupérer l'utilisateur connecté
        
        $commande = Commande::create([
            'user_id' => $user->id, // ID de l'utilisateur connecté
            'total' => $request->total, // Total envoyé par React
        ]);

        

        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande,
        ], 201);
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
