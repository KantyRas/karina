<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    use HasFactory;

    protected $table = 'familles';
    protected $primaryKey = 'idfamille';

    public $timestamps = false;

    protected $fillable = [
        'iddepot',
        'nom',
    ];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'iddepot','iddepot');
    }
}
