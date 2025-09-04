@extends('maintenance.basefront')
@section('title','Listes employés')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Dépôts</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter Dépôt
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Aperçu des dépôts existants
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom dépôt</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($depots as $depot)
                            <tr class="odd gradeX">
                                <td>{{ $depot->iddepot}}</td>
                                <td>{{ $depot->nom }}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.depot.edit', $depot->iddepot) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('util.gestion.depot.destroy', $depot->iddepot) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editDepot))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#ajoutModal').modal('show');

            $('#ajoutModal').on('hidden.bs.modal', function () {
                window.location.href = '{{ route("util.gestion.depot.index") }}';
            });
        });
    </script>
    @endif

    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutDepotLabel',
        'title' => 'Ajout Dépôt',
        'action' => isset($editDepot) ? route('util.gestion.depot.update', $editDepot->iddepot) : route('util.gestion.depot.store'),
        'parametre' => '$editDepot',
        'body' => ' 
            <div class="form-group mb-3">
                <label class="font-weight-bold">Nom dépôt</label>
                <input type="text" name="nom" class="form-control" placeholder="..." value="'.old('nom', $editDepot->nom ?? ''). '" required>
            </div>
        '
    ])
@endsection
