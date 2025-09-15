<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    use HasFactory;

    protected $table = 'demande_achats';
    protected $primaryKey = 'iddemandeachat';
    public $timestamps = false;


    // Définir les colonnes mass-assignables
    protected $fillable = [
        'iddemandeur',
        'idreceveur',
        'iddemande_travaux',
        'datedemande',
    ];

    // Relation avec User pour le demandeur (many-to-one)
    public function demandeur()
    {
        return $this->belongsTo(User::class, 'iddemandeur');
    }

    // Relation avec User pour le receveur (many-to-one)
    public function receveur()
    {
        return $this->belongsTo(User::class, 'idreceveur');
    }

    public function demandeTravaux()
    {
        return $this->belongsTo(DemandeTravaux::class, 'iddemande_travaux');
    }
}
