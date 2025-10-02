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
        Schema::create('parametretype', function (Blueprint $table) {
            $table->id('idparametretype');
            $table->foreignIdFor(\App\Models\Typereleve::class, 'idtypereleve')->constrained('typereleve','idtypereleve');
            $table->string('nomparametre', 75);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametretype');
    }
};
