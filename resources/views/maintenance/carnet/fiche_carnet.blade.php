@extends('maintenance.basefront')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">
            Historiques de la fiche du Carnet : {{ $equipement->nomequipement }}
        </h1>
        <div class="text-right" style="margin-bottom:15px;">
            <form action="{{ route('carnet.generate_historique_equipement', $equipement->idequipement) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-file-text"></i> Génerer fiche
                </button>
            </form>
        </div>
    </div>
    {{-- Tableau des fiches mensuelles/annuelles --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Historique par mois</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
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
                            @foreach ($historiques as $index => $historique)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{ \Carbon\Carbon::create()->month($historique->mois)->locale('fr')->monthName }}</td>
                                <td>{{ $historique->annee }}</td>
                                <td>{{ $historique->datecreation }}</td>
                                <td>
                                    <a href="{{ route('carnet.fiche_saisie', $historique->idhistoriqueequipement) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Voir
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
    </div>
@endsection
