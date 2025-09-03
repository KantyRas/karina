@extends('maintenance.basefront')
@section('title','Listes utilisateurs')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les utilisateurs</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i>  Ajout comptes utilisateurs
            </button>
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
{{-- modal --}}
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutFonctionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Formulaire Ajout Compte
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="modal-body">
                            <form action="#">
                                @csrf
                                <div class="form-group">
                                    <label>Matricule</label>
                                    <select class="form-control">
                                        <option value="0">--Choisir--</option>
                                        <option value="idEmploye">6906</option>
                                        <option value="idEmploye">6907</option>
                                        <option value="idEmploye">6908</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Rôle</label>
                                    <select class="form-control">
                                        <option value="1">Super admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Simple utilisateur</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-success">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
