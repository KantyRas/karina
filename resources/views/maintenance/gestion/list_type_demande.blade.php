@extends('maintenance.basefront')
@section('title','fréquences')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Types de demandes</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter Types
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Demandes crud
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Types</th>
                                <th>Responsable</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($typedemandes as $type)
                            <tr class="odd gradeX">
                                <td>{{$type->idtypedemande}}</td>
                                <td>{{$type->nomtype}}</td>
                                <td>{{ $type->receveur->username }}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.typedemandy.edit', $type) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('util.gestion.typedemandy.destroy', $type) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editType))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#ajoutModal').modal('show');

            $('#ajoutModal').on('hidden.bs.modal', function () {
                window.location.href = '{{ route("util.gestion.typedemandy.index") }}';
            });
        });
    </script>
    @endif
    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutTypeDemandeLabel',
        'title' => 'Ajout type Demande',
        'action' => isset($editType) ? route('util.gestion.typedemandy.update', $editType) : route('util.gestion.typedemandy.store'),
        'parametre' => $editType ?? null,
        'body' => '
            <div class="form-group mb-3">
                <label class="font-weight-bold">Types Demandes</label>
                <input type="text" class="form-control" name="nomtype" placeholder="..."  value="'.old('frequence', $editType->nomtype ?? ''). '" required>
            </div>
            <input type="hidden" name="id_receveur" value=1>
        '
    ])
@endsection
