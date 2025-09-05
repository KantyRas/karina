<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamilleRequest;
use App\Models\{Depot, Famille};
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depots = Depot::all();
        return view('maintenance.gestion.list_famille',[
            'depots' => $depots,
            'familles' => Famille::all(),
        ]);
    }
    public function store(FamilleRequest $request)
    {
        $data = $request->validated();
        $famille = Famille::create($data);
        return to_route('util.gestion.famille.index')
            ->with('success', 'Famille créé avec succès.');
    }
    public function edit(Famille $famille)
    {
        return view('maintenance.gestion.list_famille',[
            'depots' => Depot::all(),
            'familles' => Famille::all(),
            'editFamille' => $famille,
        ]);
    }

    public function update(FamilleRequest $request, Famille $famille)
    {
        $data = $request->validated();
        $famille->update($data);
        return to_route('util.gestion.famille.index')
            ->with('success', 'Famille modifié avec succès.');
    }
    public function destroy(Famille $famille)
    {
        $famille->delete();
        return to_route('util.gestion.famille.index')->with('success','Ligne supprimée');
    }
}
