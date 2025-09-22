<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametreEquipementDetail extends Model
{
    protected $table = 'parametre_equipement_details';
    protected $fillable = ['idparametreequipement', 'valeur', 'dateajout'];

    public function parametre()
    {
        return $this->belongsTo(ParametreEquipement::class, 'idparametreequipement');
    }
}
