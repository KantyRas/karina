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
        Schema::create('demande_travaux', function (Blueprint $table) {
            $table->id('iddemandetravaux');
            $table->foreignIdFor(\App\Models\Section::class, 'idsection')
            ->constrained('sections', 'idsection') // table et colonne de clé primaire spécifiées
            ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\TypeDemande::class, 'idtypedemande')
            ->constrained('type_demandes', 'idtypedemande') // table et colonne de clé primaire spécifiées
            ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\TypeTravaux::class, 'idtypetravaux')
            ->constrained('type_travaux', 'idtypetravaux') // table et colonne de clé primaire spécifiées
            ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class, 'iddemandeur')
            ->constrained('users', 'iduser') // table et colonne de clé primaire spécifiées
            ->onDelete('cascade');

            $table->date('datedemande');
            $table->date('datesouhaite'); 
            $table->string('numeroserie', 100); 
            $table->integer('statut'); 
            $table->text('motif'); 
            $table->text('description'); 

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_travaux');
    }
};
