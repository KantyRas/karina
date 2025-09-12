<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheJoint extends Model
{
    use HasFactory;

    protected $table = 'fiche_joints_travaux';
    protected $primaryKey = 'idfichejoint';
    public $timestamps = false;

    // Définir les colonnes mass-assignables
    protected $fillable = [
        'fichier',
        'nom',
        'iddemandetravaux',
    ];

    // Relation avec DemandeTravaux (many-to-one)
    public function demandeTravaux()
    {
        return $this->belongsTo(DemandeTravaux::class, 'iddemandetravaux');
    }
}
