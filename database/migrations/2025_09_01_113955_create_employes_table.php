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
        Schema::create('employes', function (Blueprint $table) {
            $table->id('idEmploye');
            $table->string('nom', 75);
            $table->string('prenom', 75);
            $table->string('matricule', 10)->unique();
            $table->foreignIdFor(\App\Models\Fonction::class, 'idFonction')
                  ->nullable()
                  ->constrained('fonctions', 'idFonction')
                  ->cascadeOnDelete();
            $table->string('email', 75)->unique();
            $table->string('telephone', 10)->nullable();
            $table->boolean('estActif')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
