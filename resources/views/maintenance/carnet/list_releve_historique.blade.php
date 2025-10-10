@extends('maintenance.basefront')
@section('title','Historiques')
@section('content')

    <div class="col-lg-12">
        <h1 class="page-header">Historiques - Relevé {{ $typeReleve->nom }}</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <form action="{{ route('carnet.generate_historique_releve', $idtypereleve) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-file-text"></i> Génerer fiche
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des relevés par Mois / Année
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mois</th>
                            <th>Année</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historiques as $index => $histo)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($histo->mois)->locale('fr')->monthName }}</td>
                                <td>{{ $histo->annee }}</td>
                                <td>{{ $histo->datecreation }}</td>
                                <td>
                                    <a href="{{ route('carnet.detail_historique_releve', $histo->idhistoriquereleve) }}" class="btn btn-info btn-xs">
                                        Afficher
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
