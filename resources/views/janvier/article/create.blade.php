@extends('layout.nav_artisan')
@section('content')
<section role="main" class="content-body content-body-modern">
    <div class="full-page-form">
        <form action="{{ route('articles.store') }}" method="POST" class="styled-form" enctype="multipart/form-data">
            @csrf <!-- Protection CSRF -->
            <h1>Créer un article</h1>

            <!-- Champ pour le nom -->
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}" required>
            </div>

            <!-- Champ pour la description -->
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <!-- Champ pour le prix -->
            <div class="form-group">
                <label for="prix">Prix (€) :</label>
                <input type="number" id="prix" name="prix" class="form-control" step="0.01" value="{{ old('prix') }}" required>
            </div>

            <!-- Champ pour l'image -->
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>
</section>

@endsection

<style>
/* Contexte général */
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #e0eafc, #cfdef3);
}

/* Conteneur principal */
.full-page-form {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

/* Formulaire */
.styled-form {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    text-align: center;
    transition: transform 0.2s ease;
}

.styled-form:hover {
    transform: translateY(-5px);
}

/* Titre */
.styled-form h1 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #333;
}

/* Champs */
.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-group label {
    font-size: 1rem;
    color: #555;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

/* Bouton */
.submit-btn {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.submit-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Suppression des flèches dans les champs de type number */
.form-control::-webkit-inner-spin-button,
.form-control::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.form-control {
    -moz-appearance: textfield;
}
</style>
