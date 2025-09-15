<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $primaryKey = 'idarticle';
    protected $fillable = ['code','designation','depot','famille','unite'];
    public $timestamps = false;

}
