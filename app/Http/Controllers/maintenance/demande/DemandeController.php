<?php

namespace App\Http\Controllers\maintenance\demande;

use App\Http\Controllers\Controller;
use App\Models\DemandeTravaux;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\TypeTravaux;
use App\Models\TypeDemande;
use App\Models\Section;
use App\Http\Requests\TypeDemandeRequest;

class DemandeController extends Controller
{
    public function index(){

        return view('maintenance.demande.list_demande');
    }
    public function create(){
        return view('maintenance.demande.form_demande');
    }
    public function index_travaux(){
        $demandetravaux = DemandeTravaux::with([
            'TypeDemande',
            'section.departement',
            'demandeur'
        ])->get();
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
            'demandeur'
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
}
