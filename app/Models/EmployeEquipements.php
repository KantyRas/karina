<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeEquipement extends Model
{
    protected $table = 'employe_equipements';
    protected $fillable = ['idemploye', 'idequipement'];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idemploye');
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'idequipement');
    }
}
