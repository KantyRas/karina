@extends('maintenance.basefront')
@section('title', 'Nouvelle Demande d’Intervention')

@section('content')
    <div class="col-lg-12">
        <h2 class="page-header">Nouvelle Demande d'Intervention</h2>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire de Demande
                </div>
                <div class="panel-body">
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Demandeur</label>
                            <input class="form-control" name="iddemandeur" disabled placeholder="Votre nom">
                        </div>

                        <div class="form-group">
                            <label>Type d'intervention</label>
                            <select class="form-control" name="idtypeintervention">
                                <option value="1">Type 1</option>
                                <option value="2">Type 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date souhaitée</label>
                            <input type="date" class="form-control" name="datesouhaite">
                        </div>

                        <div class="form-group">
                            <label>Motif de la demande</label>
                            <textarea class="form-control" name="motif" rows="3" placeholder="Ex: panne, maintenance préventive..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Donnez plus de détails si nécessaire..."></textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
