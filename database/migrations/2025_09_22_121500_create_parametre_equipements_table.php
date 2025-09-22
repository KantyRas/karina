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
        Schema::create('parametre_equipements', function (Blueprint $table) {
            $table->id('idparametreequipement');
            $table->foreignIdFor(\App\Models\Equipement::class, 'idequipement')->constrained('equipements','idequipement');
            $table->string('nomparametre');
            $table->foreignIdFor(\App\Models\Frequence::class, 'idfrequence')->constrained('frequences','idfrequence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_equipements');
    }
};
