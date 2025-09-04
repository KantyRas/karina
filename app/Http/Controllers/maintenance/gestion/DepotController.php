<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepotRequest;
use App\Models\Depot;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maintenance.gestion.list_depot',[
            'depots' => Depot::all(),
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
    public function store(DepotRequest $request)
    {
        $depots = Depot::create($request->validated());
        return to_route('util.gestion.depot.index')->with('success','Depot créer avec succès');
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
    public function edit(Depot $depot)
    {
        return view('maintenance.gestion.list_depot',[
            'depots' => Depot::all(),
            'editDepot' => $depot,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepotRequest $request, Depot $depot)
    {
        $depot->update($request->validated());
        return to_route('util.gestion.depot.index')->with('success','Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depot $depot)
    {
        $depot->delete();
        return to_route('util.gestion.depot.index')->with('success','Ligne supprimée');
    }
}
