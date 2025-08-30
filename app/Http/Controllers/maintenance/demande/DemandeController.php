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
}
