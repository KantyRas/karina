<?php

namespace App\Http\Controllers\maintenance\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        return view('maintenance.admin.list_employe');
    }
    public function create()
    {
        return view('maintenance.admin.form_employe');
    }
    public function store(Request $request)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
