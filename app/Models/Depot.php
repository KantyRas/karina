<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $table = 'depots';
    protected $primaryKey = 'iddepot';
    public $incrementing = true;

    public $timestamps = false; // Ne gère pas created_at / updated_at

    protected $fillable = [
        'nom',
    ];
}