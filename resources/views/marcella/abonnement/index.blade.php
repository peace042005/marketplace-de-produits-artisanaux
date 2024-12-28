@extends('layout.nav')
@section('css')
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">

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
<div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                        </div>
                    </div>
                </div>
<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
    <thead>
        <tr>
            <th>Nom artisan</th>
            <th>Type abonnement</th>
            <th>Date début</th>
            <th>Date fin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($abonnements as $abonnement)
            @php
                // Récupération de la date de début depuis la base de données
                $dateDebut = \Carbon\Carbon::parse($abonnement->date_debut);

                // Vérifier si le typeAbonnement existe avant de calculer la date
                $dureeAbonnement = $abonnement->typeAbonnement ? $abonnement->typeAbonnement->duree : 0;

                // Calculer la date de fin en ajoutant la durée en jours
                $dateFin = $dateDebut->copy()->addDays($dureeAbonnement);
            @endphp
            <tr data-item-id="1">
                <td>{{ $abonnement->user->nom ?? 'N/A' }}</td>
                <td>{{ $abonnement->typeAbonnement ? $abonnement->typeAbonnement->type : 'N/A' }}</td>
                <td>{{ $dateDebut->toDateString() }}</td>
                <td>{{ $dateFin->toDateString() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

			</div>

</section>

@section('js')
<!-- Vendor -->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
<script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('vendor/common/common.js') }}"></script>
<script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

<!-- Specific Page Vendor -->
<script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('js/theme.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('js/theme.init.js') }}"></script>





<script src="{{asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>

 <!-- Examples -->
 <script src="{{ asset('js/examples/examples.datatables.tabletools.js') }}"></script>

@endsection
@endsection
