<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Detail::all();
        return view("details.index", compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("details.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Detail::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail = Detail::find($id);
        return view("details.show", compact("detail"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = Detail::find($id);
        return view("details.edit", compact("detail"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail = Detail::find($id);
        $detail->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = Detail::find($id);
        $detail->delete();
    }
}
