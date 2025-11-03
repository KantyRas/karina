<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueEquipement extends Model
{
    use HasFactory;

    protected $table = 'historique_equipements';
    protected $primaryKey = 'idhistoriqueequipement';
    public $timestamps = false; // ou false si tu n’utilises pas created_at / updated_at

    protected $fillable = [
        'description',
        'idequipement',
        'datecreation',
    ];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'idequipement', 'idequipement');
    }
}
