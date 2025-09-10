@extends('maintenance.basefront')
@section('title', "Demandes de travaux")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Demandes de travaux</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    FORMULAIRE DE DEMANDE DE TRAVAUX
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form action="#" method="post">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Département</label>
                                    <select class="form-control" name="iddepartement">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Responsable</label>
                                    <input class="form-control" name="responsable" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Demandeur</label>
                                    <input class="form-control" name="demandeur">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Date de livraison souhaitée</label>
                                    <input type="date" class="form-control" name="datesouhaite">
                                </div>
                                <div class="form-group">
                                    <label>Fichiers attachés (si nécessaire)</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" name="idsection">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test section</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type de demande</label>
                                    <select class="form-control" name="idtypedemande">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Travaux demandés</label>
                                    <select class="form-control" name="idtravauxdemande">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Copie mail</label>
                                    <select class="form-control" name="iduser">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nº de série (Numero code barre)</label>
                                    <input class="form-control" name="numeroserie">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Motif de la demande</label>
                                    <textarea class="form-control" name="motif"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Déscription</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" style="width:200px;">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
