<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailArticle extends Model
{
    use HasFactory;

     // Définir le nom de la table si nécessaire
     protected $table = 'detail_articles';
     protected $primaryKey = 'idarticledemande';
     public $timestamps = false;


     // Définir les colonnes mass-assignables
     protected $fillable = [
         'iddemandeachat',
         'idarticle',
         'quantitedemande',
     ];

     // Relation avec Demande (many-to-one)
     public function demande()
     {
         return $this->belongsTo(DemandeAchat::class, 'iddemandeachat');
     }

     // Relation avec Article (many-to-one)
     public function article()
     {
         return $this->belongsTo(Article::class, 'idarticle');
     }
}
