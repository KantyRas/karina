@extends('maintenance.basefront')
@section('title','Toutes les familles')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Familles existants</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter une famille
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Aperçu des familles maintenance
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Dépôt</th>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($familles as $index => $f)
                            <tr class="odd gradeX">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $f->depot->nom }}</td>
                                <td>{{ $f->nom }}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.famille.edit', $f) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('util.gestion.depot.destroy', $f) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editFamille))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("util.gestion.famille.index") }}';
                });
            });
        </script>
    @endif
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFamilleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Formulaire Ajout Compte
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="modal-body">
                            <form action="{{ isset($editFamille) ? route('util.gestion.famille.update', $editFamille) : route('util.gestion.famille.store') }}" method="post">
                                @csrf
                                @if(isset($editFamille))
                                    @method('PUT')
                                @endif
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Dépôt</label>
                                    <select class="form-control" name="iddepot" required>
                                        <option value="">-- Choisir un dépôt --</option>
                                        @foreach($depots as $d)
                                            <option value="{{ $d->iddepot }}"
                                                {{ old("iddepot", $editFamille->iddepot ?? "") == $d->iddepot ? "selected" : "" }}>
                                                {{ $d->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Nom de la famille</label>
                                    <input type="text" name="nom" class="form-control" placeholder="..."
                                           value="{{ old('nom', $editFamille->nom ?? '') }}" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
