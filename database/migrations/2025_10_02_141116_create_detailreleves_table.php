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
        Schema::create('detailreleve', function (Blueprint $table) {
            $table->id('iddetailreleve');
            $table->foreignIdFor(\App\Models\Historiquereleve::class, 'idhistoriquereleve')->constrained('historiquereleve','idhistoriquereleve');
            $table->foreignIdFor(\App\Models\Parametretype::class, 'idparametretype')->constrained('parametretype','idparametretype');
            $table->string('valeur', 75);
            $table->date('datereleve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailreleve');
    }
};
