<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avis = Avis::all();
        return view("avis.index", compact("avis"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("avis.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Avis::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $avis = Avis::find($id);
        return view("avis.show", compact("avis"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $avis = Avis::find($id);
        return view("avis.edit", compact("avis"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $avis = Avis::find($id);
        $avis->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avis = Avis::find($id);
        $avis->delete();
    }
}
