<?php

namespace App\Http\Controllers;

use App\Models\Type_abonnement;
use Illuminate\Http\Request;

class Type_abonnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_abonnements = Type_abonnement::all();
        $role_id = auth()->user()->role_id;
    
        // Vérification du rôle et retour des vues correspondantes
        if ($role_id == 1) {
            return view('marcella.type_abonnements.index', compact('type_abonnements'));
        }

        // Artisan : choix d'un type d'abonnement à souscrire
        return view('janvier.abonnements.create', ['typesAbonnement' => $type_abonnements]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("marcella.type_abonnements.create");
    }

    /**
     * Store a newly created resource in storage.inserer dans la base de donnee
     */
    public function store(Request $request)
    {
        Type_abonnement::create($this->validateTypeAbonnement($request));

        return redirect()->route('type_abonnements.index')->with('success', "Type d'abonnement créé.");
    }

    /**
     * Show the form for editing the specified resource.page pour pouvoir effectuer une modification
     */
    public function edit(string $id)
    {
        $type_abonnement = Type_abonnement::findOrFail($id);
        return view("marcella.type_abonnements.edit", compact("type_abonnement"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type_abonnement = Type_abonnement::findOrFail($id);
        $type_abonnement->update($this->validateTypeAbonnement($request));

        return redirect()->route('type_abonnements.index')->with('success', "Type d'abonnement mis à jour.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Récupérer et supprimer l'abonnement
        $typeAbonnement = Type_abonnement::findOrFail($id);
        $typeAbonnement->delete();

    return redirect()->route('type_abonnements.index');

    }

    /**
     * Règles de validation d'un type d'abonnement.
     */
    private function validateTypeAbonnement(Request $request): array
    {
        return $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric', 'min:0'],
            'duree' => ['required', 'integer', 'min:1'],
        ]);
    }
}
