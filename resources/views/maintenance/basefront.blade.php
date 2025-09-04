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
    <style>
        .sidebar-collapse {
            display: none;
        }
    </style>
</head>
<body>
@php
    $routeName = request()->route()->getName();
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
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">

                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">

                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">

                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                <li>
                    <a href="{{ route('index.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li @class(['','active' => str_contains($routeName, 'admin.personnel.')])>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Utilisateurs<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                        <li>
                            <a href="{{ route('admin.personnel.employe.index') }}">Employés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.personnel.fonction.index') }}">Fonctions</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 1)
                        <li>
                            <a href="{{ route('admin.personnel.role.index') }}">Rôles</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.personnel.user.index') }}">Comptes</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3)
                <li @class(['','active' => str_contains($routeName, 'carnet.')])>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Entreprises<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('carnet.liste_carnet') }}">Tâches (Carnets) </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                <li @class(['','active' => str_contains($routeName, 'demande.')])>
                    <a href="#"><i class="fa fa-folder"></i> Demandes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('demande.index') }}">Achats</a>
                        </li>
                        <li>
                            <a href="#">Interventions</a>
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
                            <a href="{{ route('util.gestion.typeDemande.index') }}">Type demandes existants</a>
                        </li>
                        <li>
                            <a href="{{ route('util.gestion.typeIntervention.index') }}">Type interventions</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li>
                        <a href="#"><i class="fa fa-archive fa-fw"></i>Stocks<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Articles</a>
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
            <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="my-0">
                        @foreach($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            @yield('content')
        </div>
        <!-- /.row -->
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
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            autoWidth: false
        });
        $('.sidebar-collapse').show();
    });
</script>
</body>
</html>
