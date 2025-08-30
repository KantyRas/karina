@extends('maintenance.basefront')
@section('title','Listes utilisateurs')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les utilisateurs</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('admin.personnel.user.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Ajout comptes utilisateurs
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comptes Utilisateurs
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>nº Matricule</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>1</td>
                                    <td>6906</td>
                                    <td>rasolofomananakanty@gmail.com</td>
                                    <td>pass</td>
                                    <td>Super admin</td>
                                    <td class="text-center">
                                        <a href="#"
                                           class="btn btn-primary btn-circle"
                                           title="Détails">
                                            <i class="fa fa-list-alt"></i>
                                        </a>
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
                                                    title="Supprimer"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
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
