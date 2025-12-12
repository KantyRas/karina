@extends('maintenance.basefront')
@section('title', 'Détails de la demande d\'achat')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="fa fa-file-text me-2"></i> Détails de la Demande d'Achat
        </h3>
    </div>
    <hr>
    <div style="padding: 10px;">
        <div>
            {{-- && $user->iduser == $details->idreceveur--}}
            @if($details->statut == 0 )
                <a href="{{ route('demande.valider_achat', $details->iddemandeachat) }}" class="btn btn-success">
                    <i class="fa fa-check"></i> Valider
                </a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#refusModal">
                    <i class="fa fa-times"></i> Refuser
                </button>
            @endif
        </div>
        <div class="text-right" style="margin-top:-33px;">
            <a href="{{ route('demande.achat_exportExcel', $details->iddemandeachat) }}" class="btn btn-success">
                <i class="fa fa-download"></i> Exporter en Excel
            </a>
            <a href="{{ route('demande.exportPdf', $details->iddemandeachat) }}" class="btn btn-warning">
                <i class="fa fa-file-text"></i> Exporter en PDF
            </a>
        </div>
    </div>
    <div class="panel panel-default shadow-sm">
        <div class="panel-heading font-weight-bold">
            <i class="fa fa-info-circle me-2"></i> Informations Générales
        </div>
        <div class="panel-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Numéro :</p>
                    <h6 class="fw-bold">Achat/nº{{ str_pad($details->iddemandeachat, 4, '0', STR_PAD_LEFT) }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Demandeur :</p>
                    <h6 class="fw-bold">{{ $details->demandeur->username }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Date :</p>
                    <h6 class="fw-bold">{{ \Carbon\Carbon::parse($details->datedemande)->format('d/m/Y') }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Demande Travaux liée :</p>
                    <h6 class="fw-bold">
                        {{ $details->iddemande_travaux
                        ? 'Travaux/nº' . str_pad($details->iddemande_travaux, 4, '0', STR_PAD_LEFT)
                        : '-' }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="panel panel-default shadow-sm0">
        <div class="panel-heading font-weight-bold">
            Articles Demandés
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-success">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 15%">Code Article</th>
                        <th style="width: 40%">Désignation</th>
                        <th style="width: 20%">Quantité demandée</th>
                        <th style="width: 20%">Unité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($details->detailArticles as $index => $article)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td class="fw-bold text-primary">{{ $article->article->code }}</td>
                            <td>{{ $article->article->designation }}</td>
                            <td class="fw-bold">{{ $article->quantitedemande }}</td>
                            <td>{{ $article->article->unite ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted py-3">Aucun article demandé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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
                        <form action="{{ route('demande.refuser_achat', $details->iddemandeachat) }}" method="post">
                            @csrf
                                Raison de refus ?
                                <textarea class="form-control" name="raisonrefus"></textarea>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"> Valider</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
