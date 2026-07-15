<?php

namespace Database\Factories;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'statut' => fake()->randomElement([
                'en_attente',
                'acceptee',
                'refusee'
            ]),

            'date_candidature' => fake()->date(),

            'id_offre' => Offre::factory(),

            'id_user' => User::factory()->state([
                'role' => 'candidat'
            ]),
        ];
    }
}