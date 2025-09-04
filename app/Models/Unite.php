<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;
    protected $table = 'unites';
    protected $primaryKey = 'idunite';
    public $timestamps = true;

    protected $fillable = [
        'unite',
    ];
}
