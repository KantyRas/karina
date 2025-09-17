@extends('maintenance.basefront')
@section('title', 'Détails de la demande d\'achat')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="fa fa-file-text me-2"></i> Détails de la Demande d'Achat
        </h3>
    </div>
    <hr>
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
@endsection
