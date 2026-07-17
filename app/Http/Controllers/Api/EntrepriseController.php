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
        $entreprises = Entreprise::all();

        return response()->json([
            'message' => 'Liste des entreprises.',
            'data' => $entreprises
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

        $data = $request->validated();


        // L'entreprise appartient au user connecté
        $data['id_user'] = auth()->id();


        $entreprise = Entreprise::create($data);



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




        // Seul le propriétaire ou admin peut modifier
        if (
            $entreprise->id_user != auth()->id()
            && !auth()->user()->isAdmin()
        ) {


            return response()->json([
                'message' => 'Vous ne pouvez pas modifier cette entreprise.'
            ], 403);

        }




        $entreprise->update(
            $request->validated()
        );



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




        // Seul le propriétaire ou admin peut supprimer
        if (
            $entreprise->id_user != auth()->id()
            && !auth()->user()->isAdmin()
        ) {


            return response()->json([
                'message' => 'Vous ne pouvez pas supprimer cette entreprise.'
            ], 403);

        }





        $entreprise->delete();



        return response()->json([
            'message' => 'Entreprise supprimée avec succès.'
        ], 200);

    }









    /**
     * Afficher les candidatures reçues par l'entreprise.
     */
    public function candidatures($id)
    {

        $entreprise = Entreprise::with([
            'offres.candidatures.user'
        ])->find($id);



        if (!$entreprise) {

            return response()->json([
                'message' => 'Entreprise introuvable.'
            ], 404);

        }





        // Une entreprise voit seulement ses candidatures
        if (
            $entreprise->id_user != auth()->id()
            && !auth()->user()->isAdmin()
        ) {


            return response()->json([
                'message' => 'Vous ne pouvez pas voir ces candidatures.'
            ], 403);

        }




        return response()->json([
            'message' => 'Liste des candidatures reçues.',
            'data' => $entreprise->offres
        ], 200);

    }

}