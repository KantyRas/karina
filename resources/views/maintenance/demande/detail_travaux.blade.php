@extends('maintenance.basefront')
@section('title', "Détails de la demande")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header text-primary">
            <i class="fa fa-info-circle"></i> Détails de la demande de travaux
        </h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('demande.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Achats matériels
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default shadow-sm">
                <div class="panel-heading font-weight-bold">
                    Informations principales
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:25%;">Département</th>
                            <td>Nom departement</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>Nom section</td>
                        </tr>
                        <tr>
                            <th>Type de demande</th>
                            <td>Maintenace génerale</td>
                        </tr>
                        <tr>
                            <th>Travaux demandés</th>
                            <td>Rennovation</td>
                        </tr>
                        <tr>
                            <th>Responsable</th>
                            <td>Stephane</td>
                        </tr>
                        <tr>
                            <th>Demandeur</th>
                            <td>Tsaiko</td>
                        </tr>
                        <tr>
                            <th>Date souhaitée</th>
                            <td>{{ date('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Nº de série</th>
                            <td>213595626</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="panel panel-default shadow-sm">
                <div class="panel-heading font-weight-bold">
                    Description et motifs
                </div>
                <div class="panel-body">
                    <p><strong>Motif :</strong></p>
                    <p>Motif de test loun</p>
                    <hr>
                    <p><strong>Description détaillée :</strong></p>
                    <p>Aucune description</p>
                </div>
            </div>

            <div class="panel panel-default shadow-sm">
                <div class="panel-heading font-weight-bold">
                    Pièces jointes
                </div>
                <div class="panel-body">
                    <a href="#" class="btn btn-info" target="_blank">
                        <i class="fa fa-download"></i> Télécharger le fichier
                    </a>
                    <p class="text-muted">Aucun fichier attaché</p>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('demande.liste_demande_travaux') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
@endsection
