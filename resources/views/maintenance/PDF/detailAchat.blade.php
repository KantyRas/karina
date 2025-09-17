<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demande achat</title>

    <style>
        body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h3, h4 {
        margin: 0;
        padding: 0;
    }

    h3 {
        font-size: 18px;
        color: #0d6efd; /* Bleu bootstrap */
    }

    h4 {
        font-size: 14px;
        color: #000;
    }

    .fw-bold {
        font-weight: bold;
    }

    .text-primary {
        color: #0d6efd !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mb-1 {
        margin-bottom: 5px !important;
    }

    .mb-3 {
        margin-bottom: 15px !important;
    }

    .mb-4 {
        margin-bottom: 20px !important;
    }

    .panel {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .panel-heading {
        background-color: #f8f9fa;
        padding: 10px 15px;
        font-weight: bold;
        font-size: 14px;
        border-bottom: 1px solid #dee2e6;
    }

    .panel-body {
        padding: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    th, td {
        padding: 8px;
        border: 1px solid #dee2e6;
    }

    th {
        background-color: #d4edda; /* Vert clair bootstrap */
        font-weight: bold;
    }

    td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    hr {
        border: 0;
        border-top: 1px solid #dee2e6;
        margin: 20px 0;
    }
    </style>
</head>
<body>
    <div>
        <img src="asset('img/karina.jpg')" alt="xxx">
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="fa fa-file-text me-2"></i> Détails de la Demande d'Achat
        </h3>
    </div>
    <div class="panel panel-default shadow-sm">
        <div class="panel-heading font-weight-bold">
            <i class="fa fa-info-circle me-2"></i> Informations Générales
        </div>
        <div class="panel-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Numéro :</p>
                    <h4 class="fw-bold">Achat/nº{{ str_pad($details->iddemandeachat, 4, '0', STR_PAD_LEFT) }}</h4>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Demandeur :</p>
                    <h4 class="fw-bold">{{ $details->demandeur->username }}</h4>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Date :</p>
                    <h4 class="fw-bold">{{ \Carbon\Carbon::parse($details->datedemande)->format('d/m/Y') }}</h4>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Demande Travaux liée :</p>
                    <h4 class="fw-bold">
                        {{ $details->iddemande_travaux
                        ? 'Travaux/nº' . str_pad($details->iddemande_travaux, 4, '0', STR_PAD_LEFT)
                        : '-' }}
                    </h4>
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
</body>
</html>