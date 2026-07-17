<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    /**
     * Liste des entreprises.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Liste des entreprises.',
            'data' => Entreprise::all()
        ], 200);
    }

    /**
     * Afficher une entreprise.
     */
    public function show($id)
    {
        $entreprise = Entreprise::find($id);

        if (!$entreprise) {
            return response()->json([
                'message' => 'Entreprise introuvable.'
            ], 404);
        }

        return response()->json([
            'message' => 'Entreprise trouvée.',
            'data' => $entreprise
        ], 200);
    }

    /**
     * Ajouter une entreprise.
     */
    public function store(StoreEntrepriseRequest $request)
    {
        $entreprise = Entreprise::create($request->validated());

        return response()->json([
            'message' => 'Entreprise créée avec succès.',
            'data' => $entreprise
        ], 201);
    }

    /**
     * Modifier une entreprise.
     */
    public function update(UpdateEntrepriseRequest $request, $id)
    {
        $entreprise = Entreprise::find($id);

        if (!$entreprise) {
            return response()->json([
                'message' => 'Entreprise introuvable.'
            ], 404);
        }

        $entreprise->update($request->validated());

        return response()->json([
            'message' => 'Entreprise modifiée avec succès.',
            'data' => $entreprise
        ], 200);
    }

    /**
     * Supprimer une entreprise.
     */
    public function destroy($id)
    {
        $entreprise = Entreprise::find($id);

        if (!$entreprise) {
            return response()->json([
                'message' => 'Entreprise introuvable.'
            ], 404);
        }

        $entreprise->delete();

        return response()->json([
            'message' => 'Entreprise supprimée avec succès.'
        ], 200);
    }
}