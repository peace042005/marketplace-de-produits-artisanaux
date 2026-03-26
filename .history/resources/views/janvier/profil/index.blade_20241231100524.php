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
                @if ($user->photo_profil)
                <img src="{{ asset('/storage/' . $user->photo_profil) }}" alt="Photo de profil" style="max-width: 200px;">
                @else
                    <p>Aucune photo de profil disponible.</p>
                @endif
            
                                
                
                <h4>{{ $user->nom }} {{ $user->prenom }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">INFORMATIONS PERSONNELLES</h5>
                <div class="row mb-4">
                    <div class="col-lg-4">
                        <p><strong>Sexe :</strong> {{ $user->sexe }}</p>
                    </div>
                    <div class="col-lg-4">
                        <p><strong>Poids :</strong> {{ $user->poids ?? 'Non renseigné' }} kg</p>
                    </div>
                    <div class="col-lg-4">
                        <p><strong>Taille :</strong> {{ $user->taille ?? 'Non renseigné' }} cm</p>
                    </div>   
                </div>

                <div class="row mb-4">
                    <div class="col-lg-4">
                        <p><strong>Date de naissance :</strong> {{ $user->date_naissance }}</p>
                    </div>
                    <div class="col-lg-4">
                        <p><strong>Téléphone :</strong> {{ $user->telephone }}</p>
                    </div>
                    <div class="col-lg-4">
                        <p><strong>Adresse :</strong> {{ $user->adresse ?? 'Non renseignée' }}</p>
                    </div>   
                </div>
                <div class="row mb-4">
                   <p><strong>Biographie :</strong> {{ $user->biographie ?? 'Non renseignée' }}</p>
                </div>
            </div>
        </div>

        <!-- Bouton pour rediriger vers la page de modification -->
        <div class="text-center mt-4">
            <a href="{{ route('artisan.profil.edit') }}" class="btn btn-primary">Modifier mon profil</a>
        </div>
    </div>
</section>

<style>
    /* Styling for the overall page layout */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9;
    color: #333;
}

/* Section title */
h1 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
}

/* Card Styling */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #eba0d2;
    margin-bottom: 20px;
}

.card-body {
    padding: 30px;
    background-color: #75c5eb;
}

/* Profile Image */
.card-body img {
    border-radius: 50%;
    border: 5px solid #4e73df;
    margin-bottom: 20px;
    max-width: 150px;
    height: auto;
}

.card-body h4 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #333;
}

.card-body p {
    font-size: 16px;
    color: #555;
}

/* Information section */
.card-body p strong {
    color: darkslategray;
}

/* Button styling */
.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2e59d9;
}

/* Spacer for layout */
.mt-4 {
    margin-top: 30px;
}

/* Personal Info Section */
.card-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.card-body p {
    font-size: 14px;
    line-height: 1.6;
}

.card-body p:not(:last-child) {
    margin-bottom: 10px;
}

/* Responsive design */
@media (max-width: 768px) {
    .card-body img {
        max-width: 120px;
    }

    .card-body h4 {
        font-size: 20px;
    }

    .card-body p {
        font-size: 14px;
    }

    .btn-primary {
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
