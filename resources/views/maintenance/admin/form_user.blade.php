@extends('maintenance.basefront')
@section('title','Ajout Utilisateur')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Nouveau compte</h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire Ajout Compte
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
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
                                <button type="submit" class="btn btn-success" style="width:200px;">Validez</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
