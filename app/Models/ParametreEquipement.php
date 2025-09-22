<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametreEquipement extends Model
{
    protected $table = 'parametre_equipements';
    protected $primaryKey = 'idparametreequipement';
    protected $fillable = ['idequipement', 'nomparametre', 'idfrequence'];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'idequipement');
    }

    public function frequence()
    {
        return $this->belongsTo(Frequence::class, 'idfrequence');
    }

    public function details()
    {
        return $this->hasMany(ParametreEquipementDetail::class, 'idparametreequipement');
    }
}
