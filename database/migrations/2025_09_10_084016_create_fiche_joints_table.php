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
        Schema::create('fiche_joints_travaux', function (Blueprint $table) {
            $table->id('idfichejoint');
            $table->string('fichier', 155);
            $table->string('nom', 155);
            $table->foreignIdFor(\App\Models\DemandeTravaux::class, 'iddemandetravaux')
                ->constrained('demande_travaux', 'iddemandetravaux')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_joints_travaux');
    }
};
