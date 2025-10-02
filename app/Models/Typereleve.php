<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typereleve extends Model
{
    use HasFactory;
    protected $table = 'typereleve';
    protected $primaryKey = 'idtypereleve';
    public $timestamps = false;

    protected $fillable = [
        'nom'
    ];

    public function parametres()
    {
        return $this->hasMany(Parametretype::class, 'idtypereleve');
    }
}
