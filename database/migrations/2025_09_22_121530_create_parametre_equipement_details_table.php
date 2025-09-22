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
        Schema::create('parametre_equipement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ParametreEquipement::class, 'idparametreequipement')->constrained('parametre_equipements','idparametreequipement');
            $table->string('valeur', 55);
            $table->timestamp('dateajout')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_equipement_details');
    }
};
