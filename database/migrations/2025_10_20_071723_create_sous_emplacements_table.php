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
        Schema::create('sous_emplacements', function (Blueprint $table) {
            $table->id('idsousemplacement');
            $table->foreignIdFor(\App\Models\Emplacement::class, 'idemplacement')->constrained('emplacements','idemplacement');
            $table->string('nom', 75);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('sous_emplacements');
    }
};
