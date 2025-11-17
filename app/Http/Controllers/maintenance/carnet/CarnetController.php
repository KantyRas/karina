<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use App\Imports\MultiSheetEquipementImport;
use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\ParametreEquipement;
use App\Models\ParametreEquipementDetail;
use App\Models\HistoriqueEquipement;
use App\Models\Employe;
use App\Models\EmployeEquipement;
use App\Models\Emplacement;
use App\Models\Frequence;
use App\Http\Requests\EquipementRequest;
use App\Http\Requests\DetailEquipementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FicheManquante;

class CarnetController extends Controller
{
    public function index(){
        $user = Auth::user();
        $matricule = $user->employe->matricule ?? null;

        if (empty($matricule) || in_array($user->role,[1,2])) {
            $equipements = DB::table('v_liste_equipement_regroupe')->get();
        }
        else {
            $equipements = DB::table('v_liste_equipement_regroupe')
                ->where('matricule', 'LIKE', "%$matricule%")
                ->get();
        }
        return view('maintenance.carnet.list_carnet',[
            'equipements' => $equipements,
        ]);
    }

    public function create(){

        $emplacement = Emplacement::all();
        $employe = Employe::all();
        $frequence = Frequence::all();
        $equipement = new Equipement();

        return view('maintenance.carnet.ajout_carnet',[
            'equipements' => $equipement,
            'emplacements' => $emplacement,
            'employes' => $employe,
            'frequences' => $frequence,
        ]);
    }
    public function store(EquipementRequest $request){
        $validated = $request->validated();

        $equipements = Equipement::create([
            'nomequipement' => $validated['nomequipement'],
            'code' => 'QU0000MAI',
            'idemplacement' => $validated['idemplacement'],
        ]);


        foreach ($validated['idemploye'] as $employe) {

            $employe_equipement = EmployeEquipement::create([
                'idemploye' => $employe,
                'idequipement' => $equipements->idequipement,
            ]);
        }

        foreach ($validated['parametres'] as $parametre) {
            $parametre_equipement = ParametreEquipement::create([
                'idequipement' => $equipements->idequipement,
                'nomparametre' => $parametre['nomparametre'],
                'idfrequence' => $parametre['idfrequence'],
            ]);

        }
        return to_route('carnet.liste_carnet')->with('success', 'Equipement inseré');
    }
    public function edit($idequipement)
    {
        $equipement = Equipement::with(['employes', 'parametres.details'])->findOrFail($idequipement);
        $emplacements = Emplacement::all();
        $employes = Employe::all();
        $frequences = Frequence::all();

        $hasDetails = $equipement->parametres->contains(function($param) {
            return $param->details->count() > 0;
        });
        if ($hasDetails) {
            return back()->with('warning', "Attention : vous ne pouvez pas modifier ceci car des enregistrements existent déjà.");
        }
        return view('maintenance.carnet.edit_carnet', [
            'equipements' => $equipement,
            'emplacements' => $emplacements,
            'employes' => $employes,
            'frequences' => $frequences,
        ]);
    }
    public function update(EquipementRequest $request, $idequipement)
    {
        $validated = $request->validated();
        $equipement = Equipement::findOrFail($idequipement);
        $equipement->update([
            'nomequipement' => $validated['nomequipement'],
            'idemplacement' => $validated['idemplacement'],
        ]);
        $equipement->employes()->sync($validated['idemploye']);

        $existingParams = $equipement->parametres->keyBy('idparametreequipement');
        $submittedParams = collect($validated['parametres']);
        foreach ($submittedParams as $param) {
            if (isset($param['idparametreequipement']) && $existingParams->has($param['idparametreequipement'])) {
                $existingParam = $existingParams->get($param['idparametreequipement']);
                $existingParam->update([
                    'nomparametre' => $param['nomparametre'],
                    'idfrequence' => $param['idfrequence'],
                ]);
                $existingParams->forget($param['idparametreequipement']);
            } else {
                ParametreEquipement::create([
                    'idequipement' => $equipement->idequipement,
                    'nomparametre' => $param['nomparametre'],
                    'idfrequence' => $param['idfrequence'],
                ]);
            }
        }
        foreach ($existingParams as $paramToDelete) {
            if ($paramToDelete->details()->count() == 0) {
                $paramToDelete->delete();
            }
        }
        return to_route('carnet.liste_carnet')->with('success', 'Equipement mis à jour');
    }
    public function getDetailEquipement($idhistorique, Request $request)
    {

        $idfrequence = $request->query('idfrequence'); // ou $request->input('type')

        if($idfrequence == null){
            $idfrequence = 1;
        }

        $historique = HistoriqueEquipement::with('equipement')->findOrFail($idhistorique);
        $parametres = ParametreEquipement::with('frequence')->where('idequipement', $historique->idequipement)->get()->groupBy('frequence.idfrequence');

        $params = DB::table('v_detail_equipement')
                    ->select('nomparametre')
                    ->where('idfrequence', $idfrequence)
                    ->where('idequipement', $historique->idequipement)
                    ->distinct()
                    ->pluck('nomparametre');

        $query = DB::table('v_detail_equipement')
                    ->select(DB::raw('DATE(dateajout) as dateajout'));

        foreach ($params as $param) {
            //$query->addSelect(DB::raw("MAX(CASE WHEN nomparametre = '".addslashes($param)."' THEN valeur END) AS \"$param\""));
            $safeParam = str_replace("'", "''", $param);
            $alias = str_replace('"', '""', $param);
            $query->addSelect(DB::raw("MAX(CASE WHEN nomparametre = '$safeParam' THEN valeur END) AS \"$alias\""));
        }

        $resultats = $query
                    ->where('idfrequence', $idfrequence)
                    ->where('idequipement', $historique->idequipement)
                    ->where('idhistoriqueequipement', $idhistorique)
                    ->groupBy(DB::raw('DATE(dateajout)'))
                    ->orderBy(DB::raw('DATE(dateajout)'))
                    ->get();

        if ($request->ajax()) {
            return view('maintenance.shared.EquipementDetail', compact('params', 'resultats'))->render();
        }

        return view('maintenance.carnet.fiche_list_saisie', compact('parametres', 'historique', 'params', 'resultats', 'idfrequence'));
    }


