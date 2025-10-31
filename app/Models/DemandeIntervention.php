<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeIntervention extends Model
{
    use HasFactory;
    protected $table = 'demande_interventions';
    protected $primaryKey = 'iddemandeintervention';
    public $timestamps = true;
    protected $fillable = [
        'iddemandeur',
        'idrolereceveur',
        'idsection',
        'idtypeintervention',
        'datedemande',
        'datesouhaite',
        'description',
        'motif',
        'statut',
    ];
    public function demandeur()
    {
        return $this->belongsTo(User::class, 'iddemandeur');
    }
    public function receveurrole()
    {
        return $this->belongsTo(Role::class, 'idrole');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'idsection');
    }
    public function typeintervention()
    {
        return $this->belongsTo(TypeIntervention::class, 'idtypeintervention');
    }
}
