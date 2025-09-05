<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Employe;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roleRelation','employe'])->get();
        $roles = Role::all();
        $employes = Employe::select('idemploye','matricule','nom','prenom')
            ->orderBy('matricule')
            ->get();
        return view('maintenance.admin.list_user', [
            'users'    => $users,
            'role'     => $roles,
            'employes' => $employes,
        ]);
    }
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::create($data);
        return to_route('admin.personnel.user.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }
    public function edit(User $user)
    {
        return view('maintenance.admin.list_user',[
            'users' => User::all(),
            'employes' => Employe::all(),
            'editUser' => $user,
            'role' => Role::all(),
        ]);
    }
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return to_route('admin.personnel.user.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.personnel.user.index')->with('success','Ligne supprimée');
    }
}
