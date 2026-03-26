@extends('layout.nav_artisan')
@section('content')
<section role="main" class="content-body content-body-modern">
    <div class="full-page-form">
        <!-- Formulaire pour l'édition de l'article -->
        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="styled-form" enctype="multipart/form-data">
            @csrf <!-- Protection CSRF -->
            @method('PUT') <!-- Méthode PUT pour la mise à jour -->
            
            <h1>Modifier un article</h1>

            <!-- Champ pour le nom -->
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" value="{{ $article->nom }}" required>
            </div>

            <!-- Champ pour la description -->
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="form-control" rows="5" required>{{ $article->description }}</textarea>
            </div>

            <!-- Champ pour le prix -->
            <div class="form-group">
                <label for="prix">Prix (€) :</label>
                <input type="number" id="prix" name="prix" class="form-control" step="0.01" value="{{ $article->prix }}" required>
            </div>

            <!-- Champ pour l'image -->
            <div class="form-group">
                <label for="image">Image (laisser vide si inchangée) :</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <!-- Afficher l'image actuelle -->
            @if($article->image)
            <div class="form-group">
                <label>Image actuelle :</label>
                <img src="{{ asset('storage/'.$article->image) }}" alt="Image de l'article" style="max-width: 100%; height: auto;">
            </div>
            @endif

            <!-- Bouton de soumission -->
            <button type="submit" class="submit-btn">MODIFIER</button>
        </form>
    </div>
</section>
@endsection


<style>
  /* Contexte général - remplir toute la page */
html,
body {
    height: 100%;
    margin: 0;
    font-family: 'Arial', sans-serif;
}

/* Contenant du formulaire plein écran */
.full-page-form {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background: linear-gradient(135deg, #e0eafc, #cfdef3); /* Dégradé subtil */
}

/* Formulaire central - Agrandi pour remplir davantage la page */
.styled-form {
    background-color: white;
    padding: 40px 50px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    max-width: 100%; /* Utiliser toute la largeur disponible */
    width: 90%; /* Ajuster la largeur selon tes besoins */
    height: 80%; /* Ajuster la hauteur pour qu'il soit plus grand */
    text-align: center;
    transition: transform 0.2s ease;
}

/* Animation légère sur le formulaire */
.styled-form:hover {
    transform: translateY(-5px);
}

/* Titre du formulaire */
.styled-form h1 {
    font-size: 1.8em;
    color: #333;
    margin-bottom: 20px;
}

/* Champs de saisie avec style épuré */
.form-group {
    margin: 15px 0;
    text-align: left;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

/* Bouton d'envoi */
.submit-btn {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    margin-top: 10px;
    transition: background-color 0.2s ease, transform 0.1s ease;
    width: 100%;
}

.submit-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Masquer les flèches dans le champ de saisie de type number */
.form-control::-webkit-inner-spin-button,
.form-control::-webkit-outer-spin-button {
    -webkit-appearance: none; /* Pour Chrome, Safari, Opera */
    margin: 0;
}

.form-control {
    -moz-appearance: textfield; /* Pour Firefox */
}

</style>