@extends('maintenance.basefront')
@section('title', 'Bon d\'intervention')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <h2 class="page-header text-primary">
                <i class="fa fa-file-text-o"></i> Création du Bon d’Intervention
            </h2>
            <p class="text-muted">Complétez les informations ci-dessous pour planifier l’intervention.</p>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#f5f5f5;">
                    <h4 class="panel-title">
                        <i class="fa fa-info-circle"></i> Informations de la fiche
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('demande.intervention.store_ficheintervention') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Demande intervention</label>
                            <input type="text" class="form-control" placeholder="DI-{{ $iddemandeintervention ?? 'XXXX' }}" disabled>
                        </div>
                        <input type="hidden" name="iddemandeintervention" value="{{ $iddemandeintervention ?? '' }}">
                        <input type="hidden" name="datecreation" value="{{ date('Y-m-d') }}">
                        <div class="form-group">
                            <label>Employé assigné</label>
                            <select name="idemployeassigne" class="form-control">
                                <option value="">-- Sélectionner l’employé --</option>
                                @foreach($employes as $e)
                                <option value="{{$e->idemploye}}">{{ $e->nom }} - {{ $e->prenom }} / {{ $e->matricule}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date planifiée</label>
                            <input type="datetime-local" name="dateplanifie" class="form-control">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>Date intervention effective</label>--}}
{{--                            <input type="datetime-local" name="dateintervention" class="form-control">--}}
{{--                        </div>--}}
                        <div class="text-right" style="margin-top: 20px;">
                            <button type="reset" class="btn btn-outline-secondary px-4">
                                <i class="fa fa-undo me-1"></i> Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Enregistrer la fiche
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
