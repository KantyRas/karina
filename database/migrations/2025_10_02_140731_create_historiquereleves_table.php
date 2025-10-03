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
        Schema::create('historiquereleve', function (Blueprint $table) {
            $table->id('idhistoriquereleve');
            $table->string('description', 75);
            $table->foreignIdFor(\App\Models\Typereleve::class, 'idtypereleve')->constrained('typereleve','idtypereleve');
            $table->date('datecreation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiquereleve');
    }
};
