@extends('maintenance.basefront')
@section('title','Listes fonctions')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Fonctions employés</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter une fonction
            </button>
        </div>
</div>

<br>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Postes maintenance
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fonction</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fonction as $f)
                            <tr class="odd gradeX">
                                <td>{{ $f->idfonction }}</td>
                                <td>{{ $f->fonction }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.personnel.fonction.edit', $f->idfonction)}}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.personnel.fonction.destroy', $f) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editFonction))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("admin.personnel.fonction.index") }}';
                });
            });
        </script>
    @endif

    <!-- Modal Ajout Fonction -->
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFonctionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.personnel.fonction.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajoutFonctionLabel"> {{ isset($editFonction) ? 'Modifier fonction' : 'Ajouter une fonction' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom fonction</label>
                            <input name="fonction" class="form-control"
                            value="{{ old('fonction', $editFonction->fonction ?? '') }}" placeholder="..." required>

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
