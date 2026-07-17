<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Offre;
use App\Models\Competence;
use App\Models\Candidature;

class StatistiqueController extends Controller
{
    /**
     * Statistiques globales.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Statistiques globales.',

            'data' => [

                'utilisateurs' => User::count(),

                'candidats' => User::where('role', 'candidat')->count(),

                'entreprises' => Entreprise::count(),

                'offres' => Offre::count(),

                'competences' => Competence::count(),

                'candidatures' => Candidature::count(),

                'candidatures_en_attente' =>
                    Candidature::where('statut', 'en_attente')->count(),

                'candidatures_acceptees' =>
                    Candidature::where('statut', 'acceptee')->count(),

                'candidatures_refusees' =>
                    Candidature::where('statut', 'refusee')->count(),

            ]

        ], 200);
    }
}