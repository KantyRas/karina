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
        Schema::create('demande_interventions', function (Blueprint $table) {
            $table->id('iddemandeintervention');
            $table->foreignIdFor(\App\Models\User::class, 'iddemandeur')
                ->constrained('users', 'iduser')
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Role::class, 'idrolereceveur')
                ->constrained('roles', 'idrole')
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Section::class, 'idsection')
                ->constrained('sections', 'idsection')
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\TypeIntervention::class, 'idtypeintervention')
                ->constrained('type_interventions', 'idtypeintervention')
                ->onDelete('cascade');
            $table->date('datedemande')->nullable();
            $table->date('datesouhaite')->nullable();
            $table->text('description')->nullable();
            $table->text('motif')->nullable();
            $table->integer('statut')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_interventions');
    }
};