    public function showHistorique($idequipement){
        $historiques = HistoriqueEquipement::selectRaw('
        idhistoriqueequipement,
        EXTRACT(MONTH FROM datecreation) as mois,
        EXTRACT(YEAR FROM datecreation) as annee,
        datecreation
        ')
            ->where('idequipement', $idequipement)
            ->orderBy('datecreation', 'desc')
            ->get();
        $equipement = Equipement::find($idequipement);
        return view('maintenance.carnet.fiche_carnet', compact('historiques', 'equipement'));
    }


    public function genererHistorique($idequipement){
        $date_now = now();
        $get_exists = HistoriqueEquipement::where('idequipement', $idequipement)
            ->whereMonth('datecreation', $date_now->month)
            ->whereYear('datecreation', $date_now->year)
            ->exists();
        if ($get_exists) {
            return back()->with('warning', 'La fiche pour ce mois existe déjà.');
        }
        HistoriqueEquipement::create([
            'description' => 'equipement',
            'idequipement' => $idequipement,
            'datecreation' => $date_now,
        ]);
        return back()->with('success', 'Fiche equipement du mois générée avec succès.');
    }
    public function insertDetail(DetailEquipementRequest $request){
        $data = $request->input('param', []);
        $idhistorique = $request->input('idhistoriqueequipement');

        foreach ($data as $key => $value) {

            if($value){
                ParametreEquipementDetail::create([
                    'idparametreequipement' => $key,
                    'valeur' => $value,
                    'dateajout' => now(),
                    'idhistoriqueequipement' => $idhistorique,
                ]);
            }
        }

        return back()->with('success', 'Enregistré avec succès.');
    }
    public function importEquipement(Request $request)
    {
        $request->validate([
            'fichier' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new MultiSheetEquipementImport, $request->file('fichier'));
        return back()->with('success', 'Importation terminée avec succès !');
    }

    public function verifiercutoff($idfrequence){
        FicheManquante::truncate();

        // logique:
        // excecuter a 14h
        // resultat = select * from v_cron where extract date from v_cron = date now and where idfrequence = 1 "journalier"
        // equipement = select idequipement from v_cron where idfrequence = 1 journalier (maka equipement rehetra izay manana carnet journalier)
        // si resultat misy comparena resultat sy equipement de ze tsy ao anaty resultat ampidirina anaty table
        //  vita

        // select * from v_cron where DATE(dateajout) = DATE(now()) and idfrequence = 1;
        // select idequipement_equipement from v_cron where idfrequence = 1 group by idequipement_equipement;

        $now = Carbon::now();

        $existant = DB::table('historique_equipements as he')
        ->join('equipements as e', 'e.idequipement', '=', 'he.idequipement')
        ->leftJoin('parametre_equipements as pe', 'pe.idequipement', '=', 'he.idequipement')
        ->leftJoin('parametre_equipement_details as ped', function ($join) {
            $join->on('ped.idparametreequipement', '=', 'pe.idparametreequipement')
                 ->on('ped.idhistoriqueequipement', '=', 'he.idhistoriqueequipement');
        })
        ->leftJoin('frequences as f', 'f.idfrequence', '=', 'pe.idfrequence')
        ->select(
            'ped.dateajout',
            'he.idhistoriqueequipement',
            'e.idequipement as idequipement_equipement',
            'e.nomequipement',
            'pe.idfrequence',

        )
        // ->whereRaw('DATE(ped.dateajout) = \'2025-11-08\'')
        ->whereRaw('DATE(ped.dateajout) = DATE(now())')
        ->where('pe.idfrequence', $idfrequence)
        ->groupBy('ped.dateajout', 'e.idequipement', 'e.nomequipement', 'pe.idfrequence', 'he.idhistoriqueequipement')
        ->get();

        // maka idequipement rehetra izay manana frequence journaliere
        $equipement = DB::table('historique_equipements as he')
        ->join('equipements as e', 'e.idequipement', '=', 'he.idequipement')
        ->leftJoin('parametre_equipements as pe', 'pe.idequipement', '=', 'he.idequipement')
        ->leftJoin('parametre_equipement_details as ped', function ($join) {
            $join->on('ped.idparametreequipement', '=', 'pe.idparametreequipement')
                 ->on('ped.idhistoriqueequipement', '=', 'he.idhistoriqueequipement');
        })
        ->leftJoin('frequences as f', 'f.idfrequence', '=', 'pe.idfrequence')
        ->select('e.idequipement as idequipement_equipement', 'he.idhistoriqueequipement as idhistoriqueequipement', 'pe.idfrequence as idfrequence' )
        ->where('pe.idfrequence', $idfrequence)
        ->groupBy('e.idequipement', 'he.idhistoriqueequipement', 'pe.idfrequence')
        ->get();

        // if tsy misy: inserer tous dans nv table
        // else comparer avec

        if($existant->isEmpty() ){
            // echo("insert all");

            foreach ($equipement as $item) {
                FicheManquante::create([
                    'idequipement' => $item->idequipement_equipement,
                    'date_manquante' => $now,
                    'idhistoriqueequipement' => $item->idhistoriqueequipement,
                    'idfrequence' => $item->idfrequence,
                ]);
                echo $item->idfrequence;
            }

            return back();

        }else{
            // echo("miditra comparaison");

            $existantIds = $existant->pluck('idequipement_equipement');
            $equipementIds = $equipement->pluck('idequipement_equipement');

            $manquants = $equipementIds->diff($existantIds);

            $equipementManquants = $equipement->whereIn('idequipement_equipement', $manquants);

            // echo $equipementManquants;

            foreach ($equipementManquants as $item) {
                FicheManquante::create([
                    'idequipement' => $item->idequipement_equipement,
                    'date_manquante' => $now,
                    'idhistoriqueequipement' => $item->idhistoriqueequipement,
                    'idfrequence' => $item->idfrequence,
                ]);
            }

            return back();
        }
    }
}
