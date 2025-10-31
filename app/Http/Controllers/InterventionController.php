<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeInterventionRequest;
use App\Models\DemandeIntervention;
use App\Models\Departement;
use App\Models\TypeIntervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        $demandes = DemandeIntervention::with('demandeur','receveurrole','section.departement','typeintervention')->get();
        return view('maintenance.intervention.list_intervention',compact('demandes'));
    }
    public function create()
    {
        $departements = Departement::all();
        $typeintervention = TypeIntervention::all();
        return view('maintenance.intervention.create_intervention',
            compact('departements', 'typeintervention')
        );
    }
    public function store(DemandeInterventionRequest $request)
    {
        $validated = $request->validated();
        $demande = DemandeIntervention::create($validated);
        return to_route('demande.intervention.liste_intervention')->with('success','Demande d\'intervention créer avec succès');
    }
}
