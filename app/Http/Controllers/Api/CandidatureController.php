<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{


    /**
     * Liste des candidatures du candidat connecté.
     */
    public function index()
    {

        $candidatures = Candidature::with('offre')
            ->where('id_user', auth()->id())
            ->get();


        return response()->json([
            'message' => 'Liste des candidatures.',
            'data' => $candidatures
        ], 200);

    }






    /**
     * Afficher une candidature.
     */
    public function show($id)
    {

        $candidature = Candidature::with('offre')
            ->where('id_user', auth()->id())
            ->find($id);



        if (!$candidature) {

            return response()->json([
                'message' => 'Candidature introuvable.'
            ], 404);

        }



        return response()->json([
            'message' => 'Candidature trouvée.',
            'data' => $candidature
        ], 200);

    }








    /**
     * Ajouter une candidature.
     */
    public function store(StoreCandidatureRequest $request)
    {

        $data = $request->validated();


        // candidat connecté
        $data['id_user'] = auth()->id();


        // statut automatique
        $data['statut'] = 'en_attente';


        // date automatique
        $data['date_candidature'] = now();




        // éviter candidature double
        $exists = Candidature::where('id_user', auth()->id())
            ->where('id_offre', $data['id_offre'])
            ->exists();



        if ($exists) {

            return response()->json([
                'message' => 'Vous avez déjà postulé à cette offre.'
            ], 409);

        }





        $candidature = Candidature::create($data);



        return response()->json([
            'message' => 'Candidature créée avec succès.',
            'data' => $candidature
        ], 201);

    }









    /**
     * Modifier une candidature.
     */
    public function update(UpdateCandidatureRequest $request, $id)
    {

        $candidature = Candidature::where('id_user', auth()->id())
            ->find($id);



        if (!$candidature) {

            return response()->json([
                'message' => 'Candidature introuvable.'
            ], 404);

        }




        $candidature->update(
            $request->validated()
        );



        return response()->json([
            'message' => 'Candidature modifiée avec succès.',
            'data' => $candidature
        ], 200);

    }









    /**
     * Supprimer une candidature.
     */
    public function destroy($id)
    {

        $candidature = Candidature::where('id_user', auth()->id())
            ->find($id);



        if (!$candidature) {

            return response()->json([
                'message' => 'Candidature introuvable.'
            ], 404);

        }




        $candidature->delete();



        return response()->json([
            'message' => 'Candidature supprimée avec succès.'
        ], 200);

    }









    /**
     * Entreprise accepte ou refuse une candidature.
     */
    public function changeStatut(Request $request, $id)
    {


        $request->validate([
            'statut' => 'required|in:en_attente,acceptee,refusee'
        ]);



        $candidature = Candidature::with('offre.entreprise')
            ->find($id);




        if (!$candidature) {

            return response()->json([
                'message' => 'Candidature introuvable.'
            ], 404);

        }





        // vérifier que l'entreprise possède l'offre
        if (
            $candidature->offre->entreprise->id_user 
            != auth()->id()
        ) {


            return response()->json([
                'message' => 'Vous ne pouvez pas modifier cette candidature.'
            ], 403);

        }






        $candidature->update([
            'statut' => $request->statut
        ]);





        return response()->json([
            'message' => 'Statut modifié avec succès.',
            'data' => $candidature
        ], 200);

    }


}