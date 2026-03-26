@extends('layout.nav')  <!-- Inclure votre layout si nécessaire -->

@section('css')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
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

<style>
    /* Style personnalisé */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f8fc;
    }

    .page-header h2 {
        font-size: 28px;
        color: #25d425; /* Couleur verte comme spécifiée */
        margin-bottom: 20px;
        text-align: center; /* Centrer le texte */
    }

    .container {
        background-color: #77b4e6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .container h1 {
        font-size: 30px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Style du graphique */
    #subscriptionsChart {
        max-width: 100%;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Styles des boutons et autres éléments */
    .btn-custom {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 12px 25px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .container h1 {
            font-size: 26px;
        }

        .page-header h2 {
            font-size: 24px;
        }
    }
</style>

@endsection

@section('content')

<section role="main" class="content-body content-body-modern">
    <header class="page-header">
        <h2>Suivi de l'évolution des abonnements</h2>
    </header>

    <div class="container">
        <h2>Évolution des Abonnements</h2>

        <!-- Graphique -->
        <canvas id="subscriptionsChart" width="400" height="200"></canvas>

        <!-- Optionnel : Bouton pour actions supplémentaires -->
        <div class="text-center mt-4">
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const abonnementsData = @json($abonnements);

                console.log('Données reçues :', abonnementsData);

                // Vérification des données
                if (abonnementsData && abonnementsData.length > 0) {
                    const labels = abonnementsData.map(item => item.date); // Les étiquettes
                    const data = abonnementsData.map(item => item.total); // Les valeurs

                    const ctx = document.getElementById('subscriptionsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar', // Type d'histogramme
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Abonnements',
                                data: data,
                                backgroundColor: 'rgba(75, 192, 192, 0.4)',
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
                            },
                            plugins: {
                                tooltip: {
                                    backgroundColor: '#333',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
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

@endsection

@section('js')
<!-- Scripts Vendor -->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('vendor/common/common.js') }}"></script>
<script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>

<!-- Specific Page Vendor Scripts -->
<script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('js/theme.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('js/theme.init.js') }}"></script>
@endsection
