@extends('maintenance.basefront')
@section('title','Listes employés')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Localisations</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter emplacements
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Aperçu des différents localisations
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Emplacement</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($emplacements as $emplacement)
                            <tr class="odd gradeX">
                                <td>{{ $emplacement->idemplacement }}</td>
                                <td>{{ $emplacement->emplacement }}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.emplacement.edit', $emplacement->idemplacement) }}"
                                        class="btn btn-success btn-circle"
                                        title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('util.gestion.emplacement.destroy', $emplacement) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editEmplacement))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#ajoutModal').modal('show');

            $('#ajoutModal').on('hidden.bs.modal', function () {
                window.location.href = '{{ route("util.gestion.emplacement.index") }}';
            });
        });
    </script>
    @endif
<!-- Modal -->
<div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFonctionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ isset($editEmplacement) ? route('util.gestion.emplacement.update', $editEmplacement->idemplacement) : route('util.gestion.emplacement.store') }}" method="POST">
                @csrf
                @if(isset($editEmplacement))
                @method('PUT')
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="ajoutFonctionLabel">Formulaire ajout emplacement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Emplacement</label>
                        <input name="emplacement" class="form-control"
                        value="{{ old('emplacement', $editEmplacement->emplacement ?? '') }}" placeholder="..." required>
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
