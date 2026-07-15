<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'prenom' => 'Admin',
            'nom' => 'System',
            'email' => 'admin@devjobs.com',
            'role' => 'admin',
        ]);

        // Entreprises
        User::factory()->count(5)->create([
            'role' => 'entreprise',
        ]);

        // Candidats
        User::factory()->count(10)->create([
            'role' => 'candidat',
        ]);
    }
}