<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;
use App\Models\Competence;

class CompetenceController extends Controller
{
    /**
     * Liste des compétences.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Liste des compétences.',
            'data' => Competence::all()
        ], 200);
    }

    /**
     * Afficher une compétence.
     */
    public function show($id)
    {
        $competence = Competence::find($id);

        if (!$competence) {
            return response()->json([
                'message' => 'Compétence introuvable.'
            ], 404);
        }

        return response()->json([
            'message' => 'Compétence trouvée.',
            'data' => $competence
        ], 200);
    }

    /**
     * Ajouter une compétence.
     */
    public function store(StoreCompetenceRequest $request)
    {
        $competence = Competence::create($request->validated());

        return response()->json([
            'message' => 'Compétence créée avec succès.',
            'data' => $competence
        ], 201);
    }

    /**
     * Modifier une compétence.
     */
    public function update(UpdateCompetenceRequest $request, $id)
    {
        $competence = Competence::find($id);

        if (!$competence) {
            return response()->json([
                'message' => 'Compétence introuvable.'
            ], 404);
        }

        $competence->update($request->validated());

        return response()->json([
            'message' => 'Compétence modifiée avec succès.',
            'data' => $competence
        ], 200);
    }

    /**
     * Supprimer une compétence.
     */
    public function destroy($id)
    {
        $competence = Competence::find($id);

        if (!$competence) {
            return response()->json([
                'message' => 'Compétence introuvable.'
            ], 404);
        }

        $competence->delete();

        return response()->json([
            'message' => 'Compétence supprimée avec succès.'
        ], 200);
    }
}