@extends('maintenance.basefront')
@section('title', "Demandes de travaux")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Demandes de travaux en cours</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('demande.form_demande_travaux') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouvelle demande
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listes des demandes
                </div>
                <div class="panel-body">
                    <div class="text-right" style="margin-bottom:10px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher..." style="width: 250px; display: inline-block;">
                    </div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nº demande</th>
                                <th>Département</th>
                                <th>Utilisateur</th>
                                <th>Type demande</th>
                                <th>Livraison souhaitée</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demandetravaux as $index => $t)
                                <tr class="odd gradeX">
                                    <td>Travaux/nº{{ str_pad($t->iddemandetravaux, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $t->section->departement->nom ?? '-' }}</td>
                                    <td>{{ $t->users->username }}</td>
                                    <td>{{ $t->typeDemande->nomtype ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($t->datesouhaite)->format('d/m/y') }}</td>
                                    <td>@include('maintenance.shared.status', ['status' => $t->statut])</td>
                                    <td class="text-center">
                                        <a href="{{ route('demande.detail_demande_travaux',$t->iddemandetravaux) }}"
                                           class="btn btn-primary btn-circle"
                                           title="Détails demandes">
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
