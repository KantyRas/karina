<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheIntervention extends Model
{
    use HasFactory;
    protected $table = 'fiche_interventions';
    protected $primaryKey = 'idficheintervention';
    public $timestamps = false;
    protected $fillable = ['iddemandeintervention','idemployeassigne','datecreation','dateplanifie','dateintervention'];

    public function demandeintervention()
    {
        return $this->hasOne(DemandeIntervention::class, 'iddemandeintervention', 'iddemandeintervention');
    }
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idemployeassigne', 'idemploye');
    }
}
