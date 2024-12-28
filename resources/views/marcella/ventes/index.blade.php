@extends('layout.nav')  <!-- Inclure votre layout si nécessaire -->
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
    <div class="container">
        <h1>Évolution des Abonnements</h1>

        <!-- Graphique -->
        <canvas id="subscriptionsChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Inclure Chart.js -->
    <script>
       console.log('Chart.js chargé :', Chart);
    </script>

<script>
       document.addEventListener('DOMContentLoaded', function () {
    try {
        const abonnementsData = @json($abonnements);

        console.log('Données reçues :', abonnementsData);

        // Vérifier que les données existent et ont le bon format
        if (abonnementsData && abonnementsData.length > 0) {
            const labels = abonnementsData.map(item => item.date); // Les étiquettes
            const data = abonnementsData.map(item => item.total); // Les valeurs numériques

            console.log('Labels :', labels);
            console.log('Data :', data);

            const ctx = document.getElementById('subscriptionsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Type d'histogramme
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Abonnements',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            console.error('Aucune donnée trouvée pour l’histogramme');
        }
    } catch (error) {
        console.error('Erreur dans la récupération des données pour le graphique :', error);
    }
});

</script>

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
