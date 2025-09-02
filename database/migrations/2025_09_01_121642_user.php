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
            $table->id('iduser');
            $table->foreignIdFor(\App\Models\Employe::class, 'idemploye')
                  ->nullable()
                  ->constrained('employes', 'idemploye')
                  ->nullOnDelete();
            $table->string('username', 75)->unique();
            $table->string('email', 75)->unique();
            $table->string('password', 255);
            $table->foreignIdFor(\App\Models\Role::class, 'role')
                  ->nullable()
                  ->constrained('roles', 'idrole')
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
