<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" lang="fr">
    <title>Relevé Eau - {{ ucfirst($mois) }} {{ $annee }}</title>
    <style>
        @page {
            margin: 80px 40px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #2d3436;
            background-color: #fff;
        }

        header {
            position: fixed;
            top: -65px;
            left: 0;
            right: 0;
            height: 70px;
            border-bottom: 2px solid grey;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        header img {
            height: 60px;
            width: auto;
            object-fit: contain;
        }

        header .period {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            text-align: right;
            font-size: 13px;
            color: #333;
            line-height: 1.4;
            margin-top: -17px;
        }

        header .period strong {
            font-size: 14px;
            color: #000;
        }


        /* --- FOOTER --- */
        footer {
            position: fixed;
            bottom: -25px;
            left: 0;
            right: 0;
            height: 20px;
            border-top: 1px solid #ddd;
            text-align: right;
            font-size: 10px;
            color: #888;
            padding-top: 3px;
        }

        footer .page:after {
            content: counter(page);
        }

        /* --- CONTENT --- */
        .content {
            margin-top: 70px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            color: grey;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .sub-title {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 25px;
        }

        /* --- INFO BOX --- */
        .info-box {
            border: 1px solid #e0e0e0;
            border-left: 5px solid grey;
            background-color: #f9fbfd;
            padding: 10px 15px;
            margin-bottom: 20px;
        }
        .info-box strong {
            color: grey;
        }

        /* --- TABLE --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 3px;
            overflow: hidden;
        }

        thead {
            background-color: grey;
            color: #fff;
        }

        th {
            padding: 8px;
            text-align: center;
            font-size: 8px;
            text-transform: uppercase;
            border-right: 1px;
        }

        td {
            padding: 6px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        tbody tr:nth-child(odd) {
            background-color: #f8f8f8;
        }

        .footer-note {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="{{ public_path('img/karina.jpg') }}" alt="Logo">
    </div>
    <div class="period">
        <strong>{{ ucfirst($mois) }} {{ $annee }}</strong><br>
        <small>Rapport mensuel de relevé</small>
    </div>
</header>

<footer>
    Page <span class="page"></span>
</footer>

<div class="content">

    <div class="info-box">
        <p>
            <strong>Type de relevé :</strong> {{ $typeReleve->nom ?? 'N/A' }}<br>
            <strong>Date de création :</strong> {{ \Carbon\Carbon::parse($historique->datecreation)->format('d/m/Y') }}<br>
            <strong>Nombre de jours relevés :</strong> {{ count($details) }}
        </p>
    </div>

    <table>
        <thead>
        <tr>
            <th>Jour</th>
            @foreach($parametres as $parametre)
                <th>{{ $parametre->nomparametre }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($details as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->datereleve)->format('d') }}</td>
                @foreach($parametres as $parametre)
                    <td>{{ $row->{$parametre->nomparametre} ?? '-' }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        Document généré automatiquement le {{ now()->format('d/m/Y') }}.
    </div>
</div>

</body>
</html>
