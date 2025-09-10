<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $primaryKey = 'idsection';
    public $timestamps = false;

    protected $fillable = [
        'iddepartement',
        'nomsection',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'iddepartement');
    }
}