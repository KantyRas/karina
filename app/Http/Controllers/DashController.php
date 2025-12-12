<?php

namespace App\Http\Controllers;

use App\Models\Parametretype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $statsBase = [
            'equipement' => DB::table('equipements')->count(),
            'employe'    => DB::table('employes')->count(),
            'user'       => DB::table('users')->count(),
            'article'    => DB::table('articles')->count(),
        ];
        $demandeTravaux = DB::table('demande_travaux')
            ->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN statut = 0 THEN 1 ELSE 0 END) as encours,
            SUM(CASE WHEN statut = 1 THEN 1 ELSE 0 END) as accepte
        ')
            ->first();
        $demandeInterventions = DB::table('demande_interventions')
            ->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN statut = 0 THEN 1 ELSE 0 END) as encours,
            SUM(CASE WHEN statut = 1 THEN 1 ELSE 0 END) as accepte
        ')
            ->first();
        $demandeAchat = DB::table('demande_achats')
            ->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN statut = 0 THEN 1 ELSE 0 END) as encours,
            SUM(CASE WHEN statut = 1 THEN 1 ELSE 0 END) as accepte
        ')
            ->first();
        $fiche = $this->getFicheManquante();
        $frequence = Frequence::select('idfrequence','frequence')->get();
        return view('maintenance.dashboard', array_merge($statsBase, [
            'restricted' => false,

            'demandeTotal' => $demandeTravaux->total,
            'demandeEnCours' => $demandeTravaux->encours,
            'demandeAccepte' => $demandeTravaux->accepte,

            'demandeIntervention' => $demandeInterventions->total,
            'demandeInterventionEnCours' => $demandeInterventions->encours,
            'demandeInterventionAccepte' => $demandeInterventions->accepte,

            'demandeAchat' => $demandeAchat->total,
            'demandeAchatEnCours' => $demandeAchat->encours,
            'demandeAchatAccepte' => $demandeAchat->accepte,

            'fiche' => $fiche,
            'frequence' => $frequence,
        ]));
    }

    public function getFicheManquante(){

        $ficheManquante = DB::table('fiche_manquante as f')
        ->join('equipements as eq', 'eq.idequipement', '=', 'f.idequipement')
        ->join('emplacements as ep', 'ep.idemplacement', '=', 'eq.idemplacement')
        ->join('employe_equipements as empq', 'empq.idequipement', '=', 'eq.idequipement')
        ->join('employes as emp', 'emp.idemploye', '=', 'empq.idemploye')
        ->join('frequences as fq', 'fq.idfrequence', '=', 'f.idfrequence')
        ->select([
            'f.date_manquante',
            'f.idhistoriqueequipement',
            'eq.idequipement',
            'eq.nomequipement',
            'ep.emplacement',
            DB::raw("STRING_AGG(DISTINCT emp.nom || ' ' || emp.prenom, ' - ') AS employe"),
            'fq.frequence'
        ])
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
        $parametres = Cache::remember('parametretype_all', 3600, function () {
            return Parametretype::select('idparametretype','nomparametre')->get();
        });
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
        $data = Cache::remember('tableau_releve', 60, function () {
            return $this->getTableauReleve();
        });

        return response()->json([
            'resultats' => $data['resultats'],
            'parametres' => $data['parametres']
        ]);
    }

}

