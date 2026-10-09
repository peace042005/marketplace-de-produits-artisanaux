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
        // Uniquement les articles de l'artisan connecté
        $articles = Article::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

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

    public function edit(string $id)
    {
        $article = $this->articleDeLArtisan($id);

        return view('janvier/article.edit', compact('article'));
    }

    public function update(Request $request, string $id)
    {
        $article = $this->articleDeLArtisan($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('article', 'public');
        } else {
            unset($validated['image']);
        }

        $article->update($validated);

        return redirect()->route('janvier.article.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $article = $this->articleDeLArtisan($id);
        $article->delete();

        return redirect()->route('janvier.article.index')->with('status', 'Article supprimé avec succès');
    }

    /**
     * Récupère un article en vérifiant qu'il appartient à l'artisan connecté.
     */
    private function articleDeLArtisan(string $id): Article
    {
        return Article::where('user_id', Auth::id())->findOrFail($id);
    }
}
