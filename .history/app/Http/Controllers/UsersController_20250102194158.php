<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // return view("users.index", compact("users"));
         // Supposons que vous ayez un artisan connecté ou que vous le récupériez avec l'utilisateur actuel
        $artisan = Auth::user();  // Ou utilisez votre propre méthode pour récupérer l'artisan

        return view('janvier.article.index', compact('artisan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
    }

    /**
     * Display the specified resource.
     */

     public function showw($id)
    {
         $artisan = Artisan::with('commandes')->findOrFail($id);
     
         return view('janvier.commandes.index', compact('artisan'));
    }


    public function show(string $id)
    {
        $user = User::find($id);
        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
    
        return view('janvier.profil.edit', compact('user'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
    
        $validatedData = $request->validate([
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'poids' => 'nullable|numeric|min:0',
            'taille' => 'nullable|numeric|min:0',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'biographie' => 'nullable|string|max:500',
        ]);
    
        // Gestion de la photo de profil
        if ($request->hasFile('photo_profil')) {
            if ($user->photo_profil) {
                \Storage::delete($user->photo_profil);
            }
            $validatedData['photo_profil'] = $request->file('photo_profil')->store('photos_profil');
        }
    
        $user->update($validatedData);
    
        return redirect()->route('artisan.profil.index')->with('status', 'Profil mis à jour avec succès.');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
    }

}
