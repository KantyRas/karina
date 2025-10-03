<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use App\Models\Historiquereleve;
use App\Models\Parametretype;
use App\Models\Typereleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReleveController extends Controller
{
    public function index()
    {
        $typesReleves = Typereleve::with('parametres')->get();

        return view('maintenance.carnet.list_releve', compact('typesReleves'));
    }
    public function get_releve_historique($idtypereleve)
    {
        $historiques = Historiquereleve::selectRaw('
            idhistoriquereleve,
            EXTRACT(MONTH FROM datecreation) as mois,
            EXTRACT(YEAR FROM datecreation) as annee,
            datecreation
        ')
            ->where('idtypereleve', $idtypereleve)
            ->orderBy('datecreation', 'desc')
            ->get();

        return view('maintenance.carnet.list_releve_historique', compact('historiques'));
    }
    public function get_releve_historique_detail($idhistoriquereleve)
    {
        $historique = Historiquereleve::with('TypeReleve')->findOrFail($idhistoriquereleve);

        $parametres = Parametretype::where('idtypereleve', $historique->idtypereleve)->get();

        $selects = ['d.datereleve'];
        foreach ($parametres as $p) {
            $selects[] = "MAX(d.valeur) FILTER (WHERE p.idparametretype = {$p->idparametretype}) AS \"{$p->nomparametre}\"";
        }

        $sql = "
        SELECT " . implode(", ", $selects) . "
        FROM detailreleve d
        JOIN parametretype p ON p.idparametretype = d.idparametretype
        WHERE d.idhistoriquereleve = ?
        GROUP BY d.datereleve
        ORDER BY d.datereleve
    ";

        $details = DB::select($sql, [$idhistoriquereleve]);

        return view('maintenance.carnet.list_releve_historique_detail', compact('historique', 'parametres', 'details'));
    }
    public function get_form_ajout_type_releve()
    {
        return view('maintenance.carnet.ajout_type_releve');
    }

}
