<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('prenom', 50);
            $table->string('nom', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('role', ['candidat', 'entreprise', 'admin'])->default('candidat');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};