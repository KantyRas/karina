<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_articles', function (Blueprint $table) {
            $table->id('idarticledemande'); 
            $table->foreignIdFor(\App\Models\DemandeAchat::class, 'iddemandeachat') 
                ->constrained('demande_achats','iddemandeachat') 
                ->onDelete('cascade'); 
            $table->foreignIdFor(\App\Models\Article::class, 'idarticle') 
                ->constrained('articles','idarticle') 
                ->onDelete('cascade'); 
            $table->double('quantitedemande'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_articles');
    }
};
