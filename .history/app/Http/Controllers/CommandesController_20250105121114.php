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
        
        return view("commandes.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
         // Valider les données de la requête
    $validated = $request->validate([
        'produit_id' => 'required|exists:produits,id',  // Vérifie que le produit existe
        'quantite' => 'required|integer|min:1',         // La quantité doit être un entier >= 1
        'total' => 'required|numeric|min:0',             // Le total doit être un nombre >= 0
    ]);

    // Si la validation échoue, Laravel renverra automatiquement les erreurs au format JSON.
    // Si ce n'est pas le cas, l'exécution continue et on procède à la création de la commande.

    try {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Créer la commande
        $commande = Commande::create([
            'user_id' => $user->id,  // ID de l'utilisateur connecté
            'total' => $request->total,  // Total envoyé par React
        ]);

        // Trouver le produit sélectionné
        $produit = Produit::find($request->produit_id);

        // Vérifier si le produit existe
        if (!$produit) {
            return response()->json([
                'message' => 'Produit non trouvé',
            ], 404);
        }

        // Ajouter un détail pour lier la commande au produit
        Detail::create([
            'commande_id' => $commande->id,  // ID de la commande
            'produit_id' => $produit->id,    // ID du produit
            'quantite' => $request->quantite,  // Quantité du produit
            'prix' => $produit->prix,        // Prix du produit
        ]);

        // Retourner la réponse JSON avec la commande et un message de succès
        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande,
        ], 201);
    } catch (\Exception $e) {
        // Capture de l'exception pour obtenir plus de détails
        return response()->json([
            'message' => 'Une erreur est survenue',
            'error' => $e->getMessage(),  // Afficher l'erreur
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
