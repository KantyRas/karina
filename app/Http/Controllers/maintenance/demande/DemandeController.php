<?php

namespace App\Http\Controllers\maintenance\demande;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index(){

        return view('maintenance.demande.list_demande');
    }
    public function create(){
        return view('maintenance.demande.form_demande');
    }
    public function index_travaux(){
        return view('maintenance.demande.list_travaux');
    }
    public function ajout_travaux(){
        return view('maintenance.demande.form_travaux');
    }
    public function get_detail_travaux(){
        return view('maintenance.demande.detail_travaux');
    }
}
