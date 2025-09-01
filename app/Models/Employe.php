<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';
    protected $primaryKey = 'idEmploye';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'idFonction',
        'email',
        'telephone',
        'estActif',
    ];

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'idFonction', 'idFonction');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'idEmploye', 'idEmploye');
    }
}
