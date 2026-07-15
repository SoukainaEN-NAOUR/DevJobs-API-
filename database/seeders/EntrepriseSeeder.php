<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'entreprise')->get();

        foreach ($users as $user) {

            Entreprise::factory()->create([
                'id_user' => $user->id_user,
            ]);

        }
    }
}