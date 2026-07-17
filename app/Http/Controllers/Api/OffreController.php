<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOffreRequest;
use App\Http\Requests\UpdateOffreRequest;
use App\Models\Offre;

class OffreController extends Controller
{
    /**
     * Liste des offres.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Liste des offres.',
            'data' => Offre::all()
        ], 200);
    }

    /**
     * Afficher une offre.
     */
    public function show($id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json([
                'message' => 'Offre introuvable.'
            ], 404);
        }

        return response()->json([
            'message' => 'Offre trouvée.',
            'data' => $offre
        ], 200);
    }

    /**
     * Ajouter une offre.
     */
    public function store(StoreOffreRequest $request)
    {
        $offre = Offre::create($request->validated());

        return response()->json([
            'message' => 'Offre créée avec succès.',
            'data' => $offre
        ], 201);
    }

    /**
     * Modifier une offre.
     */
    public function update(UpdateOffreRequest $request, $id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json([
                'message' => 'Offre introuvable.'
            ], 404);
        }

        $offre->update($request->validated());

        return response()->json([
            'message' => 'Offre modifiée avec succès.',
            'data' => $offre
        ], 200);
    }

    /**
     * Supprimer une offre.
     */
    public function destroy($id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json([
                'message' => 'Offre introuvable.'
            ], 404);
        }

        $offre->delete();

        return response()->json([
            'message' => 'Offre supprimée avec succès.'
        ], 200);
    }
}