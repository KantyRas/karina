<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Relevés Eau - {{ $mois }} {{ $annee }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .header-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #777;
            padding: 6px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

<h1>Relevé Eau - {{ ucfirst($mois) }} {{ $annee }}</h1>
<div class="header-info">
    <strong>Type de relevé :</strong> {{ $typeReleve->nom ?? 'N/A' }} <br>
    <strong>Date de génération :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
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

<div class="footer">
    <em>Document généré automatiquement le {{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</em>
</div>

</body>
</html>
