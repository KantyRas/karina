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
                            <tr class="odd gradeX">
                                <td>1</td>
                                <td>Fournitures</td>
                                <td>Famille 1</td>
                                <td class="text-center">
                                    <a href="#"
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('maintenance.shared.modal', [
    'id' => 'ajoutModal',
    'labelId' => 'ajoutFamilleLabel',
    'title' => 'Ajout Famille',
    'action' => '#',
    'body' => '
        <div class="form-group mb-3">
            <label class="font-weight-bold">Dépôt</label>
            <select class="form-control">
                <option value="">-- Choisir un dépôt --</option>
                <option value="1">Dépôt 1</option>
                <option value="2">Dépôt 2</option>
                <option value="3">Dépôt 3</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold">Nom de la famille</label>
            <input type="text" class="form-control" placeholder="..." required>
        </div>
    '
])

@endsection
