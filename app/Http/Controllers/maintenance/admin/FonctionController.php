<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use App\Http\Requests\FonctionRequest;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    public function index()
    {
        $fonction = Fonction::all();

        return view('maintenance.admin.list_fonction' ,[
            'fonction' => $fonction,
        ]);
        
    }
    public function create()
    {
        return view('maintenance.admin.form_fonction');
    }
    public function store(FonctionRequest $request)
    {
        $fonction = Fonction::create($request->validated());
        return to_route('admin.personnel.fonction.index')->with('success','Fomction créer avec succès');
    }
    public function edit(Fonction $fonction)
    {
        return view('maintenance.admin.list_fonction' ,[
            'fonction' => Fonction::all(),
            'editFonction' => $fonction,
        ]);
        
    }
    public function update(FonctionRequest $request, Fonction $fonction)
    {
        $fonction->update($request->validated());
        return to_route('admin.personnel.fonction.index')->with('success','Modifié avec succès');
    }
    public function destroy(Fonction $fonction)
    {
        $fonction->delete();
        return to_route('admin.personnel.fonction.index')->with('success','Ligne supprimée');
    }
}