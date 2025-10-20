@extends('maintenance.basefront')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">
            Historiques de la fiche du Carnet : {{ $equipement->nomequipement }}
        </h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#genererFicheModal">
                <i class="fa fa-file-text"></i> Génerer fiche
            </button>
        </div>
    </div>
    {{-- Tableau des fiches mensuelles/annuelles --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Historique par mois</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mois</th>
                                <th>Année</th>
                                <th>Date création</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($historiques as $historique)
                            <tr>
                                <td>.</td>
                                <td>{{ \Carbon\Carbon::create()->month($historique->mois)->locale('fr')->monthName }}</td>
                                <td>{{ $historique->annee }}</td>
                                <td>{{ $historique->datecreation }}</td>
                                <td>
                                    <a href="{{ route('carnet.fiche_saisie', $historique->idhistoriqueequipement) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Voir
                                    </a>
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

    <div class="modal fade" id="genererFicheModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Choisissez une action</h5>
                </div>

                <form action="{{ route('carnet.generate_historique_equipement', $equipement->idequipement) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Sous-emplacement
                        <select name="sousemplacement" class="form-select sousemplacement ">
                            <option value="1">Test</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new TomSelect(".sousemplacement", {
                placeholder: "Choisissez un sous-emplacement...",
                create: true,
                maxOptions: 10,
                allowEmptyOption: true,
                sortField: { field: "text", direction: "asc" },
                plugins: ['dropdown_input'],
            });
        });
    </script>
@endsection
