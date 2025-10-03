<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailreleve extends Model
{
    use HasFactory;
    protected $table = 'detailreleve';
    protected $primaryKey = 'iddetailreleve';
    public $timestamps = false;

    protected $fillable = [
        'idhistoriquereleve',
        'idparametretype',
        'valeur',
        'datereleve',
    ];

    public function HistoriqueReleve()
    {
        return $this->belongsTo(Historiquereleve::class, 'idhistoriquereleve');
    }
    public function ParametreType()
    {
        return $this->belongsTo(Parametretype::class, 'idparametretype');
    }
}
