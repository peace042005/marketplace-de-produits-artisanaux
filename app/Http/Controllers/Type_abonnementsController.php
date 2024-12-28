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
        } elseif ($role_id == 2) {
            return view('janvier.abonnement.index', compact('type_abonnements'));
        }
    }
    public function showView()
    {
        return view('marcella.type_abonnements.index'); // Le nom de la vue que vous voulez afficher
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
        Type_abonnement::create($request->all());
        $type_abonnements=Type_abonnement::all();
        return view("marcella.type_abonnements.index",compact("type_abonnements"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type_abonnement = Type_abonnement::find($id);
        return view("marcella.type_abonnements.show", compact("type_abonnement"));
    }

    /**
     * Show the form for editing the specified resource.page pour pouvoir effectuer une modification
     */
    public function edit(string $id)
    {
        $type_abonnement = Type_abonnement::find($id);
        return view("marcella.type_abonnements.edit", compact("type_abonnement"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type_abonnement = Type_abonnement::find($id);
        $type_abonnement->update($request->all());
        $type_abonnements=Type_abonnement::all();
        return view("marcella.type_abonnements.index", compact("type_abonnements"));
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



}
