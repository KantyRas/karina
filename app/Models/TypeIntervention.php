<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeIntervention extends Model
{
    use HasFactory;
    protected $table = 'type_interventions';
    protected $primaryKey = 'idtypeintervention';
    protected $fillable = ['type'];
}
