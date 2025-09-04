<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmplacementRequest;
use App\Models\Emplacement;
use Illuminate\Http\Request;

class EmplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maintenance.gestion.list_emplacement',[
            'emplacements' => Emplacement::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmplacementRequest $request)
    {
        $emplacements = Emplacement::create($request->validated());
        return to_route('util.gestion.emplacement.index')->with('success','Emplacement créer avec succès');
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
    public function edit(Emplacement $emplacement)
    {
        return view('maintenance.gestion.list_emplacement', [
            'emplacements' => Emplacement::all(),
            'editEmplacement' => $emplacement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmplacementRequest $request, Emplacement $emplacement)
    {
        $emplacement->update($request->validated());
        return to_route('util.gestion.emplacement.index')->with('success','Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emplacement $emplacement)
    {
        $emplacement->delete();
        return to_route('util.gestion.emplacement.index')->with('success','Ligne supprimée');
    }
}
