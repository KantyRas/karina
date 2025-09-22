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
        Schema::create('employe_equipements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Employe::class, 'idemploye')->constrained('employes','idemploye');
            $table->foreignIdFor(\App\Models\Equipement::class, 'idequipement')->constrained('equipements','idequipement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_equipements');
    }
};
