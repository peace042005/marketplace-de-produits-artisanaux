@extends('layout.nav_artisan')

@section('css')
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/animate/animate.compat.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/dataTables.bootstrap5.css') }}" />

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

<!-- Skin CSS -->
<link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<!-- Head Libs -->
<script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
@endsection

@section('content')
<section role="main" class="content-body content-body-modern">
    <header class="page-header">
        <h2>Modifier mon profil</h2>
    </header>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container my-4">
        <h1 class="mb-4">Modifier les informations de {{ $user->nom }} {{ $user->prenom }}</h1>

        <!-- Bouton de retour -->
        <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Retour</button>

        <form action="{{ route('artisan.profil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center"> MODIFIER MON PROFIL </h5>

                    <div class=" row mb-3">
                        <label for="photo_profil" class="form-label">Photo de profil</label>
                        <input type="file" class="form-control" id="photo_profil" name="photo_profil">
                        @if ($user->photo_profil)
                            <img src="{{ asset('storage/' . $user->photo_profil) }}" alt="Photo actuelle" width="150" class="mt-3">
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="poids" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control" id="poids" name="poids" value="{{ old('poids', $user->poids) }}" step="0.1">
                        </div>
                        <div class="col-lg-6">
                            <label for="taille" class="form-label">Taille (cm)</label>
                            <input type="number" class="form-control" id="taille" name="taille" value="{{ old('taille', $user->taille) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}">
                           
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="biographie" class="form-label">Biographie</label>
                        <textarea class="form-control" id="biographie" name="biographie">{{ old('biographie', $user->biographie) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
</section>
<style>
    /* Styling général de la page */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9;
    color: #333;
}

/* Titre de la page */
h2 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
}

/* Titre secondaire */
h1 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

/* Bouton de retour */
.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    font-size: 16px;
    padding: 8px 20px;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

/* Formulaire et labels */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #eba0d2;
    margin-bottom: 30px;
}

.card-body {
    padding: 30px;
    background-color: #75c5eb;
}

/* Image de profil */
.card-body img {
    border-radius: 50%;
    border: 5px solid #4e73df;
    margin-bottom: 20px;
    max-width: 150px;
    height: auto;
}

.card-body .form-label {
    font-weight: 600;
    color: #333;
}

/* Champs de formulaire */
.form-control {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
}

/* Bouton de soumission */
.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2e59d9;
}

/* Espaceur pour les sections */
.mb-3 {
    margin-bottom: 25px;
}

.mt-3 {
    margin-top: 20px;
}

/* Alertes de statut */
.alert-success {
    background-color: #28a745;
    color: white;
    font-weight: 600;
    margin-bottom: 30px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-body img {
        max-width: 120px;
    }

    .card-body h4 {
        font-size: 20px;
    }

    .form-control {
        font-size: 13px;
    }

    .btn-primary, .btn-secondary {
        font-size: 14px;
        padding: 8px 16px;
    }
}

</style>
@endsection


@section('js')
<!-- Vendor Scripts -->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Theme Scripts -->
<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/theme.init.js') }}"></script>
@endsection
