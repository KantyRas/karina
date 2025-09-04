<?php

namespace App\Http\Controllers\maintenance\gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniteRequest;
use App\Models\Unite;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    public function index()
    {
        return view('maintenance.gestion.list_unite',[
            'unites' => Unite::all(),
        ]);
    }

    public function store(UniteRequest $request)
    {
        $unites = Unite::create($request->validated());
        return to_route('util.gestion.unite.index')->with('success','Unité créer avec succès');
    }
    public function edit(Unite $unite)
    {
        return view('maintenance.gestion.list_unite', [
            'unites' => Unite::all(),
            'editUnite' => $unite,
        ]);
    }
    public function update(UniteRequest $request, Unite $unite)
    {
        $unite->update($request->validated());
        return to_route('util.gestion.unite.index')->with('success','Modifié avec succès');
    }
    public function destroy(Unite $unite)
    {
        $unite->delete();
        return to_route('util.gestion.unite.index')->with('success','Ligne supprimée');
    }
}
