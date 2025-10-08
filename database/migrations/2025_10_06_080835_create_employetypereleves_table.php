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
        Schema::create('employetypereleves', function (Blueprint $table) {
            $table->id('idemployetypereleve');
            $table->foreignIdFor(\App\Models\Employe::class, 'idemploye')->constrained('employes','idemploye');
            $table->foreignIdFor(\App\Models\Typereleve::class,'idtypereleve')->constrained('typereleve','idtypereleve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employetypereleve');
    }
};
