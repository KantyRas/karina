<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Frequence;

class DashController extends Controller
{
    public function Dashboard()
    {
        $equipement = DB::table('equipements')->count();
        $employe = DB::table('employes')->count();
        $demandeTotal = DB::table('demande_travaux')->count();
        $demandeEnCours = DB::table('demande_travaux')->where('statut', 0)->count();
        $demandeAccepte = DB::table('demande_travaux')->where('statut', 1)->count();
        $demandeIntervention = DB::table('demande_interventions')->count();
        $demandeInterventionEnCours = DB::table('demande_interventions')->where('statut', 0)->count();
        $demandeInterventionAccepte = DB::table('demande_interventions')->where('statut', 1)->count();
        $demandeAchat = DB::table('demande_achats')->count();
        $demandeAchatEnCours = DB::table('demande_achats')->where('statut', 0)->count();
        $demandeAchatAccepte = DB::table('demande_achats')->where('statut', 1)->count();
        $user = DB::table('users')->count();
        $article = DB::table('articles')->count();
        $fiche = $this->getFicheManquante();

        $frequence = Frequence::all();

        return view('maintenance.dashboard', compact(
            'equipement',
            'employe',
            'demandeTotal',
            'demandeEnCours',
            'demandeAccepte',
            'demandeIntervention',
            'demandeInterventionEnCours',
            'demandeInterventionAccepte',
            'demandeAchat',
            'demandeAchatEnCours',
            'demandeAchatAccepte',
            'user',
            'article',
            'fiche',
            'frequence',
        ));
    }

    public function getFicheManquante(){

        $ficheManquante = DB::table('fiche_manquante as f')
        ->join('equipements as eq', 'eq.idequipement', '=', 'f.idequipement')
        ->join('emplacements as ep', 'ep.idemplacement', '=', 'eq.idemplacement')
        ->join('employe_equipements as empq', 'empq.idequipement', '=', 'eq.idequipement')
        ->join('employes as emp', 'emp.idemploye', '=', 'empq.idemploye')
        ->join('frequences as fq', 'fq.idfrequence', '=', 'f.idfrequence')
        ->select(
            'f.date_manquante',
            'f.idhistoriqueequipement',
            'eq.idequipement',
            'eq.nomequipement',
            'ep.emplacement',
            DB::raw("STRING_AGG(DISTINCT emp.nom || ' ' || emp.prenom, ' - ') AS employe"),
            'fq.idfrequence',
            'fq.frequence'
        )
        ->groupBy(
            'f.idhistoriqueequipement',
            'eq.idequipement',
            'eq.nomequipement',
            'ep.emplacement',
            'fq.idfrequence',
            'fq.frequence',
            'f.date_manquante'
        )
        ->get();

        return $ficheManquante;
    }
}
