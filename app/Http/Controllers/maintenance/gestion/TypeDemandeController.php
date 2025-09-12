<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Models\TypeDemande;
use App\Http\Requests\TypeDemandeRequest;
use Illuminate\Http\Request;

class TypeDemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maintenance.gestion.list_type_demande' ,[
            'typedemandes' => TypeDemande::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.gestion.list_type_demande');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeDemandeRequest $request)
    {
        dd("miditra");
        $typedemande = TypeDemande::create($request->validated());
        return to_route('util.gestion.typedemande.index')->with('success','Frequence créer avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeDemande $typedemande)
    {
        
        return view('maintenance.gestion.list_type_demande' ,[
            'typedemandes' => TypeDemande::all(),
            'editType' => $typedemande,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeDemandeRequest $request, TypeDemande $typedemande)
    {
        $typedemande->update($request->validated());
        return to_route('util.gestion.typedemande.index')->with('success','Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeDemande $typedemande)
    {
        $typedemande->delete();
        return to_route('util.gestion.typedemande.index')->with('success','Ligne supprimée');
    }
}