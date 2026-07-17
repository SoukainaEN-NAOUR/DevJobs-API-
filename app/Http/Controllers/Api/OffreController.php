<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOffreRequest;
use App\Http\Requests\UpdateOffreRequest;
use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{


    public function index()
    {
        return response()->json([
            'message' => 'Liste des offres.',
            'data' => Offre::with([
                'entreprise',
                'competences'
            ])->get()
        ],200);
    }





    public function show($id)
    {

        $offre = Offre::with([
            'entreprise',
            'competences'
        ])->find($id);



        if(!$offre){

            return response()->json([
                'message'=>'Offre introuvable.'
            ],404);

        }



        return response()->json([
            'message'=>'Offre trouvée.',
            'data'=>$offre
        ],200);

    }






    public function store(StoreOffreRequest $request)
    {

        $entreprise = auth()->user()->entreprise;


        if(!$entreprise){

            return response()->json([
                'message'=>'Aucune entreprise associée à ce compte.'
            ],403);

        }



        $data = $request->validated();


        $data['id_entreprise'] = $entreprise->id_entreprise;



        $offre = Offre::create($data);



        return response()->json([
            'message'=>'Offre créée avec succès.',
            'data'=>$offre
        ],201);

    }








    public function update(UpdateOffreRequest $request,$id)
    {

        $offre = Offre::find($id);



        if(!$offre){

            return response()->json([
                'message'=>'Offre introuvable.'
            ],404);

        }




        $entreprise = auth()->user()->entreprise;



        if(!$entreprise || 
           $offre->id_entreprise != $entreprise->id_entreprise){


            return response()->json([
                'message'=>'Vous ne pouvez pas modifier cette offre.'
            ],403);

        }




        $offre->update(
            $request->validated()
        );



        return response()->json([
            'message'=>'Offre modifiée avec succès.',
            'data'=>$offre
        ],200);

    }









    public function destroy($id)
    {

        $offre = Offre::find($id);



        if(!$offre){

            return response()->json([
                'message'=>'Offre introuvable.'
            ],404);

        }




        $entreprise = auth()->user()->entreprise;



        if(!$entreprise ||
           $offre->id_entreprise != $entreprise->id_entreprise){


            return response()->json([
                'message'=>'Vous ne pouvez pas supprimer cette offre.'
            ],403);

        }





        $offre->delete();



        return response()->json([
            'message'=>'Offre supprimée avec succès.'
        ],200);

    }









    public function addCompetence($idOffre,$idCompetence)
    {

        $offre = Offre::find($idOffre);



        if(!$offre){

            return response()->json([
                'message'=>'Offre introuvable.'
            ],404);

        }




        $entreprise = auth()->user()->entreprise;



        if(!$entreprise ||
           $offre->id_entreprise != $entreprise->id_entreprise){


            return response()->json([
                'message'=>'Action non autorisée.'
            ],403);

        }




        $offre->competences()
            ->syncWithoutDetaching([$idCompetence]);



        return response()->json([
            'message'=>'Compétence ajoutée avec succès.'
        ],200);

    }








    public function removeCompetence($idOffre,$idCompetence)
    {

        $offre = Offre::find($idOffre);



        if(!$offre){

            return response()->json([
                'message'=>'Offre introuvable.'
            ],404);

        }




        $entreprise = auth()->user()->entreprise;



        if(!$entreprise ||
           $offre->id_entreprise != $entreprise->id_entreprise){


            return response()->json([
                'message'=>'Action non autorisée.'
            ],403);

        }




        $offre->competences()
            ->detach($idCompetence);



        return response()->json([
            'message'=>'Compétence supprimée avec succès.'
        ],200);

    }









    public function search(Request $request)
    {

        $query = Offre::with([
            'entreprise',
            'competences'
        ]);



        if($request->filled('titre')){

            $query->where(
                'titre',
                'like',
                '%'.$request->titre.'%'
            );

        }



        if($request->filled('entreprise')){

            $query->whereHas('entreprise',function($q) use($request){

                $q->where(
                    'nom_entreprise',
                    'like',
                    '%'.$request->entreprise.'%'
                );

            });

        }



        if($request->filled('competence')){

            $query->whereHas('competences',function($q) use($request){

                $q->where(
                    'nom',
                    'like',
                    '%'.$request->competence.'%'
                );

            });

        }




        return response()->json([
            'message'=>'Résultat de recherche.',
            'data'=>$query->get()
        ],200);

    }

}