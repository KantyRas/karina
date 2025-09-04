<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDemande extends Model
{
    use HasFactory;
    protected $table = 'type_demandes';
    protected $primaryKey = 'idtypedemande';
    public $timestamps = true;

    protected $fillable = [
        'nomtype',
    ];
}
