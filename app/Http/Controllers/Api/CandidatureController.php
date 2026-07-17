<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{

    /**
     * Liste des candidatures selon le rôle
     */
    public function index()
    {
        $user = auth()->user();


        // Admin voit toutes les candidatures
        if ($user->isAdmin()) {

            $candidatures = Candidature::with([
                'user',
                'offre.entreprise'
            ])->get();


        }
        // Entreprise voit les candidatures reçues sur ses offres
        elseif ($user->isEntreprise()) {


            $entreprise = $user->entreprise;


            if (!$entreprise) {

                return response()->json([
                    'message'=>'Entreprise introuvable.'
                ],404);

            }



            $candidatures = Candidature::with([
                'user',
                'offre'
            ])
            ->whereHas('offre', function($query) use($entreprise){

                $query->where(
                    'id_entreprise',
                    $entreprise->id_entreprise
                );

            })
            ->get();



        }
        // Candidat voit ses candidatures
        else {


            $candidatures = Candidature::with([
                'offre.entreprise'
            ])
            ->where(
                'id_user',
                $user->id_user
            )
            ->get();


        }



        return response()->json([
            'message'=>'Liste des candidatures.',
            'data'=>$candidatures
        ],200);

    }







    /**
     * Afficher une candidature
     */
    public function show($id)
    {

        $candidature = Candidature::with([
            'user',
            'offre.entreprise'
        ])
        ->find($id);



        if(!$candidature){

            return response()->json([
                'message'=>'Candidature introuvable.'
            ],404);

        }



        $user = auth()->user();



        if(
            !$user->isAdmin()
            &&
            $candidature->id_user != $user->id_user
            &&
            (
                !$user->entreprise
                ||
                $candidature->offre->id_entreprise 
                !=
                $user->entreprise->id_entreprise
            )
        ){

            return response()->json([
                'message'=>'Accès interdit.'
            ],403);

        }




        return response()->json([
            'message'=>'Candidature trouvée.',
            'data'=>$candidature
        ],200);

    }










    /**
     * Candidat postule à une offre
     */
    public function store(Request $request,$id)
    {

        $user = auth()->user();



        if(!$user->isCandidat()){

            return response()->json([
                'message'=>'Seuls les candidats peuvent postuler.'
            ],403);

        }




        // Vérifier existence offre
        $request->validate([

            'id_offre'=>'nullable|exists:offres,id_offre'

        ]);





        // Empêcher double candidature
        $existe = Candidature::where(
            'id_user',
            $user->id_user
        )
        ->where(
            'id_offre',
            $id
        )
        ->exists();




        if($existe){

            return response()->json([
                'message'=>'Vous avez déjà postulé à cette offre.'
            ],409);

        }





        $candidature = Candidature::create([

            'id_user'=>$user->id_user,

            'id_offre'=>$id,

            'statut'=>'en_attente',

            'date_candidature'=>now()

        ]);





        return response()->json([
            'message'=>'Candidature créée avec succès.',
            'data'=>$candidature
        ],201);

    }









    /**
     * Entreprise ou Admin change statut
     */
    public function changeStatut(Request $request,$id)
    {


        $request->validate([

            'statut'=>'required|in:en_attente,acceptee,refusee'

        ]);





        $candidature = Candidature::with('offre')
            ->find($id);





        if(!$candidature){

            return response()->json([
                'message'=>'Candidature introuvable.'
            ],404);

        }





        $user = auth()->user();





        // Vérification entreprise propriétaire ou admin
        if(
            !$user->isAdmin()
            &&
            (
                !$user->entreprise
                ||
                $user->entreprise->id_entreprise
                !=
                $candidature->offre->id_entreprise
            )
        ){

            return response()->json([
                'message'=>'Action non autorisée.'
            ],403);

        }






        $candidature->update([

            'statut'=>$request->statut

        ]);






        return response()->json([
            'message'=>'Statut modifié avec succès.',
            'data'=>$candidature
        ],200);

    }


}