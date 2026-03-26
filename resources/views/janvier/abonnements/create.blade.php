@extends('layout.nav_artisan')

@section('content')
<section role="main" class="content-body content-body-modern">
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-primary">Formulaire d'Abonnement</h2>

        <form action="{{ route('abonnements.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            @csrf

            <div class="form-group mb-3">
                <label for="type_abonnement_id" class="form-label text-info">Type d'abonnement :</label>
                <select id="type_abonnement_id" name="type_abonnement_id" class="form-select">
                    <option value="">Sélectionnez un type d'abonnement</option>
                    @foreach ($typesAbonnement as $type_abonnement)
                        <option value="{{ $type_abonnement->id }}">{{ $type_abonnement->type }}</option>
                    @endforeach
                </select>
                @error('type_abonnement_id')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg px-4 py-2">Soumettre</button>
            </div>
        </form>
    </div>
</section>
@endsection
<style>
        /* Personnalisation des couleurs */
    body {
        background-color: #f4f7f6; /* Couleur de fond de la page */
    }

    h2 {
        color: #007bff; /* Couleur bleue personnalisée pour le titre */
    }
    

   .form-label {
    
    font-size: 1.25rem; /* Augmenter la taille de la police */
    height: 50px; /* Augmenter la hauteur */
    padding: 10px; /* Augmenter l'espacement intérieur */

   }
    .form-select {
        border-color: #4caf50; /* Bordure verte pour le champ select */
    }

    .form-select:focus {
        border-color: #28a745; /* Bordure verte plus foncée lors du focus */
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Ombre lors du focus */
    }

    button[type="submit"] {
        background-color: #28a745; /* Bouton vert personnalisé */
        border-color: #28a745;
    }

    button[type="submit"]:hover {
        background-color: #218838; /* Couleur du bouton lorsqu'on survole */
        border-color: #1e7e34;
    }

</style>