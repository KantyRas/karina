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
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUser');
            $table->foreignIdFor(\App\Models\Employe::class, 'idEmploye')
                  ->nullable()
                  ->constrained('employes', 'idEmploye')
                  ->nullOnDelete();
            $table->string('username', 75)->unique();
            $table->string('email', 75)->unique();
            $table->string('password', 255);
            $table->foreignIdFor(\App\Models\Role::class, 'role')
                  ->nullable()
                  ->constrained('roles', 'idRole')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};