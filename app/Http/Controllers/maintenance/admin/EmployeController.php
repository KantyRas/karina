<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Exports\EmployesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeRequest;
use App\Models\Employe;
use App\Models\Fonction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeController extends Controller
{
    public function index()
    {
        $employe = Employe::with('fonction')->get();

        return view('maintenance.admin.list_employe',[
            'employe' => $employe,
        ]);
    }
    public function create()
    {
        return view('maintenance.admin.form_employe',[
            'fonction' => Fonction::all(),
            'employe' => new Employe(),
        ]);
    }
    public function store(EmployeRequest $request)
    {
        $employe = Employe::create($request->validated());
        return to_route('admin.personnel.employe.index')->with('success','Employe créer avec succès');
    }
    public function edit(Employe $employe)
    {
        return view('maintenance.admin.form_employe',[
            'employe' => $employe,
            'fonction' => Fonction::all(),
        ]);
    }
    public function update(EmployeRequest $request, Employe $employe)
    {
        $employe->update($request->validated());
        return to_route('admin.personnel.employe.index');

    }
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return to_route('admin.personnel.employe.index');

    }
    public function exportExcelEmploye()
    {
        return Excel::download(new EmployesExport, 'employes.xlsx');
    }
}
