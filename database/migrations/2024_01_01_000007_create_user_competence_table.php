<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_competence', function (Blueprint $table) {
            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onDelete('cascade');

            $table->foreignId('id_competence')
                ->constrained('competences', 'id_competence')
                ->onDelete('cascade');

            $table->primary(['id_user', 'id_competence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_competence');
    }
};