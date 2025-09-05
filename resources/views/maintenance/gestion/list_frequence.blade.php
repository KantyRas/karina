@extends('maintenance.basefront')
@section('title','fréquences')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Fréquences</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter Fréquence
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Fréquences crud
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fréquence</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($frequences as $frequence)
                            <tr class="odd gradeX">
                                <td>{{ $frequence->idfrequence}}</td>
                                <td>{{ $frequence->frequence}}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.frequence.edit', $frequence) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('util.gestion.frequence.destroy', $frequence) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editFrequence))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#ajoutModal').modal('show');

            $('#ajoutModal').on('hidden.bs.modal', function () {
                window.location.href = '{{ route("util.gestion.frequence.index") }}';
            });
        });
    </script>
    @endif
    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutFrequenceLabel',
        'title' => 'Ajout Frequence',
        'action' => isset($editFrequence) ? route('util.gestion.frequence.update', $editFrequence->idfrequence) : route('util.gestion.frequence.store'),
        'parametre' => $editFrequence ?? null,
        'body' => '
            <div class="form-group mb-3">
                <label class="font-weight-bold">Fréquence</label>
                <input type="text" name="frequence" class="form-control" placeholder="..." value="'.old('frequence', $editFrequence->frequence ?? ''). '" required>
            </div>
        '
    ])

@endsection
