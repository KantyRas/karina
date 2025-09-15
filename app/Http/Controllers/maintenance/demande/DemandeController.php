<?php

namespace App\Http\Controllers\maintenance\demande;

use App\Http\Controllers\Controller;
use App\Models\DemandeAchat;
use App\Models\DetailArticle;
use Illuminate\Support\Facades\Auth;
use App\Models\FicheJoint;
use Illuminate\Http\Request;
use App\Http\Requests\DemandetravauxRequest;
use App\Http\Requests\DemandeAchatRequest;
use App\Models\Departement;
use App\Models\TypeTravaux;
use App\Models\TypeDemande;
use App\Models\Article;
use App\Models\DemandeTravaux;
use App\Models\Section;
use App\Http\Requests\TypeDemandeRequest;

class DemandeController extends Controller
{
    public function index(){
        $demandes = DemandeAchat::with(['demandeur','demandeTravaux'])->get();
        return view('maintenance.demande.list_demande',[
            'demandes' => $demandes,
        ]);
    }

    public function create(Request $request){
        $article = Article::all();
        $iddemandetravaux = $request->query('id');
        return view('maintenance.demande.form_demande',[
            'articles' => $article,
            'iddemandetravaux' => $iddemandetravaux,
        ]);
    }
    public function store(DemandeAchatRequest $request){
        $validated = $request->validated();
        $demande = DemandeAchat::create([
            'iddemandeur'   => $validated['iddemandeur'],
            'idreceveur'    => null,
            'iddemande_travaux' => $validated['iddemande_travaux'],
            'datedemande'   => $validated['datedemande'],
        ]);
        foreach ($validated['items'] as $item) {
            DetailArticle::create([
                'iddemandeachat'  => $demande->iddemandeachat,
                'idarticle'       => $item['designation'],
                'quantitedemande' => $item['quantitedemande'],
            ]);
        }
        if (!empty($validated['iddemande_travaux'])) {
            $this->updateValider($validated['iddemande_travaux']);
        }
        return to_route('demande.index')->with('success','Demande achat créer avec succès');
    }
    public function index_travaux(){

        $user = Auth::user();

        $query = DemandeTravaux::with([
            'TypeDemande',
            'section.departement',
            'users'
        ]);

        if ($user->role != 1) {
            $query->where('iddemandeur', $user->iduser);
        }

        $demandetravaux = $query->get();

        return view('maintenance.demande.list_travaux',[
            'demandetravaux' => $demandetravaux,
        ]);
    }
    public function ajout_travaux(){
        return view('maintenance.demande.form_travaux',[
            'departements' => Departement::all(),
            'typetravaux' => TypeTravaux::all(),
            'typedemandes' => TypeDemande::all(),
        ]);
    }
    public function get_detail_travaux($iddemandeTravaux){
        $details = DemandeTravaux::with([
            'section.departement',
            'typeDemande',
            'typeTravaux',
            'users',
            'fichiers'
        ])->findOrFail($iddemandeTravaux);

        return view('maintenance.demande.detail_travaux', [
            'details' => $details,
        ]);
    }

    public function getResponsable($iddepartement){
        $responsable = Departement::select('responsable')
            ->where('iddepartement', $iddepartement)
            ->first();

        $section = Section::select('*')
            ->where('iddepartement', $iddepartement)
            ->get();

        return response()->json([
            'responsable' => $responsable,
            'section' => $section
        ]);
    }

    public function updateValider($iddemandetravaux) {
        DemandeTravaux::where('iddemandetravaux', $iddemandetravaux)->update(['statut' => 1]);
        return to_route('demande.liste_demande_travaux')->with('success','Demande validé');
    }

    public function refuserDemande($iddemandetravaux) {
        DemandeTravaux::where('iddemandetravaux', $iddemandetravaux)->update(['statut' => 2]);
        return to_route('demande.liste_demande_travaux')->with('succes','Demande refusé');
    }

    public function storetravaux(DemandeTravauxRequest $request){

        $demandeTravaux = DemandeTravaux::create($request->validated());

        if ($request->hasFile('fichiers')) {
            foreach ($request->file('fichiers') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->store('fiche_joint', 'public');

                FicheJoint::create([
                    'fichier' => $path,
                    'nom' => $originalName,
                    'iddemandetravaux' => $demandeTravaux->iddemandetravaux,
                ]);
            }
        }

        return to_route('demande.liste_demande_travaux')->with('success','Demande créer avec succès');
    }
}
