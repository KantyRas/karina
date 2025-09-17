<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailArticle extends Model
{
    use HasFactory;

     protected $table = 'detail_articles';
     protected $primaryKey = 'idarticledemande';
     public $timestamps = false;


     protected $fillable = [
         'iddemandeachat',
         'idarticle',
         'quantitedemande',
     ];

     public function demande()
     {
         return $this->belongsTo(DemandeAchat::class, 'iddemandeachat');
     }

     public function article()
     {
         return $this->belongsTo(Article::class, 'idarticle');
     }
}
