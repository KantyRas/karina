<?php

namespace App\Http\Controllers\maintenance\carnet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarnetController extends Controller
{
    public function index(){
        return view('maintenance.carnet.list_carnet');
    }
    public function create(){
        return view('maintenance.carnet.ajout_carnet');
    }
    public function fiche_index(){
        return view('maintenance.carnet.fiche_carnet');
    }
    public function fiche_create()
    {
        return view('maintenance.carnet.fiche_list_saisie');
    }
}
