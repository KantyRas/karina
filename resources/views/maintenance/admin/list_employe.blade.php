@extends('maintenance.basefront')
@section('title','Listes employés')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Employés</h1>
        <div class="text-left">
            <form action="{{ route('admin.personnel.employe_import') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf
                <div class="form-group mr-2">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-upload"></i> Importer
                </button>
            </form>
        </div>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('admin.personnel.employe_export') }}" class="btn btn-warning">
                <i class="fa fa-download"></i> Exporter
            </a>
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
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
                                @foreach ($employe as $e)
                                <tr class="odd gradeX">
                                        <td>{{$e->matricule}}</td>
                                        <td>{{$e->nom}} {{$e->prenom}}</td>
                                        <td>{{$e->email}}</td>
                                        <td>{{$e->telephone}}</td>
                                        <td>{{$e->fonction->fonction ?? ''}}</td>
                                        <th>
                                            <span class="label label-success" style="padding:6px 10px; border-radius:20px;">
                                                Actif
                                            </span>
                                        </th>
                                        <td class="text-center">
                                            <a href="{{ route('admin.personnel.employe.edit', $e) }}"
                                               class="btn btn-success btn-circle"
                                               title="Modifier">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.personnel.employe.destroy', $e) }}" method="POST" style="display:inline-block; margin-left:3px;">
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
