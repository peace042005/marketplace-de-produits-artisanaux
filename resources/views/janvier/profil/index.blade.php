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
        <h2></h2>
    </header>
    <div class="container my-4">
        <h1 class="mb-4">Profil de {{ $user->nom }} {{ $user->prenom }}</h1>

        <div class="card">
            <div class="card-body text-center">
                <img src="{{ $user->photo_profil ?? asset('default-profile.png') }}" alt="Photo de profil" class="rounded-circle mb-3" width="150">
                <h4>{{ $user->nom }} {{ $user->prenom }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Informations personnelles</h5>
                <p><strong>Sexe :</strong> {{ $user->sexe }}</p>
                <p><strong>Poids :</strong> {{ $user->poids ?? 'Non renseigné' }} kg</p>
                <p><strong>Taille :</strong> {{ $user->taille ?? 'Non renseigné' }} cm</p>
                <p><strong>Date de naissance :</strong> {{ $user->date_naissance }}</p>
                <p><strong>Téléphone :</strong> {{ $user->telephone }}</p>
                <p><strong>Adresse :</strong> {{ $user->adresse ?? 'Non renseignée' }}</p>
                <p><strong>Biographie :</strong> {{ $user->biographie ?? 'Non renseignée' }}</p>
            </div>
        </div>

        <!-- Bouton pour rediriger vers la page de modification -->
        <div class="text-center mt-4">
            <a href="{{ route('artisan.profil.edit') }}" class="btn btn-primary">Modifier mon profil</a>
        </div>
    </div>
</section>
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
