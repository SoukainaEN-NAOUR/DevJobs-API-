<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompetenceSeeder::class,
            EntrepriseSeeder::class,
            OffreSeeder::class,
            CandidatureSeeder::class,
        ]);

        // Pivot user_competence

        $competences = Competence::pluck('id_competence');

        foreach (User::where('role','candidat')->get() as $user) {

            $user->competences()->attach(
                $competences->random(rand(2,5))->toArray()
            );

        }

        // Pivot offre_competence

        foreach (Offre::all() as $offre) {

            $offre->competences()->attach(
                $competences->random(rand(2,5))->toArray()
            );

        }
    }
}