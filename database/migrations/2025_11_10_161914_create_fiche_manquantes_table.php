<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiche_manquante', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Equipement::class, 'idequipement')
                ->constrained('equipements', 'idequipement')
                ->cascadeOnDelete();

            $table->date('date_manquante');

            $table->foreignIdFor(\App\Models\Frequence::class, 'idfrequence')
                ->constrained('frequences', 'idfrequence')
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\HistoriqueEquipement::class, 'idhistoriqueequipement')
                ->constrained('historique_equipements', 'idhistoriqueequipement')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiche_manquante');
    }
};
