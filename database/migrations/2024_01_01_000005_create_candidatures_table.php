<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id('id_candidature');
            $table->enum('statut', ['en_attente', 'acceptee', 'refusee'])->default('en_attente');
            $table->date('date_candidature')->useCurrent();

            $table->foreignId('id_offre')
                ->constrained('offres', 'id_offre')
                ->onDelete('cascade');

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onDelete('cascade');

            $table->timestamps();

            // Un candidat ne peut postuler qu'une seule fois à la même offre
            $table->unique(['id_offre', 'id_user']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};