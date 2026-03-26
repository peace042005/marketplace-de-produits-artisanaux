@extends('layout.nav_artisan')
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
@if($commandes->isEmpty())
        <p>Aucune commande reçue pour le moment.</p>
@else
<section role="main" class="content-body content-body-modern">
        <header class="page-header">
            <h2></h2>

        </header>
        
   
        <table>
            <thead>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Date de la commande</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->numero }}</td>
                        <td>{{ $commande->date_commande }}</td>
                        <td>{{ $commande->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <section class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="mb-3">
                        <a id="addToTable" class="btn btn-primary" href="">
                            Renouveller mon abonnement 
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Numéro de commande</th>
                        <th>Date de la commande</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artisan->commandes as $commande)
                        <tr>
                            <td>{{ $commande->numero }}</td>
                            <td>{{ $commande->date_commande }}</td>
                            <td>{{ $commande->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
</section>
<style>
    /* Tableau et bouton */
    .table {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .table .btn {
        border-radius: 4px;
        padding: 6px 12px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .table .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .table .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .table .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .table .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    #addToTable {
        background-color: #28a745;
        border-color: #28a745;
        padding: 8px 16px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    #addToTable:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: scale(1.05);
    }



    .content-body-modern {
        padding: 30px;
        background-color: #77b4e6;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .page-header h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .table td, .table th {
        padding: 12px;
        text-align: left;
    }

    .card {
        margin-bottom: 30px;
    }

    .table img {
        border-radius: 5px;
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

</style>

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


{{-- <h1>Commandes de l'artisan : {{ $artisan->nom }}</h1> --}}


