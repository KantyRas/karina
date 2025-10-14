@extends('maintenance.basefront')
@section('title','Detail equipement - Octobre 2025')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Detail equipement - {{ \Carbon\Carbon::parse($historique->datecreation)->translatedFormat('F Y') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('carnet.ajout_detail_equipement') }}" method="post" class="form-horizontal">
                        @csrf
    
                        <input type="hidden" value={{$historique->idhistoriqueequipement}} name="idhistoriqueequipement">

                        @foreach ($parametres as $idfrequence => $items)
                            <div class="mb-4 p-3 border rounded-3 bg-light">
                                <h4 class="fw-bold mb-3">
                                    {{ $items->first()->frequence->frequence }}
                                </h4>
    
                                <div class="row g-3">
                                    @foreach ($items as $index => $parametre)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="form-label fw-semibold">
                                                {{ $parametre->nomparametre }}
                                            </label>
                                            <input 
                                                type="text" 
                                                name="param[ {{ $parametre->idparametreequipement }} ]" 
                                                class="form-control shadow-sm" 
                                                placeholder="Saisir une valeur..."
                                            >
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
    
                        {{-- <hr class="my-4"> --}}
    
                        <div class="text-end">
                            <button type="submit" class="btn btn-success me-2 px-4">
                                <i class="fa fa-save me-1"></i> Enregistrer
                            </button>
                            <button type="reset" class="btn btn-outline-secondary px-4">
                                <i class="fa fa-undo me-1"></i> Réinitialiser
                            </button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <ul class="nav nav-pills ">
                        @foreach ($parametres as $idfrequence => $items)
                        <li>
                            <a 
                               class="load-fiche" 
                               data-historique="{{ $historique->idhistoriqueequipement }}" 
                               data-frequence="{{ $items->first()->frequence->idfrequence }}">
                               {{ $items->first()->frequence->frequence }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-body" id="fiche-container">
                    @include('maintenance.shared.EquipementDetail')
                </div>
            </div>
        </div>
    </div>
    @endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
            
        $('.load-fiche').click(function(e){
            e.preventDefault();
            console.log("foufoun");
    
            var idHistorique = $(this).data('historique');
            var idFrequence = $(this).data('frequence');
    
            // Ajouter la classe active aux onglets
            $('.nav-pills li').removeClass('active');
            $(this).parent().addClass('active');
    
            $.ajax({
                url: '/carnets/fiche/saisie/' + idHistorique,
                type: 'GET',
                data: { idfrequence: idFrequence },
                success: function(response){
                    $('#fiche-container').html(response);
                },
                error: function(xhr){
                    console.error("Erreur AJAX:", xhr);
                }
            });
        });
    
    });
</script>
