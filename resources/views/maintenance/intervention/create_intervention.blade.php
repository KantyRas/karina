@extends('maintenance.basefront')
@section('title', 'Nouvelle Demande d’Intervention')

@section('content')
    <div class="container">
        <h2 class="page-header text-center">Nouvelle Demande d'Intervention</h2>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <form action="{{route('demande.intervention.store_intervention')}}" method="POST" class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Demandeur :</label>
                        <div class="col-sm-9">
                            <input type="text" name="demandeur" class="form-control" value="{{ Auth::user()->username }}" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="iddemandeur" value="{{ Auth::user()->iduser }}">
                    <input type="hidden" name="idrolereceveur" value="2">
                    {{-- Département --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Département :</label>
                        <div class="col-sm-9">
                            <select name="iddepartement" id="DeptSelect" class="form-control">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->iddepartement }}">{{ $departement->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Section --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Section :</label>
                        <div class="col-sm-9">
                            <select name="idsection" id="SectionSelect" class="form-control">
                                <option value="">-- Sélectionner une section --</option>
                            </select>
                        </div>
                    </div>

                    {{-- Responsable --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Responsable :</label>
                        <div class="col-sm-9">
                            <input type="text" name="responsable" id="RespInput" class="form-control" disabled placeholder="Nom du responsable">
                        </div>
                    </div>

                    {{-- Type d'intervention --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Type d'intervention :</label>
                        <div class="col-sm-9">
                            <select name="idtypeintervention" class="form-control">
                                @foreach ($typeintervention as $ti)
                                    <option value="{{ $ti->idtypeintervention }}">{{ $ti->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="datedemande" value="{{ date('Y-m-d') }}">
                    {{-- Date souhaitée --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date souhaitée :</label>
                        <div class="col-sm-9">
                            <input type="date" name="datesouhaite" class="form-control">
                        </div>
                    </div>

                    {{-- Motif --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Motif :</label>
                        <div class="col-sm-9">
                            <textarea name="motif" class="form-control" rows="3" placeholder="Ex: panne, maintenance préventive..."></textarea>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description :</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" rows="4" placeholder="Donnez plus de détails si nécessaire..."></textarea>
                        </div>
                    </div>

                    {{-- Bouton --}}
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Soumettre la demande
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //  Déclenche automatiquement le changement dès le chargement de la page
        window.addEventListener('DOMContentLoaded', function () {
            const DeptSelect = document.getElementById('DeptSelect');
            if (DeptSelect.value) {
                DeptSelect.dispatchEvent(new Event('change'));
            }
        });

        document.getElementById('DeptSelect').addEventListener('change', function () {
            const deptId = this.value;

            // console.log("miditra2");
            if (deptId) {
                fetch(`/demandes/get_responsable/${deptId}`)
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data);
                        const RespInput = document.getElementById('RespInput');
                        RespInput.innerHTML = ''; // reset

                        RespInput.value = data.responsable.responsable;

                        const SectionSelect = document.getElementById('SectionSelect');
                        SectionSelect.innerHTML = ''; // reset

                        data.section.forEach(sec => {
                            console.log(sec.nomsection);
                            const option = document.createElement('option');
                            option.value = sec.idsection;
                            option.textContent = sec.nomsection;
                            SectionSelect.appendChild(option);
                        });

                    });
            }
        });
    </script>
@endsection
