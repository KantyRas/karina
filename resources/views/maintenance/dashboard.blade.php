@extends('maintenance.basefront')
@section('title', 'Dashboard')

@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tableau de bord</h1>
    </div>

    <!-- Statistiques principales -->
    <div class="row">
        <!-- Utilisateurs -->
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
                            <i class="fa fa-cogs fa-3x"></i>
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
    </div>
@endsection
