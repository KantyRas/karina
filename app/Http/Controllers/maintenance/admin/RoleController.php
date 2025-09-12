<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Role::all());
        }
        return view('maintenance.admin.list_role');
    }
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());
        return response()->json(['success' => true, 'message' => 'Rôle créé avec succès', 'data' => $role]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return response()->json(['success' => true, 'message' => 'Rôle modifié avec succès', 'data' => $role]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success' => true, 'message' => 'Rôle supprimé']);
    }
}
