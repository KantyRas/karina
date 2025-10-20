<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousEmplacement extends Model
{
    use HasFactory;

    protected $table = 'sous_emplacements';
    protected $primaryKey = 'idsousemplacement';
    public $timestamps = false;

    protected $fillable = [
        'idemplacement',
        'nom',
    ];

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class, 'idemplacement');
    }
}
