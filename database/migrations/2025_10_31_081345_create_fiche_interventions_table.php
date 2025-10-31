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
        Schema::create('fiche_interventions', function (Blueprint $table) {
            $table->id('idficheintervention');
            $table->foreignIdFor(\App\Models\DemandeIntervention::class, 'iddemandintervention')
                ->constrained('demande_interventions', 'iddemandeintervention')
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Employe::class, 'idemployeassigne')
                ->constrained('employes', 'idemploye')
                ->onDelete('cascade');
            $table->date('datecreation');
            $table->timestamp('dateplanifie');
            $table->timestamp('dateintervention');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_interventions');
    }
};
