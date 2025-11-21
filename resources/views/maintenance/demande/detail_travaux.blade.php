@extends('maintenance.basefront')
@section('title', "Détails de la demande")
@section('content')
@php
    $user = Auth::user();
@endphp
    <div class="col-lg-12">
        <h1 class="page-header text-primary">
            <i class="fa fa-info-circle"></i> Détails de la demande de travaux
        </h1>

        <div class="text-right" style="margin-bottom:15px;">
            @if($details->statut == 0 && $user->iduser == $details->typeDemande->id_receveur)
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajoutModal">
                    <i class="fa fa-check"></i> Valider
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#refusModal">
                    <i class="fa fa-times"></i> Refuser
                </button>
            @endif
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
                            <th>Date de livraison souhaitée</th>
                            <td>{{ \Carbon\Carbon::parse($details->datesouhaite)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Date réelle</th>
                            <td>{{ $details->datereelle ? \Carbon\Carbon::parse($details->datereelle)->format('d/m/Y') : '' }}</td>
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
                    @forelse($details->fichiers as $fichier)
                        <a href="{{ asset('storage/'.$fichier->fichier) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                           target="_blank"
                           title="{{ basename($fichier->nom) }}">
                            <span>
                                <i class="fa fa-file mr-2"></i> {{ basename($fichier->nom) }}
                            </span>
                            <i class="fa fa-external-link-alt text-muted"></i>
                        </a>
                    @empty
                        <p class="text-muted text-center">Aucun fichier attaché</p>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('demande.liste_demande_travaux') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="validerModalLabel">Choisissez une action</h5>
              </div>

                <form action="{{ route('demande.update_date', $details->iddemandetravaux) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="datereelle" class="form-label fw-bold">Date réelle de livraison</label>
                            <input type="date" class="form-control" name="datereelle" id="datereelle" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="action" value="achat" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Achats matériels
                        </button>

                        <button type="submit" name="action" value="valider" class="btn btn-success">
                            Valider sans achat
                        </button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="refusModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="validerModalLabel">Choisissez une action</h5>
                </div>

                <div class="modal-body">
                    Raison de refus ?
                    <textarea class="form-control" name="refus">Raison de refus</textarea>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('demande.refuser', $details->iddemandetravaux) }}" class="btn btn-primary">
                        Valider
                    </a>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
@endsection
