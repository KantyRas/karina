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
        Schema::table('parametre_equipement_details', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\HistoriqueEquipement::class, 'idhistoriqueequipement')
                  ->constrained('historique_equipements', 'idhistoriqueequipement')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parametre_equipement_details', function (Blueprint $table) {
            $table->dropForeign(['idhistoriqueequipement']);
            $table->dropColumn('idhistoriqueequipement');
        });
    }
};