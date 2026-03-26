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
        // Récupérer le produit sélectionné
        $produit = Produit::find($request->produit_id);
        
        // Créer une nouvelle commande et lier l'artisan via le produit
        $commande = Commande::create([
            'produit_id' => $produit->id,
            'quantite' => $request->quantite,
            'artisan_id' => $produit->artisan_id,  // Récupérer artisan_id depuis le produit
        ]);
    
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
