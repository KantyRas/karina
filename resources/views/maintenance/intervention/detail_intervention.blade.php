@extends('maintenance.basefront')
@section('title', 'Détails intervention - Créer un bon d\'intervention')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <h2 class="page-header text-primary">
                <i class="fa fa-wrench"></i> Détails de la Demande d’Intervention
            </h2>
            <div class="text-right" style="margin-bottom:15px;">
                <a href="{{ route('demande.intervention.ficheintervention',$details->iddemandeintervention) }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Bon intervention
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well well-sm text-center" style="background:#ffffff; margin:15px 0;">
                <button class="btn btn-info" id="btnVoirFiche" data-id="{{ $details->iddemandeintervention }}">
                    <i class="fa fa-file-text"></i> Voir Fiche Intervention
                </button>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #f5f5f5;">
                    <h4 class="panel-title">
                        <i class="fa fa-info-circle"></i> Informations principales
                    </h4>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th class="col-sm-3">Demandeur</th>
                            <td>{{ $details->demandeur->username ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Département</th>
                            <td>{{ $details->section->departement->nom ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $details->section->nomsection ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Type d’intervention</th>
                            <td>{{ $details->typeintervention->type ?? 'Autres' }}</td>
                        </tr>
                        <tr>
                            <th>Date de la demande</th>
                            <td>{{ \Carbon\Carbon::parse($details->datedemande)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Date souhaitée</th>
                            <td>{{ \Carbon\Carbon::parse($details->datesouhaite)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Statut</th>
                            <td>
                                @if($details->statut == 0)
                                    <span class="label label-warning">En attente</span>
                                @elseif($details->statut == 1)
                                    <span class="label label-success">Validé</span>
                                @elseif($details->statut == 3)
                                    <span class="label label-danger">Rejeté</span>
                                @else
                                    <span class="label label-default">Inconnu</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-file-text"></i> Détails supplémentaires
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label><strong>Motif de la demande :</strong></label>
                        <p class="well well-sm">{{ $details->motif ?? 'Aucun motif renseigné.' }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Description :</strong></label>
                        <p class="well well-sm">{{ $details->description ?? 'Aucune description.' }}</p>
                    </div>
                </div>
            </div>

            <div class="text-right" style="margin-top: 20px;">
                @if($details->statut == 0)
                    <a href="{{ route('demande.intervention.valider_ficheintervention',$details->iddemandeintervention) }}" class="btn btn-success">
                        <i class="fa fa-check"></i> Valider
                    </a>
                    <a href="#" class="btn btn-danger">
                        <i class="fa fa-times"></i> Rejeter
                    </a>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="ficheModal" tabindex="-1" role="dialog" aria-labelledby="ficheModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-primary" style="color:white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="ficheModalLabel">
                        <i class="fa fa-file-text-o"></i> Aperçu du Bon d’intervention
                    </h5>
                </div>

                <div class="modal-body" id="fiche-content">
                    <div class="text-center text-muted" style="display: none;">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                        <p>Chargement de la fiche...</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('demande.intervention.getdate',$details->iddemandeintervention) }}" method="post">
                        @csrf
                        <input type="hidden" name="dateintervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i> Terminer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#btnVoirFiche').on('click', function () {
                const demandeId = $(this).data('id');
                $('#ficheModal').modal('show');
                $('#fiche-content').html(`
            <div class="text-center text-muted">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
                <p>Chargement de la fiche...</p>
            </div>
        `);

                $.ajax({
                    url: "{{ url('demandes/ficheintervention/details') }}/" + demandeId,
                    method: 'GET',
                    success: function (data) {
                        const html = `
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr><th>Numéro de fiche</th><td>${data.idfiche}</td></tr>
                            <tr><th>Demande intervention Nº</th><td>${data.iddemande}</td></tr>
                            <tr><th>Employé assigné</th><td>${data.employe}</td></tr>
                            <tr><th>Date de création</th><td>${data.datecreation ?? '—'}</td></tr>
                            <tr><th>Date planifiée</th><td>${data.dateplanifie ?? '—'}</td></tr>
                            <tr><th>Date d’intervention</th><td>${data.dateintervention ?? '—'}</td></tr>
                        </tbody>
                    </table>
                `;
                        $('#fiche-content').html(html);
                    },
                    error: function (xhr) {
                        $('#fiche-content').html(`
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i> ${xhr.responseJSON?.error ?? 'Erreur lors du chargement de la fiche.'}
                    </div>
                `);
                    }
                });
            });

            // Impression du contenu du modal
            $('#btnPrint').on('click', function () {
                const printContent = document.getElementById('fiche-content').innerHTML;
                const w = window.open('', '_blank');
                w.document.write('<html><head><title>Bon d\'intervention</title></head><body>');
                w.document.write(printContent);
                w.document.write('</body></html>');
                w.document.close();
                w.print();
            });
        });
    </script>
@endsection
