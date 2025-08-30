@extends('maintenance.basefront')
@section('title','Carnet')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les carnets d'enregistrements</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('carnet.create_carnet') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouveau carnet
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tâches
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Emplacement</th>
                                <th>Nom/Prénom</th>
                                <th>Matricule</th>
                                <th>Fonction</th>
                                <th>Fréquence</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td>1</td>
                                <td>Vérification Compresseur</td>
                                <td>Batiments A</td>
                                <td>Rakoto Jean</td>
                                <td>4521</td>
                                <td>Agent de maintenance</td>
                                <td>Hebdomadaire</td>
                                <td class="text-center">
                                    <a href="{{ route('carnet.fiche_carnet_historique') }}"
                                       class="btn btn-primary btn-circle"
                                       title="Checklist">
                                        <i class="fa fa-list-alt"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
