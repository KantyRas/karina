<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('maintenance.admin.list_role',[
            'roles' => Role::all(),
        ]);
    }
    public function store(RoleRequest $request)
    {
        $roles = Role::create($request->validated());
        return to_route('admin.personnel.role.index')->with('success','Role créer avec succès');
    }
    public function edit(Role $role)
    {
        return view('maintenance.admin.list_role', [
            'roles' => Role::all(),
            'editRole' => $role,
        ]);
    }
    public function update(RoleRequest $request, Role $role)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
