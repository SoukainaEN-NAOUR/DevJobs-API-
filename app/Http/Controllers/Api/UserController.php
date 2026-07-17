<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Liste des utilisateurs.',
            'data' => User::with(['entreprise', 'competences'])->get()
        ], 200);
    }

    /**
     * Afficher un utilisateur.
     */
    public function show($id)
    {
        $user = User::with(['entreprise', 'competences'])->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);
        }

        return response()->json([
            'message' => 'Utilisateur trouvé.',
            'data' => $user
        ], 200);
    }

    /**
     * Modifier un utilisateur.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);
        }

        // L'utilisateur modifie son propre profil ou admin
        if (
            auth()->id() != $user->id_user &&
            !auth()->user()->isAdmin()
        ) {
            return response()->json([
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $user->update($request->validated());

        return response()->json([
            'message' => 'Utilisateur modifié avec succès.',
            'data' => $user
        ], 200);
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.'
        ], 200);
    }

    /**
     * Ajouter une compétence à un candidat.
     */
    public function addCompetence($idUser, $idCompetence)
    {
        $user = User::find($idUser);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);
        }

        if (
            auth()->id() != $user->id_user &&
            !auth()->user()->isAdmin()
        ) {
            return response()->json([
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $user->competences()->syncWithoutDetaching([$idCompetence]);

        return response()->json([
            'message' => 'Compétence ajoutée avec succès.'
        ], 200);
    }

    /**
     * Supprimer une compétence d'un candidat.
     */
    public function removeCompetence($idUser, $idCompetence)
    {
        $user = User::find($idUser);

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);
        }

        if (
            auth()->id() != $user->id_user &&
            !auth()->user()->isAdmin()
        ) {
            return response()->json([
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $user->competences()->detach($idCompetence);

        return response()->json([
            'message' => 'Compétence supprimée avec succès.'
        ], 200);
    }
}