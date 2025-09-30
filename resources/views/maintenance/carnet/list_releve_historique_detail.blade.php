@extends('maintenance.basefront')
@section('title','Relevés Eau - Septembre 2025')
@section('content')
    @php
        $parametres = [
            (object) ['idparametretype' => 1, 'nomparametre' => 'Relevé en m³'],
            (object) ['idparametretype' => 2, 'nomparametre' => 'Durée (h)'],
            (object) ['idparametretype' => 3, 'nomparametre' => 'Conso en m³'],
        ];
    @endphp
    <div class="col-lg-12">
        <h1 class="page-header">Relevés Eau - Septembre 2025</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-plus-circle"></i> Ajouter un relevé journalier
                </div>
                <div class="panel-body" style="gap: 3%;">
                    <form action="#" method="post" class="form-horizontal">
                        @csrf
                        @foreach($parametres as $parametre)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ $parametre->nomparametre }}</label>
                                    <input type="number"
                                           name="param_{{ $parametre->idparametretype }}"
                                           class="form-control"
                                           placeholder="Saisir {{ strtolower($parametre->nomparametre) }}">
                                </div>
                            </div>
                        @endforeach

                        <div class="row col-lg-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Enregistrer
                            </button>
                            <button type="reset" class="btn btn-default">
                                <i class="fa fa-undo"></i> Réinitialiser
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des relevés -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-table"></i> Tableau mensuel (Paramètres en colonnes)
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Relevé en m³</th>
                            <th>Durée (h)</th>
                            <th>Conso en m³</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>01</td>
                            <td>120</td>
                            <td>5</td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>125</td>
                            <td>6</td>
                            <td>115</td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>118</td>
                            <td>4</td>
                            <td>109</td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>130</td>
                            <td>7</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td>05</td>
                            <td>127</td>
                            <td>5</td>
                            <td>119</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
