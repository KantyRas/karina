@extends('maintenance.basefront')
@section('title','Detail equipement - Octobre 2025')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Detail equipement - Octobre 2025</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body">
                <form action="#" method="post" class="form-horizontal">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <br>
                            <label class="form-label">test 1</label>
                            <input type="number"
                                    name="param_"
                                    class="form-control"
                                    placeholder="Saisir">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <br>
                            <label class="form-label">test 1</label>
                            <input type="number"
                                    name="param_"
                                    class="form-control"
                                    placeholder="Saisir">
                        </div><div class="col-lg-4 col-md-6 col-sm-12">
                            <br>
                            <label class="form-label">test 1</label>
                            <input type="number"
                                    name="param_"
                                    class="form-control"
                                    placeholder="Saisir">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fa fa-save"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fa fa-undo"></i> Réinitialiser
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-table"></i> Tableau mensuel
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Parametre 1</th>
                            <th>Parametre 2</th>
                            <th>Parametre 3</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>45</td>
                                <td>4533</td>
                                <td>4533</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>45</td>
                                <td>4533</td>
                                <td>4533</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
