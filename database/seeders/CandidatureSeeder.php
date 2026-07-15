<?php

namespace Database\Seeders;

use App\Models\Candidature;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidatureSeeder extends Seeder
{
    public function run(): void
    {
        $candidats = User::where('role','candidat')->get();

        foreach (Offre::all() as $offre) {

            foreach ($candidats->random(min(3,$candidats->count())) as $candidat) {

                Candidature::create([
                    'statut' => fake()->randomElement([
                        'en_attente',
                        'acceptee',
                        'refusee'
                    ]),

                    'date_candidature' => fake()->date(),

                    'id_offre' => $offre->id_offre,

                    'id_user' => $candidat->id_user,
                ]);

            }
        }
    }
}