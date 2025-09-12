@extends('maintenance.basefront')
@section('title', "Demandes de travaux")
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Demandes de travaux</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    FORMULAIRE DE DEMANDE DE TRAVAUX
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form action="{{ route('demande.store') }}" method="post">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Département</label>
                                    <select class="form-control" name="iddepartement" id="DeptSelect">
                                        @foreach ($departements as $departement)
                                            <option value="{{ $departement->iddepartement }}">{{ $departement->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Responsable</label>
                                    <input class="form-control" name="responsable" id="RespInput" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Demandeur</label>
                                    <input class="form-control" name="demandeur">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Date de livraison souhaitée</label>
                                    <input type="date" class="form-control" name="datesouhaite">
                                </div>
                                <div class="form-group">
                                    <label>Fichiers attachés (si nécessaire)</label>
                                    <input type="file" name="" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" name="idsection" id="SectionSelect">
                                        <option value="#">--Choisir--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type de demande</label>
                                    <select class="form-control" name="idtypedemande">
                                        <option value="#">--Choisir--</option>
                                        @foreach ($typedemandes as $typedemande)
                                        <option value="{{ $typedemande->idtypedemande }}">{{ $typedemande->nomtype }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="iddemandeur" value={{ Auth::user()->iduser }}>
                                <input type="hidden" name="datedemande" value={{ \carbon\Carbon::now()->toDateString() }}>
                                <div class="form-group">
                                    <label>Travaux demandés</label>
                                    <select class="form-control" name="idtypetravaux">
                                        <option value="">--Choisir--</option>
                                        @foreach ($typetravaux as $travaux)
                                        <option value="{{ $travaux->idtypetravaux }}">{{ $travaux->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Copie mail</label>
                                    <select class="form-control" name="">
                                        <option value="#">--Choisir--</option>
                                        <option value="#">Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nº de série (Numero code barre)</label>
                                    <input class="form-control" name="numeroserie">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Motif de la demande</label>
                                    <textarea class="form-control" name="motif"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Déscription</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" style="width:200px;">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
