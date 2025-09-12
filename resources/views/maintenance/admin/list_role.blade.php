@extends('maintenance.basefront')
@section('title','Rôles')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Rôles utilisateurs</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter rôles
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Aperçu des différents rôles
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="rolesTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="tablesBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="vueForm">
                @csrf
                <input type="hidden" id="model_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="formTitle">
                        Ajouter rôle
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom rôle</label>
                        <input name="role" id="role" class="form-control" placeholder="..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            loadRoles();
            // Charger liste
            function loadRoles() {
                $.ajax({
                    url: "{{ route('admin.personnel.role.index') }}",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = "";
                        data.forEach((role, index) => {
                            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${role.role}</td>
                    <td class="text-center">
                        <button class="btn btn-success btn-circle editBtn" data-id="${role.idrole}" data-name="${role.role}">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-circle deleteBtn" data-id="${role.idrole}">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>`;
                        });
                        $("#tablesBody").html(rows);
                    }
                });
            }
            // Fonction pour afficher un message comme Laravel
            function showMessage(type, message) {
                $("#flash-message").html(`
                <div class="alert alert-${type} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">&times;</button>
                    ${message}
                </div>
            `);
                setTimeout(() => {
                    $("#flash-message").html('');
                }, 3000);
            }
            // Ajouter / Modifier
            $("#vueForm").submit(function (e) {
                e.preventDefault();
                let id = $("#model_id").val();
                let url = id ? "{{ url('admin/role') }}/" + id : "{{ route('admin.personnel.role.store') }}";
                let method = id ? "PUT" : "POST";

                $.ajax({
                    url: url,
                    type: method,
                    data: { role: $("#role").val(), _token: "{{ csrf_token() }}" },
                    success: function (res) {
                        $('#ajoutModal').modal('hide');
                        $("#vueForm")[0].reset();
                        $("#model_id").val('');
                        loadRoles();
                        showMessage('success', res.message);
                    },
                    error: function (xhr) {
                        showMessage('danger', 'Une erreur est survenue !');
                    }
                });
            });
            // Edit
            $(document).on("click", ".editBtn", function () {
                $("#model_id").val($(this).data("id"));
                $("#role").val($(this).data("name"));
                $("#formTitle").text("Modifier rôle");
                $('#ajoutModal').modal('show');
            });
            // Delete
            $(document).on("click", ".deleteBtn", function () {
                if (confirm("Supprimer ce rôle ?")) {
                    $.ajax({
                        url: "{{ url('admin/role') }}/" + $(this).data("id"),
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (res) {
                            loadRoles();
                            showMessage('success', res.message);
                        },
                        error: function () {
                            showMessage('danger', 'Erreur lors de la suppression !');
                        }
                    });
                }
            });
            // Reset modal en ajout
            $('#ajoutModal').on('hidden.bs.modal', function () {
                $("#formTitle").text("Ajouter rôle");
                $("#vueForm")[0].reset();
                $("#model_id").val('');
            });
        });
    </script>
@endsection
