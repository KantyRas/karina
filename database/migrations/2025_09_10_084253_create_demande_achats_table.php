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
            $table->id('iddemandeachat');  // Clé primaire de la table demande_achats
    
            // Clé étrangère vers la table users pour 'iddemandeur'
            $table->foreignIdFor(\App\Models\User::class, 'iddemandeur')
                ->constrained('users', 'iduser')  // Spécifie explicitement la table 'users' et la colonne 'id'
                ->onDelete('cascade');
        
            // Clé étrangère vers la table users pour 'idreceveur'
            $table->foreignIdFor(\App\Models\User::class, 'idreceveur')
                ->constrained('users', 'iduser')  // Spécifie explicitement la table 'users' et la colonne 'id'
                ->onDelete('cascade');
        
            // Clé étrangère vers la table TypeDemande pour 'idtypedemande'
            $table->foreignIdFor(\App\Models\TypeDemande::class, 'idtypedemande')
                ->constrained('type_demandes', 'idtypedemande')  // Spécifie la table 'type_demande' et la colonne 'id'
                ->onDelete('cascade');
        
            // Clé étrangère vers la table demande_travaux pour 'iddemandeachat' (si tu veux associer les demandes d'achat aux demandes de travaux)
            $table->foreignId('iddemande_travaux')
                ->constrained('demande_travaux', 'iddemandetravaux')  // Spécifie la table 'demande_travaux' et la colonne 'iddemandetravaux'
                ->onDelete('cascade');
            
            // Autres champs
            $table->date('datedemande');  // Date de la demande
            $table->text('description');  // Description de la demande
        
            $table->timestamps();  // Champs created_at et updated_at
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
