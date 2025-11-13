<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheManquante extends Model
{
    use HasFactory;

    protected $table = 'fiche_manquante';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idequipement',
        'date_manquante',
        'idfrequence',
        'idhistoriqueequipement',
    ];

    /**
     * Relation avec le modèle Equipement
     */
    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'idequipement', 'idequipement');
    }

    /**
     * Relation avec le modèle Frequence
     */
    public function frequence()
    {
        return $this->belongsTo(Frequence::class, 'idfrequence', 'idfrequence');
    }

    /**
     * Relation avec le modèle HistoriqueEquipement
     */
    public function historiqueEquipement()
    {
        return $this->belongsTo(HistoriqueEquipement::class, 'idhistoriqueequipement', 'idhistoriqueequipement');
    }
}
