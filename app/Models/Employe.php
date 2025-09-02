<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';
    protected $primaryKey = 'idemploye';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'idfonction',
        'email',
        'telephone',
        'estActif',
    ];

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'idfonction', 'idfonction');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'idemploye', 'idemploye');
    }
}
