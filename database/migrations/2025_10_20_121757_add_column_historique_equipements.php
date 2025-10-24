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
        Schema::table('historique_equipements', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\SousEmplacement::class, 'idsousemplacement')
            ->nullable()
                  ->constrained('sous_emplacements', 'idsousemplacement')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historique_equipements', function (Blueprint $table) {
            $table->dropForeign(['idsousemplacement']);
            $table->dropColumn('idsousemplacement');
        });
    }
};
