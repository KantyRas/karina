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
        Schema::table('demande_travaux', function (Blueprint $table) {
            $table->text('raisonrefus')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_travaux');
    }
};
