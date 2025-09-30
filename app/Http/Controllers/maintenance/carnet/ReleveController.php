<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReleveController extends Controller
{
    public function index()
    {
        return view('maintenance.carnet.list_releve');
    }
    public function get_releve_historique()
    {
        return view('maintenance.carnet.list_releve_historique');
    }
    public function get_releve_historique_detail()
    {
        return view('maintenance.carnet.list_releve_historique_detail');
    }
}
