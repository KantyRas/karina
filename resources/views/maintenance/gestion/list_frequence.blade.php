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
                            <tr class="odd gradeX">
                                <td>1</td>
                                <td>Hebdomadaire</td>
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
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFrequenceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <form action="#" method="#">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="ajoutFrequenceLabel">
                            <i class="fa fa-plus-circle"></i> Ajout Frequence
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Fréquence</label>
                            <input type="text" class="form-control" placeholder="..." required>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutFrequenceLabel',
        'title' => 'Ajout Frequence',
        'action' => '#',
        'body' => '
            <div class="form-group mb-3">
                <label class="font-weight-bold">Fréquence</label>
                <input type="text" class="form-control" placeholder="..." required>
            </div>
        '
    ])

@endsection
