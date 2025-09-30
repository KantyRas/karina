@extends('maintenance.basefront')
@section('title','Historiques - Relevé Eau')
@section('content')

    <div class="col-lg-12">
        <h1 class="page-header">Historiques - Relevé Eau</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des relevés par Mois / Année
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mois</th>
                            <th>Année</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Exemples statiques uniquement pour Eau -->
                        <tr>
                            <td>1</td>
                            <td>Septembre</td>
                            <td>2025</td>
                            <td>2025-09-01</td>
                            <td>
                                <a href="{{ route('carnet.detail_historique_releve') }}" class="btn btn-info btn-xs">
                                    Afficher
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Août</td>
                            <td>2025</td>
                            <td>2025-08-01</td>
                            <td>
                                <a href="{{ route('carnet.detail_historique_releve') }}" class="btn btn-info btn-xs">
                                    Afficher
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Juillet</td>
                            <td>2025</td>
                            <td>2025-07-01</td>
                            <td>
                                <a href="{{ route('carnet.detail_historique_releve') }}" class="btn btn-info btn-xs">
                                    Afficher
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
