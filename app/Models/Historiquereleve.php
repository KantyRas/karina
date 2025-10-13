<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiquereleve extends Model
{
    use HasFactory;
    protected $table = 'historiquereleve';
    protected $primaryKey = 'idhistoriquereleve';
    public $timestamps = true;

    protected $fillable = [
        'description',
        'idtypereleve',
        'datecreation',
    ];

    public function TypeReleve()
    {
        return $this->belongsTo(Typereleve::class, 'idtypereleve');
    }
}
