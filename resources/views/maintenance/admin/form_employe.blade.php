@extends('maintenance.basefront')
@section('title','Ajout Employé')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Employés</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaires Ajouts Employés
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form action="#">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input class="form-control" placeholder="Entrez le nom">
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input class="form-control" placeholder="Entrez le prénom">
                                </div>
                                <div class="form-group">
                                    <label>Matricule nº</label>
                                    <input type="text" class="form-control" placeholder="ex: 6906">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="ex: rakoto@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="tel" class="form-control" placeholder="ex: 0348945621">
                                </div>
                                <div class="form-group">
                                    <label>Fonction</label>
                                    <select class="form-control">
                                        <option>--Choisir--</option>
                                        <option>Agent de maintenance</option>
                                        <option>Électricien</option>
                                        <option>Plombier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" style="width:200px;">Validez</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
