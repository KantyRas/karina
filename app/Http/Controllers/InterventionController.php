<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        return view('maintenance.intervention.list_intervention');
    }
    public function create()
    {
        return view('maintenance.intervention.create_intervention');
    }
}
