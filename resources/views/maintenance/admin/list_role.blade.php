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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $index => $role)
                            <tr class="odd gradeX">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $role->role }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.personnel.role.edit', $role) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.personnel.role.destroy',$role) }}" method="POST" style="display:inline-block; margin-left:3px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-circle"
                                                title="Supprimer">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($editRole))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("admin.personnel.role.index") }}';
                });
            });
        </script>
    @endif
<!-- Modal Ajout Fonction -->
<div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFonctionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ isset($editRole) ? route('admin.personnel.role.update', $editRole->idrole) : route('admin.personnel.role.store') }}"
                  method="post">
                @csrf
                @if(isset($editRole))
                    @method('PUT')
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="ajoutFonctionLabel">
                        {{ isset($editRole) ? 'Modifier rôle' : 'Ajouter rôle' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom rôle</label>
                        <input name="role" class="form-control" placeholder="..."
                               value="{{ old('role', $editRole->role ?? '') }}" required>
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
