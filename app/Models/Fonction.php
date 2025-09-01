<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

    protected $table = 'fonctions';
    protected $primaryKey = 'idFonction';
    public $timestamps = false;

    protected $fillable = [
        'fonction',
    ];

    public function employes()
    {
        return $this->hasMany(Employe::class, 'idFonction', 'idFonction');
    }
}