<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demande achat</title>

    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: -25px;
            /*border-bottom: 1px solid #2c3e50;*/
            padding-bottom: 20px;
        }

        .document-title {
            text-align: right;

        }

        .document-title h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;

        }

        .reference {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-item label {
            color: #7f8c8d;
            font-size: 13.5px;
            margin-bottom: 5px;
        }

        .info-item span {
            font-weight: bold;
            color: #2c3e50;
        }

        .articles-section h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #2c3e50;
            color: white;
            padding: 12px;
            font-size: 13px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            text-align: center;
        }

        .row-even {
            background-color: #f8f9fa;
        }

        .narrow {
            width: 5%;
        }

        .wide {
            width: 40%;
        }

        .quantity {
            font-weight: bold;
        }

        .code {
            color: #3498db;
            font-weight: bold;
        }

        .empty-message {
            text-align: center;
            color: #7f8c8d;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo-container" style="float: left;">
        <img src="{{ public_path('img/karina.jpg') }}" alt="Logo entreprise" style="width: 100px; gap: 3%;">
    </div>
    <div class="document-title" style="width: max-content; margin-top: 20px"  >
        <h1>Demande d'Achat</h1>
        <p class="reference">Achat/nº{{ str_pad($details->iddemandeachat, 4, '0', STR_PAD_LEFT) }}</p>
    </div>
</div>
<hr style="margin-bottom: 20px;">

<div class="info-section">
    <div class="info-grid">
        <div class="info-item">
            <label>Demandeur:</label>
            <span>{{ $details->demandeur->username }}</span>
        </div>
        <div class="info-item">
            <label>Date de demande:</label>
            <span>{{ \Carbon\Carbon::parse($details->datedemande)->format('d/m/Y') }}</span>
        </div>
        <div class="info-item">
            <label>Demande Travaux:</label>
            <span>{{ $details->iddemande_travaux
            ? 'Travaux/nº' . str_pad($details->iddemande_travaux, 4, '0', STR_PAD_LEFT)
            : 'N/A' }}</span>
        </div>
    </div>
</div>

<div class="articles-section">
    <h2>Liste des Articles</h2>
    <table>
        <thead>
        <tr>
            <th class="narrow">N°</th>
            <th>Code</th>
            <th class="wide">Désignation</th>
            <th>Quantité</th>
            <th>Unité</th>
        </tr>
        </thead>
        <tbody>
        @forelse($details->detailArticles as $index => $article)
            <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                <td>{{ $index + 1 }}</td>
                <td class="code">{{ $article->article->code }}</td>
                <td>{{ $article->article->designation }}</td>
                <td class="quantity">{{ $article->quantitedemande }}</td>
                <td>{{ $article->article->unite ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="empty-message">Aucun article demandé</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
