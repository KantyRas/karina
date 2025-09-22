<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $table = 'equipements';
    protected $primaryKey = 'idequipement';
    protected $fillable = ['nomequipement', 'code', 'idemplacement'];

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class, 'idemplacement');
    }

    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'employe_equipements', 'idequipement', 'idemploye');
    }

    public function parametres()
    {
        return $this->hasMany(ParametreEquipement::class, 'idequipement');
    }
}
