@extends('maintenance.basefront')
@section('title','unités')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Unités</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter Unité
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Unités utilisés
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Unité</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unites as $index => $u)
                            <tr class="odd gradeX">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $u->unite }}</td>
                                <td class="text-center">
                                    <a href="{{ route('util.gestion.unite.edit',$u) }}"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block; margin-left:3px;">
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
    @if(isset($editUnite))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("util.gestion.unite.index") }}';
                });
            });
        </script>
    @endif
    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutUniteLabel',
        'title' => 'Ajout Unité',
        'action' => isset($editUnite) ? route('util.gestion.unite.update', $editUnite) : route('util.gestion.unite.store'),
        'parametre' => $editUnite ?? null,
        'body' => '
            <div class="form-group mb-3">
                <label class="font-weight-bold">Unité</label>
                <input type="text" class="form-control" name="unite" placeholder="..." required value="' . old('unite', $editUnite->unite ?? '') . '">
            </div>
        '
    ])
@endsection
