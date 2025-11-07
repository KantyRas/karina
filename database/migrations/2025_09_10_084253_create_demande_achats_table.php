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
        Schema::create('demande_achats', function (Blueprint $table) {
            $table->id('iddemandeachat');

            $table->foreignIdFor(\App\Models\User::class, 'iddemandeur')
                ->constrained('users', 'iduser')
                ->onDelete('cascade');

            $table->foreignIdFor(\App\Models\User::class, 'idreceveur')
                ->nullable()
                ->constrained('users', 'iduser')
                ->onDelete('cascade');

            $table->foreignId('iddemande_travaux')
                ->nullable()
                ->constrained('demande_travaux', 'iddemandetravaux')
                ->onDelete('cascade');

            $table->date('datedemande');
            $table->integer('statut')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_achats');
    }
};
