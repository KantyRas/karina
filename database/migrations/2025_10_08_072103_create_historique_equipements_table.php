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
        Schema::create('historique_equipements', function (Blueprint $table) {
            $table->id('idhistoriqueequipement');
            $table->string('description', 75)->nullable();
            $table->foreignIdFor(\App\Models\Equipement::class, 'idequipement')
                  ->constrained('equipements', 'idequipement')
                  ->onDelete('cascade');
            $table->date('datecreation')->nullable();
            $table->timestamps(); // Optionnel si tu veux created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_equipements');
    }
};
