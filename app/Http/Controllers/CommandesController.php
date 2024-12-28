<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
