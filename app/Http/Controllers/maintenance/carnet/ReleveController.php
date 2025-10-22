<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailReleveRequest;
use App\Http\Requests\TypeReleveRequest;
use App\Models\Detailreleve;
use App\Models\Employe;
use App\Models\Employetypereleve;
use App\Models\Historiquereleve;
use App\Models\Parametretype;
use App\Models\Typereleve;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
        $typeReleve = Typereleve::find($idtypereleve);

        return view('maintenance.carnet.list_releve_historique', compact('historiques','idtypereleve','typeReleve'));
    }
    private function getDetailReleveData($idhistoriquereleve)
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

        return compact('historique', 'parametres', 'details');
    }

    public function get_releve_historique_detail($idhistoriquereleve)
    {
        $data = $this->getDetailReleveData($idhistoriquereleve);

        return view('maintenance.carnet.list_releve_historique_detail', $data);
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
    public function exportPdfReleveMensuel($idhistoriquereleve)
    {
        $data = $this->getDetailReleveData($idhistoriquereleve);

        $mois = \Carbon\Carbon::parse($data['historique']->datecreation)->translatedFormat('F');
        $annee = \Carbon\Carbon::parse($data['historique']->datecreation)->year;
        $typeReleve = $data['historique']->TypeReleve;

        $pdf = Pdf::loadView('maintenance.carnet.pdf_detail_releve', [
            ...$data,
            'mois' => $mois,
            'annee' => $annee,
            'typeReleve' => $typeReleve,
        ]);

        return $pdf->stream("releve_{$typeReleve->nom}_{$mois}_{$annee}.pdf");
    }
    public function ajout_detatil_releve(DetailReleveRequest $request,$idhistoriquereleve)
    {
        $params = $request->input('param', []);
        $today = Carbon::today();

        $existe = Detailreleve::where('idhistoriquereleve', $idhistoriquereleve)
            ->whereDate('datereleve', $today)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('warning', 'Le relevé du jour a déjà été enregistré.');
        }
        foreach ($params as $idparametretype => $valeur) {
            if (!empty($valeur)) {
                Detailreleve::create([
                    'idhistoriquereleve' => $idhistoriquereleve,
                    'idparametretype' => $idparametretype,
                    'valeur' => $valeur,
                    'datereleve' => Carbon::now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Relevé enregistré avec succès !');
    }
}
