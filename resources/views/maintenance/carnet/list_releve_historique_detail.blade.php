@extends('maintenance.basefront')
@section('title','Relevés Eau - Septembre 2025')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Relevés Eau - Septembre 2025</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body">
                <form action="#" method="post" class="form-horizontal">
                    @csrf
                    <div class="row g-3">
                        @foreach($parametres as $parametre)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <br>
                                <label class="form-label">{{ $parametre->nomparametre }}</label>
                                <input type="number"
                                       name="param_{{ $parametre->idparametretype }}"
                                       class="form-control"
                                       placeholder="Saisir {{ strtolower($parametre->nomparametre) }}">
                            </div>

                        @endforeach
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
                            @foreach($parametres as $parametre)
                                <th>{{ $parametre->nomparametre }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $row)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->datereleve)->day }}</td>
                                @foreach($parametres as $parametre)
                                    <td>{{ $row->{$parametre->nomparametre} ?? '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
