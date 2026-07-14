<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id('id_entreprise');
            $table->string('nom_entreprise', 100);
            $table->string('secteur', 50);
            $table->string('description', 255);
            $table->string('logo', 255)->nullable();

            $table->foreignId('id_user')
                ->unique()
                ->constrained('users', 'id_user')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};