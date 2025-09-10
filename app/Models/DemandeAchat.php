<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    use HasFactory;

    protected $table = 'demande_achat';
    public $timestamps = false;


    // Définir les colonnes mass-assignables
    protected $fillable = [
        'iddemandeur',
        'idreceveur',
        'idtypedemande',
        'datedemande',
        'description',
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

    // Relation avec TypeDemande (many-to-one)
    public function typeDemande()
    {
        return $this->belongsTo(TypeDemande::class, 'idtypedemande');
    }
}
