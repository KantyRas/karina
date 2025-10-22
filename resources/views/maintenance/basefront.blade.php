<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/timeline/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <style>
        .sidebar-collapse {
            display: none;
        }
        .badge-notif {
            position: absolute;
            top: 2px;
            left: 4px;
            background: red;
            color: white;
            font-size: 12px;
            padding: 4px 7px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
@php
    use Illuminate\Support\Facades\Auth;
        $routeName = request()->route()->getName();
        $role = Auth::user()->role;
@endphp
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index.dashboard') }}">Dept Maintenance</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>
                    @if($notifications->count() > 0)
                        <span class="badge badge-danger badge-notif">{{ $notifications->count() }}</span>
                    @endif  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    @forelse($notifications as $notification)
                        @php
                            $data = $notification->data;
                            $route = '#';

                            if (isset($data['demandeachat_id'])) {
                                $route = route('demande.detail', $data['demandeachat_id']);
                            } elseif (isset($data['demandetravaux_id'])) {
                                $route = route('demande.detail_demande_travaux', $data['demandetravaux_id']);
                            }
                        @endphp
                        <li>
                            <a href="{{ $route }}">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $notification->data['title'] ?? 'Nouvelle notification' }}</strong>
                                    <span class="text-muted"><em>{{ $notification->created_at->diffForHumans() }}</em></span>
                                </div>
                                <div>{{ $notification->data['message'] ?? '' }}</div>
                            </a>
                        </li>
                    @empty
                        <li class="text-center text-muted">Aucune notification</li>
                    @endforelse
                    <li class="divider"></li>
                    <li class="text-center">
                        <a href="{{ route('notifications.markAllAsRead') }}">
                            <strong>Marquer toutes comme lues</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> {{ Auth::user()->username }} ({{ Auth::user()->roleRelation->role }})</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout.auth')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </nav>
    <!-- /.navbar-static-top -->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>
                @if(in_array($role, [1, 2]))
                <li>
                    <a href="{{ route('index.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                @endif
                @if(Auth::user()->role == 1)
                <li @class(['','active' => str_contains($routeName, 'admin.personnel.')])>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Utilisateurs<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(in_array($role, [1, 2]))
                            <li>
                                <a href="{{ route('admin.personnel.employe.index') }}">Employés</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.personnel.fonction.index') }}">Fonctions</a>
                            </li>
                        @endif
                            <li>
                                <a href="{{ route('admin.personnel.role.index') }}">Rôles</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.personnel.user.index') }}">Comptes</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array($role, [1, 2]))
                <li @class(['','active' => str_contains($routeName, 'carnet.')])>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Entreprises<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('carnet.liste_carnet') }}">Tâches (Carnets) </a>
                        </li>
                        <li>
                            <a href="{{ route('carnet.liste_releve') }}">Compteurs</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(in_array($role, [1, 2, 4]))
                <li @class(['','active' => str_contains($routeName, 'demande.')])>
                    <a href="#"><i class="fa fa-folder"></i> Demandes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(in_array($role, [1, 2]))
                        <li>
                            <a href="{{ route('demande.liste_demande_travaux') }}">Grands Travaux</a>
                        </li>
                        <li>
                            <a href="{{ route('demande.intervention.liste_intervention') }}">Interventions</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('demande.index') }}">Achats</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li @class(['','active' => str_contains($routeName, 'util.gestion.')])>
                @if(Auth::user()->role == 1)
                    <a href="#"><i class="fa fa-gears"></i> Gestions utiles<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('util.gestion.emplacement.index') }}">Emplacements</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.depot.index') }}">Dépôts</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.famille.index') }}">Familles</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.unite.index') }}">Unités</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.frequence.index') }}">Fréquence suivie tâches</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.typedemande.index') }}">Type demandes existants</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.typeintervention.index') }}">Type interventions</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(in_array($role, [1, 2]))
                    <li @class(['','active' => str_contains($routeName, 'article.')])>
                        <a href="#"><i class="fa fa-archive fa-fw"></i>Stocks<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('article.index') }}">Articles</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </nav>
    <!-- /.navbar-static-side -->

    <div id="page-wrapper">
        <div class="row">
               @if(session('success'))
                   <div id="alert-success" class="alert alert-success">
                       {{ session('success') }}
                   </div>
               @endif
               @if(session('warning'))
                   <div id="alert-success" class="alert alert-warning">
                       {{ session('warning') }}
                   </div>
               @endif
               @if($errors->any())
                   <div id="alert-success" class="alert alert-danger">
                       <ul class="my-0">
                           @foreach($errors->all() as $error)
                           <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif
            <div id="flash-message"></div>
            @yield('content')
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
<script src="{{ asset('js/plugins/morris/morris.js') }}"></script>
<script src="{{ asset('js/sb-admin.js') }}"></script>
<script src="{{ asset('js/demo/dashboard-demo.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{ asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('js/tom-select.complete.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            autoWidth: false
        });
        $('.sidebar-collapse').show();
    });
    document.addEventListener("DOMContentLoaded", function () {
        let alert = document.getElementById("alert-success");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }, 2000);
        }
    });
    new TomSelect('select[multiple]', {plugins : {remove_button: {title : 'Supprimer'}}});
</script>
@yield('scripts')
</body>
</html>
