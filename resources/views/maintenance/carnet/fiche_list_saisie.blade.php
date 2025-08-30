@extends('maintenance.basefront')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">
            Fiche du mois 08/2025 - Carnet Sécurité Machine
        </h1>
    </div>

    {{-- Historique des saisies --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Listes des saisies</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employé</th>
                                {{-- Parametres --}}
                                <th>Température</th>
                                <th>Pression</th>
                                <th>Niveau huile</th>
                                <th>Observations</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>2025-08-01</td>
                                <td>Rakoto Jean</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>RAS</td>
                            </tr>
                            <tr>
                                <td>2025-08-02</td>
                                <td>Rasoa Marie</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>RAS</td>
                            </tr>
                            <tr>
                                <td>2025-08-03</td>
                                <td>Rakoto Jean</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>Ok</td>
                                <td>A reparer</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
