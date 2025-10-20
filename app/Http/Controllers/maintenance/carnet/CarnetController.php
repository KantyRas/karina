<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarnetController extends Controller
{
    public function index(){

        // $equipements = DB::table('equipements as eq')
        // ->join('employe_equipements as e', 'e.idequipement', '=', 'eq.idequipement')
        // ->join('employes as emp', 'emp.idemploye', '=', 'e.idemploye')
        // ->join('emplacements as ep', 'eq.idemplacement', '=', 'ep.idemplacement')
        // ->select('eq.idequipement', 'eq.nomequipement', 'eq.code', 
        //         'ep.idemplacement', 'ep.emplacement', 
        //         'e.idemploye', 'emp.nom as nomemploye', 'emp.prenom', 'emp.matricule')
        // ->get();
        
        $equipements = DB::table('v_liste_equipement_regroupe')->get();

        return view('maintenance.carnet.list_carnet',[
            'equipements' => $equipements,
        ]);
    }

    public function create(){

        $emplacement = Emplacement::all();
        $employe = Employe::all();
        $frequence = Frequence::all();

        return view('maintenance.carnet.ajout_carnet',[
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
            $query->addSelect(DB::raw("MAX(CASE WHEN nomparametre = '".addslashes($param)."' THEN valeur END) AS \"$param\""));
        }

        $resultats = $query
                    ->where('idfrequence', $idfrequence)
                    ->where('idequipement', $historique->idequipement)
                    ->groupBy(DB::raw('DATE(dateajout)'))
                    ->orderBy(DB::raw('DATE(dateajout)'))
                    ->get();

        if ($request->ajax()) {
            return view('maintenance.shared.EquipementDetail', compact('params', 'resultats'))->render();
        }

        return view('maintenance.carnet.fiche_list_saisie', compact('parametres', 'historique', 'params', 'resultats', 'idfrequence'));
    }

    public function showHistorique($idequipement){
        $historiques = HistoriqueEquipement::join('equipements as e', 'e.idequipement', '=', 'historique_equipements.idequipement')
        ->join('emplacements as em', 'em.idemplacement', '=', 'e.idemplacement')
        ->leftJoin('sous_emplacements as s', 's.idemplacement', '=', 'e.idemplacement')
        ->select(
            'historique_equipements.idhistoriqueequipement',
            'historique_equipements.description',
            'historique_equipements.idequipement',
            'historique_equipements.datecreation',
            'em.idemplacement',
            's.idsousemplacement',
            's.nom as sous_emplacement',
            DB::raw('EXTRACT(MONTH FROM historique_equipements.datecreation) as mois'),
            DB::raw('EXTRACT(YEAR FROM historique_equipements.datecreation) as annee')
        )
        ->where('historique_equipements.idequipement', $idequipement)
        ->orderBy('historique_equipements.datecreation', 'desc')
        ->get();

        $equipement = Equipement::find($idequipement);

        return view('maintenance.carnet.fiche_carnet', compact('historiques', 'equipement'));

    }

    public function genererHistorique($idequipement){
        $date_now = now();

        $get_exists = HistoriqueEquipement::join('equipements as e', 'e.idequipement', '=', 'historique_equipements.idequipement')
        ->join('emplacements as em', 'em.idemplacement', '=', 'e.idemplacement')
        ->leftJoin('sous_emplacements as s', 's.idemplacement', '=', 'e.idemplacement')
        ->where('historique_equipements.idequipement', $idequipement)
        ->where('s.idsousemplacement', $idsousemplacement)
        ->whereMonth('historique_equipements.datecreation', $date_now->month)
        ->whereYear('historique_equipements.datecreation', $date_now->year)
        ->exists();

        if ($get_exists) {
            return back()->with('warning', 'La fiche pour ce mois existe déjà.');
        }

        HistoriqueEquipement::create([
            'description' => 'equipement',
            'idequipement' => $idequipement,
            'datecreation' => $date_now,
        ]);

        // SousEmplacement::create([

        // ]);

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

}