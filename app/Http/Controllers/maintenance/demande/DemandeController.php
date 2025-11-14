<?php

namespace App\Http\Controllers\maintenance\demande;

use App\Exports\DemandeAchatExport;
use App\Http\Controllers\Controller;
use App\Models\DemandeAchat;
use App\Models\DetailArticle;
use App\Models\User;
use App\Notifications\DemandeTravauxValider;
use App\Notifications\NewDemandeAchat;
use App\Notifications\NewDemandeTravaux;
use App\Notifications\ValiderDemandeAchat;
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
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class DemandeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $query = DemandeAchat::with(['demandeur', 'demandeTravaux']);
        if ($user->role != 1 && $user->role != 4) {
            $query = $query->where('iddemandeur',$user->iduser);
        }
        $demandes = $query->get();
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
            'idreceveur'    => 3,
            'iddemande_travaux' => $validated['iddemande_travaux'],
            'datedemande'   => $validated['datedemande'],
        ]);
        $receveur = User::find($demande->idreceveur);

        if ($receveur) {
            $receveur->notify(new NewDemandeAchat($demande));
        }
        foreach ($validated['items'] as $item) {
            $articleId = null;
            if (is_numeric($item['designation'])) {
                $articleId = $item['designation'];
            } else {
                $newArticle = Article::create([
                    'code'        => 'QU0000MAI',
                    'designation' => $item['designation'],
                    'depot' => '4.FOURNITURE',
                    'famille'     => 'FOURN. D\'ENTR.PETIT EQUIP.',
                    'unite'       => 'PCS',
                ]);
                $articleId = $newArticle->idarticle;
            }
            DetailArticle::create([
                'iddemandeachat'  => $demande->iddemandeachat,
                'idarticle'       => $articleId,
                'quantitedemande' => $item['quantitedemande'],
            ]);
        }
        if (!empty($validated['iddemande_travaux'])) {
            $this->updateValider($validated['iddemande_travaux'], $request);
        }
        return to_route('demande.index')->with('success','Demande achat créer avec succès');
    }
    public function updateValiderAchat($iddemandeachat)
    {
        $demande = DemandeAchat::findOrFail($iddemandeachat);
        $demande->update(['statut' => 1]);
        $demandeur = User::find($demande->iddemandeur);
        if ($demandeur) {
            $demandeur->notify(new ValiderDemandeAchat($demande));
        }
        return back()->with('success','Demande d\'achat validé avec succès');
    }
    public function refuserDemandeAchat($iddemandeachat)
    {
        $demande = DemandeAchat::findOrFail($iddemandeachat);
        $demande->update(['statut' => 2]);
        return back();
    }
    public function get_detail_achat($iddemandeachat)
    {
        $details = DemandeAchat::with([
            'demandeur',
            'receveur',
            'demandeTravaux',
            'detailArticles.article'
        ])->findOrFail($iddemandeachat);

        return view('maintenance.demande.detail_demande', [
            'details' => $details,
        ]);
    }

    public function index_travaux(){

        $user = Auth::user();

        $query = DemandeTravaux::with([
            'TypeDemande',
            'section.departement',
            'users'
        ])->orderBy('datedemande', 'asc');

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
    public function get_detail_travaux($iddemandetravaux){
        $details = DemandeTravaux::with([
            'section.departement',
            'typeDemande',
            'typeTravaux',
            'users',
            'fichiers'
        ])->findOrFail($iddemandetravaux);

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

    public function updateValider($iddemandetravaux,Request $request) {
        $demande = DemandeTravaux::findOrFail($iddemandetravaux);
        $demande->update(['statut' => 1]);
        $demandeur = User::find($demande->iddemandeur);
        if ($demandeur) {
            $demandeur->notify(new DemandeTravauxValider($demande));
        }
        $valideur = User::find($demande->typeDemande->id_receveur);
        if ($valideur) {
            $valideur->unreadNotifications
                ->where('data.demandetravaux_id', $demande->iddemandetravaux)
                ->each(function($notification){
                    $notification->markAsRead();
                });
        }
        return to_route('demande.liste_demande_travaux')->with('success','Demande validé');
    }

    public function refuserDemande($iddemandetravaux) {
        DemandeTravaux::where('iddemandetravaux', $iddemandetravaux)->update(['statut' => 2]);
        return to_route('demande.liste_demande_travaux')->with('succes','Demande refusé');
    }
    public function updateDate(Request $request, $iddemandetravaux)
    {
        $request->validate([
            'datereelle' => 'required|date',
            'action' => 'required|string',
        ]);

        $demande = DemandeTravaux::findOrFail($iddemandetravaux);
        $demande->update([
            'datereelle' => $request->datereelle
        ]);

        if ($request->action === 'achat') {
            return redirect()->route('demande.create', ['id' => $demande->iddemandetravaux]);
        } elseif ($request->action === 'valider') {
            return redirect()->route('demande.valider', $demande->iddemandetravaux);
        }

        return back()->with('error', 'Action inconnue');
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
        $receveur = User::find($demandeTravaux->typeDemande->id_receveur);

        if ($receveur) {
            $receveur->notify(new NewDemandeTravaux($demandeTravaux));
        }
        return to_route('demande.liste_demande_travaux')->with('success','Demande créer avec succès');
    }

    public function exportPdf($iddemandeachat)
    {
        $details = DemandeAchat::with([
            'demandeur',
            'receveur',
            'demandeTravaux',
            'detailArticles.article'
        ])->findOrFail($iddemandeachat);

        $pdf = Pdf::loadView('maintenance.PDF.detailAchat', compact('details'));
        return $pdf->stream('demande.pdf');
    }
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
    public function exportExcelDemandeAchat($iddemandeachat)
    {
        $nomFichier = 'DemandeAchat_' . str_pad($iddemandeachat, 4, '0', STR_PAD_LEFT) . '.xlsx';
        return Excel::download(new DemandeAchatExport($iddemandeachat), $nomFichier);
    }
}
