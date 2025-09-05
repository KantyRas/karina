<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Models\Frequence;
use App\Http\Requests\FrequenceRequest;
use Illuminate\Http\Request;

class FrequenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maintenance.gestion.list_frequence' ,[
            'frequences' => Frequence::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.gestion.list_frequence');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FrequenceRequest $request)
    {
        $frequence = Frequence::create($request->validated());
        return to_route('util.gestion.frequence.index')->with('success','Frequence créer avec succès');
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
    public function edit(Frequence $frequence)
    {
        dd($frequence->idfrequence);

        return view('maintenance.gestion.list_frequence' ,[
            'frequences' => Frequence::all(),
            'editFrequence' => $frequence,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FrequenceRequest $request, Frequence $frequence)
    {
        $frequence->update($request->validated());
        return to_route('util.gestion.frequence.index')->with('success','Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequence $frequence)
    {
        $frequence->delete();
        return to_route('util.gestion.frequence.index')->with('success','Ligne supprimée');
    }
}
