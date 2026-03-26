<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function commandesIndex()
    // {
    //     $artisan = Auth::user(); // Récupérer l'utilisateur connecté (artisan)
    //     // Récupérer toutes les commandes liées à l'artisan
    //     $commandes = $artisan->commandes; 
    
    //     return view('janvier.commandes.index', compact('commandes')); // Assure-toi que 'commandes' est bien passé
    // }

    public function commandesIndex()
    {
        $artisanId = Auth::id(); // Récupérer l'ID de l'artisan connecté

        $commandes = Commande::whereHas('details.article', function($query) use ($artisanId) {
            $query->where('artisan_id', $artisanId);
        })->with('details.article')
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
    public function create()
    {
        return view("commandes.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validation des données envoyées
        $validated = $request->validate([
            'total' => 'required|numeric',    // Validation du total
            'product_id' => 'required|exists:articles,id',   // Validation du produit
            'artisan_id' => 'required|exists:users,id',      // Validation de l'artisan
            'quantity' => 'required|integer|min:1',          // Validation de la quantité
        ]);

        // Créer la commande
        $commande = Commande::create([
            'total' => $validated['total'],
            'user_id' => auth()->id(),  // ID de l'utilisateur (client) connecté
        ]);

        // Ajouter les détails de la commande
        $commande->details()->create([
            'article_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
        ]);

        // Répondre avec un message de succès
        return response()->json(['message' => 'Commande créée avec succès !']);
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
