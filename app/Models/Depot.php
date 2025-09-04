<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'depots';
    protected $primaryKey = 'iddepot';
    protected $fillable = ['nom'];
    public $timestamps = false;

    public function familles()
    {
        return $this->hasMany(Famille::class, 'iddepot', 'iddepot');
    }
}
