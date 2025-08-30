@extends('maintenance.basefront')
@section('title','Listes employés')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Employés</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('admin.personnel.employe.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Ajout nouveau employé
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listes des employés
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom & Prénoms</th>
                                <th>Email</th>
                                <th>Télephone</th>
                                <th>Fonction</th>
                                <th>État</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>6906</td>
                                    <td>RASOLOFOMANANA Tanjoniaina Kanty</td>
                                    <td>rasolofomananakanty@gmail.com</td>
                                    <td>+261 34 87 645 40</td>
                                    <td>Développeur</td>
                                    <th>
                                        <span class="label label-success" style="padding:6px 10px; border-radius:20px;">
                                            Actif
                                        </span>
                                    </th>
                                    <td class="text-center">
                                        <a href="#"
                                           class="btn btn-success btn-circle"
                                           title="Modifier">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="" method="POST" style="display:inline-block; margin-left:3px;">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
