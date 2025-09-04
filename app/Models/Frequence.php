<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequence extends Model
{
    use HasFactory;
    protected $table = 'frequences';
    protected $primaryKey = 'idfrequence';
    public $timestamps = true;

    protected $fillable = [
        'frequence',
    ];
}
