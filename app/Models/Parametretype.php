<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametretype extends Model
{
    use HasFactory;
    protected $table = 'parametretype';
    protected $primaryKey = 'idparametretype';
    public $timestamps = false;

    protected $fillable = ['idtypereleve','nomparametre'];

    public function typeReleve()
    {
        return $this->belongsTo(Typereleve::class, 'idtypereleve');
    }
}
