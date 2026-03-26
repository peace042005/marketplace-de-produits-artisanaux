<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        // return response()->json($articles);
        return view("janvier/article.index", compact("articles"));
    }

    public function getArticles()
    {
        $articles = Article::orderBy('created_at', 'desc')
        ->select('id', 'nom as name', 'description', 'prix as price', 'image')
        ->get();

    return response()->json($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view("janvier/article.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Image optionnelle avec une taille max de 2MB
        ]);
    
        // Création de l'article
        $article = new Article();
        $article->nom = $request->nom;
        $article->description = $request->description;
        $article->prix = $request->prix;
        $article->user_id = Auth::id(); // Récupération de l'id de l'utilisateur connecté
    
        // Gestion de l'image (si elle est téléchargée)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article', 'public');
            $article->image = $imagePath;
        }
    
        // Enregistrement de l'article
        $article->save();
    
        // Redirection avec un message de succès
        return redirect()->route('janvier.article.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        return view("janvier/article.show", compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        return view("janvier/article.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        $article->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('janvier.article.index')->with('status', 'Article supprimé avec succès');
    }
}
