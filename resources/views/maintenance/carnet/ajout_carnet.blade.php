@extends('maintenance.basefront')
@section('title','Ajout Utilisateur')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Ajout nouveau carnet</h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaires Ajouts
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="#">
                                @csrf
                                <div class="form-group">
                                    <label>Item</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Frequence de suivie</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Emplacement</label>
                                    <select class="form-control">
                                        <option>BAT A</option>
                                        <option>BAT B</option>
                                        <option>BAT C</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Employé Responsable</label>
                                    <select class="form-control">
                                        <option value="1">Emp 1</option>
                                        <option value="2">Emp 2</option>
                                        <option value="3">Emp 3</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width:200px;">Créer modèle fiche</button>
                                <button type="submit" class="btn btn-success" style="width:200px;">Validez</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
