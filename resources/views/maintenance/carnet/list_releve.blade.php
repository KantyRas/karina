@extends('maintenance.basefront')
@section('title','Type de relevé')
@section('content')

    <div class="col-lg-12">
        <h1 class="page-header">Types de relevés</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('carnet.ajout_releve') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Ajout type de relevé
            </a>
        </div>
    </div>

    <div class="row">
        @foreach($typesReleves as $type)
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Relevé {{ $type->nom }}
                </div>
                <div class="panel-body text-center">
                    <p>Paramètres à contrôller: <br>
                        @foreach($type->parametres as $param)
                            <span class="label label-default">{{ $param->nomparametre }}</span>
                        @endforeach
                    </p>
                    <div>
                        <a href="{{ route('carnet.historique_releve',$type->idtypereleve) }}"
                           class="btn btn-primary  btn-sm me-2">
                            Voir détails
                        </a>
                        <a href="#"
                           class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
