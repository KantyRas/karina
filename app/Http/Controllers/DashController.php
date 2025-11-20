<?php

namespace App\Http\Controllers;

use App\Models\Parametretype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Frequence;

class DashController extends Controller
{
    public function Dashboard()
    {
        $role = auth()->user()->role;
        if (!in_array($role, [1,2])) {
            return view('maintenance.dashboard', [
                'restricted' => true
            ]);
        }
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
        //$releveData = $this->getTableauReleve();
        $frequence = Frequence::all();

        return view('maintenance.dashboard', [
            'restricted' => false,
            'equipement' => $equipement,
            'employe' => $employe,
            'demandeTotal' => $demandeTotal,
            'demandeEnCours' => $demandeEnCours,
            'demandeAccepte' => $demandeAccepte,
            'demandeIntervention' => $demandeIntervention,
            'demandeInterventionEnCours' => $demandeInterventionEnCours,
            'demandeInterventionAccepte' => $demandeInterventionAccepte,
            'demandeAchat' => $demandeAchat,
            'demandeAchatEnCours' => $demandeAchatEnCours,
            'demandeAchatAccepte' => $demandeAchatAccepte,
            'user' => $user,
            'article' => $article,
            'fiche' => $fiche,
            'frequence' => $frequence,
            //'tableauReleve' => $releveData['resultats'],
            //'parametresReleve' => $releveData['parametres'],
        ]);
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
    public function getTableauReleve()
    {
        $parametres = Parametretype::all();
        $colonnes = [];
        foreach ($parametres as $p) {
            $nom = addslashes($p->nomparametre);
            $colonnes[] = "MAX(CASE WHEN p.idparametretype = {$p->idparametretype} THEN d.valeur END) AS \"{$nom}\"";
        }
        $colonnesSql = implode(",\n    ", $colonnes);
        $sql = "
        SELECT
            d.datereleve AS date,
            EXTRACT(MONTH FROM d.datereleve) AS mois,
            EXTRACT(YEAR FROM d.datereleve) AS annee,
            $colonnesSql
        FROM detailreleve d
        JOIN parametretype p ON p.idparametretype = d.idparametretype
        JOIN historiquereleve h ON h.idhistoriquereleve = d.idhistoriquereleve
        JOIN typereleve t ON t.idtypereleve = h.idtypereleve
        GROUP BY d.datereleve
        ORDER BY d.datereleve
    ";
        $resultats = DB::select($sql);
        //dd($resultats);
        $previous_eau = null;
        $previous_elec = null;

        foreach ($resultats as $row) {
            if (property_exists($row, "Releve compteur eau")) {
                $current_eau = $row->{"Releve compteur eau"};
                if ($previous_eau !== null) {
                    $row->{"conso m3"} = $current_eau - $previous_eau;
                } else {
                    $row->{"conso m3"} = "####";
                }
                $previous_eau = $current_eau;
            }

            if (property_exists($row, "Releve compteur electicite")) {
                $current_elec = $row->{"Releve compteur electicite"};
                if ($previous_elec !== null && $current_elec !== null) {
                    $row->{"conso KWH/J"} = $current_elec - $previous_elec;
                } else {
                    $row->{"conso KWH/J"} = "####";
                }
                $previous_elec = $current_elec;
            }
        }
        return [
            'resultats' => $resultats,
            'parametres' => $parametres
        ];
    }
    public function ajaxTableauReleve()
    {
        $data = $this->getTableauReleve();

        return response()->json([
            'resultats' => $data['resultats'],
            'parametres' => $data['parametres']
        ]);
    }

}

