<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function getEquipement(){
        $equipement = DB::table('equipements')->count();

        return compact('equipement');
    }

    public function getEmploye(){
        $employe = DB::table('employes')->count();

        return compact('employe');
    }

    public function getDemande(){

        $demandeTotal = DB::table('demande_travaux')->count;

        $demandeEnCours = DB::table('demande_travaux')
                        ->where('statut','<>', 0)
                        ->count();
                        
        $demandeAccepte = DB::table('demande_travaux')
                        ->where('statut','<>', 0)
                        ->count;

        return compact('demandeTotal', 'demandeEnCours', 'demandeAccepte');
    }

    public function Dashboard(){
        $equipement = $this->getEquipement();
        $employe = $this->getEmploye();
        $demande = $this->getDemande();

        return view('maintenance.dashboard', [
            'equipements' => $equipement,
            'employes' => $employe,
            'demandes' => $demande
        ]);

    }
};
