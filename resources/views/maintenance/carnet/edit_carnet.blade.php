@extends('maintenance.basefront')
@section('title','Modifier Équipement')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Modifier Équipement</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modification de l'équipement
                </div>
                <div class="panel-body">
                    <form action="{{ route('carnet.update_carnet', $equipements->idequipement) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="nom_equipement" class="form-label fw-bold">Nom équipement</label>
                                <input type="text" class="form-control" id="nom_equipement" name="nomequipement" value="{{ $equipements->nomequipement }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="employe" class="form-label fw-bold">Employé responsable</label>
                                <select id="employe" name="idemploye[]" multiple style="display: none;">
                                    @foreach ($employes as $employe)
                                        <option value="{{ $employe->idemploye }}"
                                            {{ in_array($employe->idemploye, $equipements->employes->pluck('idemploye')->toArray()) ? 'selected' : '' }}>
                                            {{ $employe->nom }} {{ $employe->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <label for="emplacement" class="form-label fw-bold">Emplacement</label>
                                <select class="form-control" id="emplacement" name="idemplacement" required>
                                    <option value="" disabled>-- Sélectionnez --</option>
                                    @foreach ($emplacements as $emplacement)
                                        <option value="{{ $emplacement->idemplacement }}"
                                            {{ $equipements->idemplacement == $emplacement->idemplacement ? 'selected' : '' }}>
                                            {{ $emplacement->emplacement }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold">Paramètres à contrôler</h6>
                        <div id="parametres-container">
                            @foreach($equipements->parametres as $index => $param)
                                <div class="row align-items-center mb-2 border-bottom pb-2">
                                    <div class="col-md-4">
                                        <input type="text" name="parametres[{{ $index }}][nomparametre]" class="form-control" value="{{ $param->nomparametre }}" required>
                                        <input type="hidden"
                                               name="parametres[{{ $index }}][idparametreequipement]"
                                               value="{{ $param->idparametreequipement }}">
                                    </div>
                                    <div class="col-md-6">
                                        @foreach($frequences as $frequence)
                                            <label class="radio-inline">
                                                <input type="radio" name="parametres[{{ $index }}][idfrequence]" value="{{ $frequence->idfrequence }}"
                                                    {{ $frequence->idfrequence == $param->idfrequence ? 'checked' : '' }}>
                                                {{ $frequence->frequence }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-sm btn-danger remove-param"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-sm mt-3" id="add-param">
                            <i class="fa fa-plus"></i> Ajouter un paramètre
                        </button>

                        <hr class="my-4">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-save"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let i = {{ $equipements->parametres->count() }};

        document.getElementById('add-param').addEventListener('click', function() {
            let container = document.getElementById('parametres-container');

            let paramDiv = document.createElement('div');
            paramDiv.classList.add('row', 'align-items-center', 'mb-2', 'border-bottom', 'pb-2');
            paramDiv.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="parametres[${i}][nomparametre]" class="form-control" placeholder="Nom du paramètre" required>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                @foreach ($frequences as $frequence)
            <label class="radio-inline">
                <input type="radio" name="parametres[${i}][idfrequence]" value="{{ $frequence->idfrequence }}">{{ $frequence->frequence }}
            </label>
@endforeach
            </div>
        </div>
        <div class="col-md-2 text-end">
            <button type="button" class="btn btn-sm btn-danger remove-param"><i class="fa fa-trash-o"></i></button>
        </div>
    `;
            container.appendChild(paramDiv);

            paramDiv.querySelector('.remove-param').addEventListener('click', function() {
                paramDiv.remove();
            });

            i++;
        });

        // Supprimer les paramètres existants
        document.querySelectorAll('.remove-param').forEach(btn => {
            btn.addEventListener('click', function() {
                btn.closest('.row').remove();
            });
        });
    </script>
@endsection
