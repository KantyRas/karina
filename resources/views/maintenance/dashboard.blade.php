@extends('maintenance.basefront')
@section('title', 'Dashboard')

@section('content')
    <style>
        .table-responsive thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 5;
        }
    </style>
    <div class="col-lg-12">
        <h1 class="page-header">Tableau de bord</h1>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $user }}</div>
                            <div>Utilisateurs</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.personnel.user.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir la liste</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Employés -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $employe }}</div>
                            <div>Employés</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.personnel.employe.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir plus</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Équipements -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-gear fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $equipement }}</div>
                            <div>Équipements</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('carnet.liste_carnet') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir la liste</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Articles -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-barcode fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $article }}</div>
                            <div>Articles</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('article.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir la liste</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Demandes de travaux -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-wrench fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $demandeTotal }}</div>
                            <div>Demandes de travaux</div>
                        </div>
                    </div>
                </div>

                <!-- Sous-statistiques -->
                <div class="panel-body" style="padding: 8px 15px;">
                    <div class="row text-center">
                        <div class="col-xs-6">
                            <strong style="color:#f0ad4e;">{{ $demandeEnCours }}</strong><br>
                            <small>En cours</small>
                        </div>
                        <div class="col-xs-6">
                            <strong style="color:#5cb85c;">{{ $demandeAccepte }}</strong><br>
                            <small>Validées</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('demande.liste_demande_travaux') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir les demandes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Demandes achats -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $demandeAchat }}</div>
                            <div>Demandes d'achats</div>
                        </div>
                    </div>
                </div>

                <!-- Sous-statistiques -->
                <div class="panel-body" style="padding: 8px 15px;">
                    <div class="row text-center">
                        <div class="col-xs-6">
                            <strong style="color:#f0ad4e;">{{ $demandeAchatEnCours }}</strong><br>
                            <small>En cours</small>
                        </div>
                        <div class="col-xs-6">
                            <strong style="color:#5cb85c;">{{ $demandeAchatAccepte }}</strong><br>
                            <small>Validées - Livrées</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('demande.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir les demandes d'achats</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Demandes interventions -->
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-gears fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $demandeIntervention }}</div>
                            <div>Demandes d'intervention</div>
                        </div>
                    </div>
                </div>

                <!-- Sous-statistiques -->
                <div class="panel-body" style="padding: 8px 15px;">
                    <div class="row text-center">
                        <div class="col-xs-6">
                            <strong style="color:#f0ad4e;">{{ $demandeInterventionEnCours }}</strong><br>
                            <small>En cours</small>
                        </div>
                        <div class="col-xs-6">
                            <strong style="color:#5cb85c;">{{ $demandeInterventionAccepte }}</strong><br>
                            <small>Terminées</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('demande.intervention.liste_intervention') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir les interventions</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <h1 class="page-header">Fiche non remplies</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading d-flex gap-2">
                    @foreach ($frequence as $f)
                    <a href="{{ route('carnet.cutoff', ['id' =>  $f->idfrequence ]) }}" class="btn btn-primary load-fiche">
                        {{ $f->frequence }}
                    </a>
                    @endforeach
                    <!-- <button type="button" class="btn btn-primary load-fiche">
                        Mensuel
                    </button> -->
                </div>

                <div class="panel-body" id="fiche-container">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover" style="background-color: #ffe5e5;">
                        <thead class="table-danger">
                        <tr>
                            <th>Item</th>
                            <th>Emplacement</th>
                            <th>Responsable</th>
                            <th>Date</th>
                            <th>frequence</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($fiche as $fiches)

                                <tr>
                                    <td><a href="{{ route('carnet.fiche_saisie',$fiches->idhistoriqueequipement) }}">{{$fiches->nomequipement}}</a></td>
                                    <td>{{$fiches->emplacement}}</td>
                                    <td>{{$fiches->employe}}</td>
                                    <td>{{$fiches->date_manquante}}</td>
                                    <td>{{$fiches->frequence}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tableau des Relevés
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Mois</th>
                                <th>Année</th>

                                @foreach ($parametresReleve as $p)
                                    <th>{{ $p->nomparametre }}</th>
                                @endforeach
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($tableauReleve as $row)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
                                    <td>{{ $row->mois }}</td>
                                    <td>{{ $row->annee }}</td>

                                    @foreach ($parametresReleve as $p)
                                        <td>{{ $row->{$p->nomparametre} ?? '-' }}</td>
                                    @endforeach
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
