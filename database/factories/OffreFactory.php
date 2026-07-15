<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->randomElement([
                'Développeur Laravel',
                'Développeur React',
                'Développeur Full Stack',
                'Backend Developer',
                'Frontend Developer'
            ]),

            'description' => fake()->paragraph(),

            'type_contrat' => fake()->randomElement([
                'CDI',
                'CDD',
                'Stage',
                'Freelance'
            ]),

            'id_entreprise' => Entreprise::factory(),
        ];
    }
}