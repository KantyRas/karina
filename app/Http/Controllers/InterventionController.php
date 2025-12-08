<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeInterventionRequest;
use App\Http\Requests\FicheInterventionRequest;
use App\Models\DemandeIntervention;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\FicheIntervention;
use App\Models\TypeIntervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = DemandeIntervention::with(['demandeur', 'receveurrole','section.departement','typeintervention']);
        if(!in_array($user->role,[1,2])){
            $query = $query->where('iddemandeur',$user->iduser);
        }
        $demandes = $query->get();
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
    public function get_detail_intervention($iddemandeintervention)
    {
        $details = DemandeIntervention::with('demandeur','receveurrole','section.departement','typeintervention')->findOrFail($iddemandeintervention);
        return view('maintenance.intervention.detail_intervention',compact('details'));
    }
    public function get_form_ficheintervention($iddemandeintervention)
    {
        $ficheExistante = FicheIntervention::where('iddemandeintervention', $iddemandeintervention)->first();

        if ($ficheExistante) {
            return redirect()->back()->with('warning', 'Un bon d’intervention existe déjà pour cette demande.');
        }
        $employes = Employe::all();
        return view('maintenance.intervention.form_ficheintervention',[
            'iddemandeintervention' => $iddemandeintervention,
            'employes' => $employes,
        ]);
    }
    public function storeFicheIntervention(FicheInterventionRequest $request)
    {
        $validated = $request->validated();
        //dd($validated['iddemandeintervention']);
        $fiche_intervention = FicheIntervention::create($validated);
        //return $this->get_detail_intervention($validated['iddemandeintervention']);
        return to_route('demande.intervention.detail_intervention', $validated['iddemandeintervention']);
    }
    public function get_detail_ficheintervention($iddemandeintervention): \Illuminate\Http\JsonResponse
    {
        $fiche = FicheIntervention::with('employe')
            ->where('iddemandeintervention', $iddemandeintervention)
            ->first();

        if (!$fiche) {
            return response()->json(['error' => 'Aucune fiche trouvée pour cette demande.'], 404);
        }

        return response()->json([
            'idfiche' => "FI/nº".str_pad($fiche->idficheintervention,4,0,STR_PAD_LEFT),
            'iddemande' => "DI/nº".str_pad($fiche->iddemandeintervention,4,0,STR_PAD_LEFT),
            'employe' => $fiche->employe->matricule ?? 'Non assigné',
            'datecreation' => $fiche->datecreation,
            'dateplanifie' => $fiche->dateplanifie,
            'dateintervention' => $fiche->dateintervention,
        ]);
    }
    public function getDateIntervention($iddemandeintervention,Request $request)
    {
        $fiche = FicheIntervention::where('iddemandeintervention', $iddemandeintervention)->first();

        if (!empty($fiche->dateintervention)) {
            return back()->with('warning', 'Cette intervention est déjà terminée.');
        }

        $fiche->update([
            'dateintervention' => $request->input('dateintervention')
        ]);

        return back()->with('success', 'Date d’intervention enregistrée avec succès.');
    }
    public function validerFicheIntervention($iddemandeintervention)
    {
        $demande_intervention = DemandeIntervention::findOrFail($iddemandeintervention);
        $demande_intervention->update(['statut' => 1]);
        return back()->with('success','Demande intervention validée.');
    }
}
