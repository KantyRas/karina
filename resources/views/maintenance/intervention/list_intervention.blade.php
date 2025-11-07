@extends('maintenance.basefront')
@section('title', 'Liste interventions')

@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Interventions en cours</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('demande.intervention.create_intervention') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouvelle intervention
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listes des interventions
                </div>
                <div class="panel-body">
                    <div class="text-right" style="margin-bottom:10px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher..." style="width: 250px; display: inline-block;">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Demandeur</th>
                                <th>Date demande</th>
                                <th>Date souhaite</th>
                                <th>Departement - Section</th>
                                <th>Type d’intervention</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demandes as $d)
                                <tr class="odd gradeX">
                                    <td>{{ $d->iddemandeintervention }}</td>
                                    <td>{{ $d->demandeur->username }}</td>
                                    <td>{{ $d->datedemande }}</td>
                                    <td>{{ $d->datesouhaite }}</td>
                                    <td>
                                        {{ $d->section->departement->nom }} /
                                        {{ $d->section->nomsection }}
                                    </td>
                                    <td>{{ $d->typeintervention->type }}</td>
                                    <td>@include('maintenance.shared.status', ['status' => $d->statut])</td>
                                    <td>
                                        <a href="{{ route('demande.intervention.detail_intervention', $d->iddemandeintervention) }}"
                                           class="btn btn-primary btn-circle"
                                           title="Détails">
                                            <i class="fa fa-file"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-success btn-circle"
                                           title="Modifier">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="#" method="POST" style="display:inline-block; margin-left:3px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-circle"
                                                    title="Supprimer">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
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
