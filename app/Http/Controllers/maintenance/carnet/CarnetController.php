<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Employe;
use App\Models\Emplacement;
use App\Models\Frequence;
use App\Http\Requests\EquipementRequest;
use Illuminate\Support\Facades\DB;

class CarnetController extends Controller
{
    public function index(){

        $equipements = DB::table('equipements as eq')
        ->join('employe_equipements as e', 'e.idequipement', '=', 'eq.idequipement')
        ->join('employes as emp', 'emp.idemploye', '=', 'e.idemploye')
        ->join('emplacements as ep', 'eq.idemplacement', '=', 'ep.idemplacement')
        ->select('eq.idequipement', 'eq.nomequipement', 'eq.code', 
                'ep.idemplacement', 'ep.emplacement', 
                'e.idemploye', 'emp.nom as nomemploye', 'emp.prenom', 'emp.matricule')
        ->get();
        
        // $equipements = Equipemetnt::all();

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

        foreach ($validated['employe'] as $employe) {

            dump("idemp:".$employe);

        }

        foreach ($validated['parametres'] as $parametre) {

            dump("parametre: ".$parametre['nomparametre']);
            dump("radio: ".$parametre['idfrequence']);
        }
    }

    public function fiche_index(){
        return view('maintenance.carnet.fiche_carnet');
    }
    public function fiche_create()
    {
        return view('maintenance.carnet.fiche_list_saisie');
    }
}
