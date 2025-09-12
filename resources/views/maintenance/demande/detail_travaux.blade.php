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
                            <td>{{ $details->section->departement->nom ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $details->section->nomsection ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Type de demande</th>
                            <td>{{ $details->typeDemande->nomtype ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Travaux demandés</th>
                            <td>{{ $details->typeTravaux->type ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Responsable</th>
                            <td>{{ $details->section->departement->responsable ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Demandeur</th>
                            <td>{{ $details->demandeur }}</td>
                        </tr>
                        <tr>
                            <th>Date souhaitée</th>
                            <td>{{ $details->datesouhaite }}</td>
                        </tr>
                        <tr>
                            <th>Nº de série</th>
                            <td>{{ $details->numeroserie ?? '-' }}</td>
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
                    <p>{{ $details->motif ?? '-' }}</p>
                    <hr>
                    <p><strong>Description détaillée :</strong></p>
                    <p>{{ $details->description ?? '-' }}</p>
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
