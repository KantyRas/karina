@extends('maintenance.basefront')
@section('title', "Demandes achats")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Mes demandes d'achats en cours</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('demande.create','') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouvelle demande
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    LISTE DES DEMANDES D'ACHATS
                </div>
                <div class="panel-body">
                    <div class="text-right" style="margin-bottom:10px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher..." style="width: 250px; display: inline-block;">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%">Demande Nº</th>
                                <th>Demandeur</th>
                                <th>Date demande</th>
                                <th>Demande travaux</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demandes as $index => $d)
                            <tr class="odd gradeX">
                                <td>Achat/nº{{ str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $d->demandeur->username }}</td>
                                <td>{{ $d->datedemande }}</td>
                                <td style="text-align: center;">
                                    {{ $d->iddemande_travaux
                                        ? 'Travaux/nº' . str_pad($d->iddemande_travaux, 4, '0', STR_PAD_LEFT)
                                        : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('demande.detail',$d->iddemandeachat) }}"
                                       class="btn btn-primary btn-circle"
                                       title="Détails">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block; margin-left:3px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-circle"
                                                title="Supprimer">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="text-right">--}}
    {{--        {{ $demandes->links() }}--}}
    {{--    </div>--}}
    <script src="{{ asset('js/table-utils.js') }}"></script>
@endsection
