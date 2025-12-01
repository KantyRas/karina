@extends('maintenance.basefront')
@section('title', 'Dashboard')
@if(isset($restricted) && $restricted)
    @section('content')
    <div class="alert alert-warning">
        Vous ne disposez pas des autorisations requises pour accéder au tableau de bord.
    </div>
    <center><h2>Bienvenue sur votre espace utilisateur {{ Auth::user()->username }}.</h2></center>
    @endsection
@else
@section('content')
    <style>
        .custom-panel {
            border-radius: 8px;
            border: 1px solid #dce1e3;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .custom-panel .panel-heading {
            background: #337ab7 !important;
            color: #fff;
            border-radius: 8px 8px 0 0;
            padding: 12px 15px;
        }
        #btnGenerate {
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: bold;
            letter-spacing: 0.5px;
            background-color: #21282e;
            border-color: #2e6da4;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            transition: all 0.25s ease-in-out;
        }
        #btnGenerate:hover {
            background-color: #090909;
            border-color: #204d74;
            box-shadow: 0 4px 8px rgba(0,0,0,0.25);
            transform: translateY(-1px);
        }
        #btnGenerate:active {
            transform: translateY(0);
            box-shadow: 0 2px 3px rgba(0,0,0,0.2);
        }
        #tableReleve {
            border-radius: 6px;
            overflow: hidden;
        }
        #tableReleve thead {
            background-color: #2c3e50;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        #tableReleve tbody tr:hover {
            background-color: #f5f8fa !important;
            cursor: pointer;
        }
        #tableReleve tbody tr:nth-child(odd) {
            background-color: #fbfbfb;
        }
        .table-responsive {
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        #tableReleve td, #tableReleve th {
            padding: 10px !important;
            vertical-align: middle !important;
        }
    </style>

    <center><h3>Bonjour à vous {{ Auth::user()->username }}</h3></center>
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
    <div class="col-lg-12">
        <h1 class="page-header">Tableau des relevés</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default custom-panel">
                <div class="panel-heading">
                    <button class="btn btn-primary mb-3" id="btnGenerate">
                        Générer le tableau
                    </button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped table-bordered" id="tableReleve">
                            <thead id="theadReleve"></thead>
                            <tbody id="tbodyReleve"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('btnGenerate').addEventListener('click', function() {

            document.getElementById("theadReleve").innerHTML = "";
            document.getElementById("tbodyReleve").innerHTML = "";

            fetch("/home/releves/tableau")
                .then(response => response.json())
                .then(data => {

                    const params = data.parametres;
                    const rows = data.resultats;

                    let thead = `
                <tr>
                    <th>Date</th>
                    <th>Mois</th>
                    <th>Année</th>
            `;

                params.forEach(p => {
                    thead += `<th>${p.nomparametre}</th>`;
                });

                thead += `</tr>`;
                document.getElementById("theadReleve").innerHTML = thead;

                let tbody = "";

                rows.forEach(r => {
                    tbody += `
                <tr>
                    <td>${new Date(r.date).toLocaleDateString("fr-FR")}</td>
                    <td>${r.mois}</td>
                    <td>${r.annee}</td>
            `;

                    params.forEach(p => {
                        const val = r[p.nomparametre] ?? "";
                        tbody += `<td>${val}</td>`;
                    });

                    tbody += `</tr>`;
                });

                document.getElementById("tbodyReleve").innerHTML = tbody;

            })
            .catch(error => {
                console.error(error);
                alert("Erreur lors du chargement des relevés");
            });
        });
    </script>
@endsection
@endif
