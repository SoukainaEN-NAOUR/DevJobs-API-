<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offre_competence', function (Blueprint $table) {
            $table->foreignId('id_offre')
                ->constrained('offres', 'id_offre')
                ->onDelete('cascade');

            $table->foreignId('id_competence')
                ->constrained('competences', 'id_competence')
                ->onDelete('cascade');

            $table->primary(['id_offre', 'id_competence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offre_competence');
    }
};