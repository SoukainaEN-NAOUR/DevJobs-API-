<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompetenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => fake()->unique()->randomElement([
                'PHP',
                'Laravel',
                'Java',
                'Spring Boot',
                'React',
                'Vue.js',
                'JavaScript',
                'Python',
                'SQL',
                'Docker',
                'Git',
                'Linux'
            ]),
            'description' => fake()->sentence(),
        ];
    }
}