<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
        ));
    }
}
