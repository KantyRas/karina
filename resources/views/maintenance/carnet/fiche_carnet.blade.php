@extends('maintenance.basefront')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">
            Historiques de la fiche du Carnet : Sécurité Machine
        </h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('carnet.create_carnet') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouveau carnet
            </a>
        </div>
    </div>
    {{-- Tableau des fiches mensuelles/annuelles --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Historique par mois</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Période</th>
                                <th>Date de création</th>
                                <th>Dernière mise à jour</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Juillet 2025</td>
                                <td>01/07/2025</td>
                                <td>31/07/2025</td>
                                <td>Clôturée</td>
                                <td>
                                    <a href="{{ route('carnet.fiche_saisie') }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Août 2025</td>
                                <td>01/08/2025</td>
                                <td>13/08/2025</td>
                                <td>En cours</td>
                                <td>
                                    <a href="{{ route('carnet.fiche_saisie') }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Voir
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
