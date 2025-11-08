<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeTravaux extends Model
{
    use HasFactory;

    protected $table = 'demande_travaux';
    protected $primaryKey = 'iddemandetravaux';
    public $timestamps = false;


    // Définir les colonnes mass-assignables
    protected $fillable = [
        'idsection',
        'idtypedemande',
        'idtypetravaux',
        'iddemandeur',
        'demandeur',
        'datedemande',
        'datesouhaite',
        'datereelle',
        'numeroserie',
        'statut',
        'motif',
        'description',
    ];

    // Relation avec Section (many-to-one)
    public function section()
    {
        return $this->belongsTo(Section::class, 'idsection');
    }

    // Relation avec TypeDemande (many-to-one)
    public function typeDemande()
    {
        return $this->belongsTo(TypeDemande::class, 'idtypedemande');
    }

    // Relation avec TypeTravaux (many-to-one)
    public function typeTravaux()
    {
        return $this->belongsTo(TypeTravaux::class, 'idtypetravaux');
    }

    // Relation avec User (many-to-one)
    public function users()
    {
        return $this->belongsTo(User::class, 'iddemandeur');
    }
    public function fichiers()
    {
        return $this->hasMany(FicheJoint::class, 'iddemandetravaux');
    }

}
