<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\Offre;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Entreprise::all() as $entreprise) {

            Offre::factory(rand(2,5))->create([
                'id_entreprise' => $entreprise->id_entreprise,
            ]);

        }
    }
}