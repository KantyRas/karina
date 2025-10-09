<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeReleveRequest;
use App\Models\Employe;
use App\Models\Employetypereleve;
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

        return view('maintenance.carnet.list_releve_historique', compact('historiques','idtypereleve'));
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
        $employe = Employe::all();
        return view('maintenance.carnet.ajout_type_releve',[
            'employes' => $employe,
        ]);
    }
    public function ajout_type_releve(TypeReleveRequest $request)
    {
        $validated = $request->validated();
        $typereleve = Typereleve::create([
            'nom' => $validated['nom'],
        ]);
        foreach ($validated['idemploye'] as $employe) {
            $employe_typereleve = Employetypereleve::create([
                'idemploye' => $employe,
                'idtypereleve' => $typereleve->idtypereleve,
            ]);
        }
        foreach ($validated['parametres'] as $parametre) {
            $parametretype = Parametretype::create([
                'idtypereleve' => $typereleve->idtypereleve,
                'nomparametre' => $parametre['nomparametre'],
            ]);
        }
        return to_route('carnet.liste_releve')->with('success', 'Type de relevé inséré');
    }
    public function genererHistorique($idtypereleve)
    {
        $date_now = now();
        $get_exists = Historiquereleve::where('idtypereleve', $idtypereleve)
            ->whereMonth('datecreation', $date_now->month)
            ->whereYear('datecreation', $date_now->year)
            ->exists();

        if ($get_exists) {
            return back()->with('warning', 'Le relevé pour ce mois existe déjà.');
        }

        Historiquereleve::create([
            'description' => 'Releve',
            'idtypereleve' => $idtypereleve,
            'datecreation' => $date_now,
        ]);

        return back()->with('success', 'Fiche relevé du mois générée avec succès.');
    }
}
