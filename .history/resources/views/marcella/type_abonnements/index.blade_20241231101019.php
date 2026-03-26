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

    <!-- start: page -->
    <section class="card">
        
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <a id="addToTable" class="btn btn-primary" href="{{ route('type_abonnements.create') }}">Add <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>DURER</th>
                        <th>PRIX</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($type_abonnements as $type_abonnement)
                    <tr data-item-id="1">
                        <td>{{ $type_abonnement->type }}</td>
                        <td>{{ $type_abonnement->duree }} jours</td>
                        <td>{{ $type_abonnement->prix }}</td>
                        <td class="actions">
                            <a href="{{ route('type_abonnements.edit', $type_abonnement->id) }}" class="btn btn-sm btn-primary" style="color: white;">
                                <i class="fas fa-pencil-alt"></i> MODIFIER
                            </a>
                            @csrf
                            @method("DELETE")
                            <button type="button" class="on-default remove-row btn btn-sm btn-danger"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalConfirm"  
                                data-id="{{ $type_abonnement->id }}">
                                <i class="far fa-trash-alt"></i> SUPPRIMER
                            </button>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
<div id="modalConfirm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- En-tête avec style personnalisé -->
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Corps du modal -->
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce type d'abonnement ? Cette action est irréversible.</p>
            </div>
            <!-- Pied du modal avec style -->
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteForm = document.getElementById('deleteForm');
    
    document.querySelectorAll('.remove-row').forEach(function (button) {
        button.addEventListener('click', function () {
            // Capture l'ID de l'élément à supprimer
            const typeId = this.getAttribute('data-id');
            
            // Mettre à jour l'URL de l'action avec l'ID dynamique
            deleteForm.setAttribute('action', `/type_abonnements/${typeId}`);
        });
    });
});
</script>


@endsection
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

<style>
    /* Modal principal */
    #modalConfirm .modal-content {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* En-tête du modal */
    #modalConfirm .modal-header {
        background: linear-gradient(to right, #ff6a95, #ee0979);
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        text-align: center;
    }

    #modalConfirm .modal-title {
        font-weight: bold;
        font-size: 18px;
    }

    /* Corps du modal */
    #modalConfirm .modal-body p {
        font-size: 16px;
        color: #555;
    }

    /* Pied du modal */
    #modalConfirm .modal-footer {
        justify-content: space-between;
    }

    #modalConfirm .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #modalConfirm .btn-danger:hover {
        background-color: #c0392b;
    }

    #modalConfirm .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #modalConfirm .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    /* Ajout d'ombre au pied du modal */
    #modalConfirm .modal-footer button {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>
