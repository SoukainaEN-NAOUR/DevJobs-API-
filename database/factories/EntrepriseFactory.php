<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom_entreprise' => fake()->company(),

            'secteur' => fake()->randomElement([
                'Informatique',
                'Finance',
                'Santé',
                'Télécommunication',
                'Education'
            ]),

            'description' => fake()->sentence(),

            'logo' => 'logos/default.png',

            'id_user' => null,
        ];
    }
}