<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::all();
        return view("paiements.index", compact("paiements"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("paiements.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Paiement::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paiement = Paiement::find($id);
        return view("paiements.show", compact("paiement"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paiement = Paiement::find($id);
        return view("paiements.edit", compact("paiement"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paiement = Paiement::find($id);
        $paiement->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paiement = Paiement::find($id);
        $paiement->delete();
    }
}
