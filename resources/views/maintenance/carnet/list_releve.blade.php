@extends('maintenance.basefront')
@section('title','Type de relevé')
@section('content')

    <div class="col-lg-12">
        <h1 class="page-header">Types de relevés</h1>
    </div>

    <div class="row">
        <!-- Relevé Eau -->
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Relevé Eau
                </div>
                <div class="panel-body text-center">
                    <p>Paramètres : <br>
                        <span class="label label-default">Relevé en m³</span>
                        <span class="label label-default">Durée (h)</span>
                        <span class="label label-default">Conso en m³</span>
                    </p>
                    <a href="{{ route('carnet.historique_releve') }}" class="btn btn-primary btn-sm">Voir détails</a>
                </div>
            </div>
        </div>

        <!-- Relevé Électricité -->
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Relevé Électricité
                </div>
                <div class="panel-body text-center">
                    <p>Paramètres : <br>
                        <span class="label label-default">kWh consommés</span>
                        <span class="label label-default">Puissance max (kW)</span>
                    </p>
                    <a href="#" class="btn btn-primary btn-sm">Voir détails</a>
                </div>
            </div>
        </div>

        <!-- Relevé Bois -->
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tree"></i> Relevé Bois
                </div>
                <div class="panel-body text-center">
                    <p>Paramètres : <br>
                        <span class="label label-default">Volume (stère)</span>
                        <span class="label label-default">Durée combustion (h)</span>
                    </p>
                    <a href="#" class="btn btn-primary btn-sm">Voir détails</a>
                </div>
            </div>
        </div>
    </div>

@endsection
