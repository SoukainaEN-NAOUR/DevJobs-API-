<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    /**
     * Afficher tous les utilisateurs.
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'message' => 'Liste des utilisateurs.',
            'data' => $users
        ], 200);
    }

/**
 * Afficher un utilisateur.
 */
public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'Utilisateur introuvable.'
        ], 404);
    }

    return response()->json([
        'message' => 'Utilisateur trouvé.',
        'data' => $user
    ], 200);
}public function update(UpdateUserRequest $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'Utilisateur introuvable.'
        ], 404);
    }

    $user->update([
        'prenom' => $request->prenom,
        'nom' => $request->nom,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return response()->json([
        'message' => 'Utilisateur modifié avec succès.',
        'data' => $user
    ], 200);
}public function destroy($id)
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
}}