<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplacement extends Model
{
    use HasFactory;

    protected $table = 'emplacements';
    protected $primaryKey = 'idemplacement';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false; // Ne gère pas created_at / updated_at

    protected $fillable = [
        'emplacement',
    ];
    

}