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
                ->constrained('users', 'iduser') 
                ->onDelete('cascade');
        
            $table->foreignIdFor(\App\Models\TypeDemande::class, 'idtypedemande')
                ->constrained('type_demandes', 'idtypedemande') 
                ->onDelete('cascade');
        
            $table->foreignId('iddemande_travaux')
                ->constrained('demande_travaux', 'iddemandetravaux')  
                ->onDelete('cascade');
            
            $table->date('datedemande');  
            $table->text('description');  
        
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
