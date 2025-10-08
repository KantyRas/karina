<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employetypereleve extends Model
{
    use HasFactory;
    protected $table = 'employetypereleves';
    protected $primaryKey = 'idemployetypereleve';
    protected $fillable = [
        'idemploye',
        'idtypereleve',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idemploye');
    }

    public function typereleve()
    {
        return $this->belongsTo(Typereleve::class, 'idtypereleve');
    }
}
