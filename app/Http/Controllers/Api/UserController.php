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
        $users = User::with('competences')->get();

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
        $user = User::with('competences')
            ->find($id);


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



        // User ne peut modifier que son propre profil
        if ($user->id_user != auth()->id()
            && !auth()->user()->isAdmin()) {


            return response()->json([
                'message' => 'Vous ne pouvez pas modifier cet utilisateur.'
            ], 403);

        }



        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
        ]);



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



        // Suppression réservée à l'admin
        if (!auth()->user()->isAdmin()) {

            return response()->json([
                'message' => 'Action non autorisée.'
            ], 403);

        }



        $user->delete();



        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.'
        ], 200);
    }







    /**
     * Ajouter une compétence à un utilisateur.
     */
    public function addCompetence($idUser, $idCompetence)
    {

        $user = User::find($idUser);



        if (!$user) {

            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);

        }




        // Seul le propriétaire peut modifier ses compétences
        if ($user->id_user != auth()->id()) {


            return response()->json([
                'message' => 'Vous ne pouvez pas modifier ces compétences.'
            ], 403);

        }




        $user->competences()
            ->syncWithoutDetaching([$idCompetence]);



        return response()->json([
            'message' => 'Compétence ajoutée avec succès.'
        ], 200);

    }







    /**
     * Supprimer une compétence d'un utilisateur.
     */
    public function removeCompetence($idUser, $idCompetence)
    {

        $user = User::find($idUser);



        if (!$user) {

            return response()->json([
                'message' => 'Utilisateur introuvable.'
            ], 404);

        }




        if ($user->id_user != auth()->id()) {


            return response()->json([
                'message' => 'Vous ne pouvez pas modifier ces compétences.'
            ], 403);

        }




        $user->competences()
            ->detach($idCompetence);



        return response()->json([
            'message' => 'Compétence supprimée avec succès.'
        ], 200);

    }

}