<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\CompetenceController;
use App\Http\Controllers\Api\CandidatureController;
use App\Http\Controllers\Api\StatistiqueController;


// ================= AUTH =================

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);




// ================= AUTHENTICATED =================

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

});






// ================= ADMIN =================

Route::middleware(['auth:sanctum','role:admin'])->group(function () {


    // Users CRUD

    Route::get('/users', [UserController::class,'index']);

    Route::get('/users/{id}', [UserController::class,'show']);

    Route::put('/users/{id}', [UserController::class,'update']);

    Route::delete('/users/{id}', [UserController::class,'destroy']);



    // Competences CRUD

    Route::apiResource(
        'competences',
        CompetenceController::class
    );



    // Statistiques globales

    Route::get(
        '/admin/statistiques',
        [StatistiqueController::class,'index']
    );


});








// ================= ENTREPRISE =================

Route::middleware(['auth:sanctum','role:entreprise'])->group(function () {


    // Profil entreprise

    Route::post(
        '/entreprises',
        [EntrepriseController::class,'store']
    );


    Route::put(
        '/entreprises/{id}',
        [EntrepriseController::class,'update']
    );


    Route::delete(
        '/entreprises/{id}',
        [EntrepriseController::class,'destroy']
    );




    // Offres CRUD

    Route::post(
        '/offres',
        [OffreController::class,'store']
    );


    Route::put(
        '/offres/{id}',
        [OffreController::class,'update']
    );


    Route::delete(
        '/offres/{id}',
        [OffreController::class,'destroy']
    );





    // Offre - Competences

    Route::post(
        '/offres/{idOffre}/competences/{idCompetence}',
        [OffreController::class,'addCompetence']
    );


    Route::delete(
        '/offres/{idOffre}/competences/{idCompetence}',
        [OffreController::class,'removeCompetence']
    );





    // Candidatures reçues

    Route::get(
        '/entreprises/{id}/candidatures',
        [EntrepriseController::class,'candidatures']
    );




    // Accepter / refuser candidature

    Route::put(
        '/candidatures/{id}/statut',
        [CandidatureController::class,'changeStatut']
    );


});








// ================= CANDIDAT =================

Route::middleware(['auth:sanctum','role:candidat'])->group(function () {


    // Postuler à une offre (selon brief)

    Route::post(
        '/offres/{id}/candidatures',
        [CandidatureController::class,'store']
    );



    // Voir mes candidatures

    Route::get(
        '/candidatures',
        [CandidatureController::class,'index']
    );



    Route::get(
        '/candidatures/{id}',
        [CandidatureController::class,'show']
    );



    Route::put(
        '/candidatures/{id}',
        [CandidatureController::class,'update']
    );



    Route::delete(
        '/candidatures/{id}',
        [CandidatureController::class,'destroy']
    );





    // Ajouter / supprimer compétence

    Route::post(
        '/users/{idUser}/competences/{idCompetence}',
        [UserController::class,'addCompetence']
    );


    Route::delete(
        '/users/{idUser}/competences/{idCompetence}',
        [UserController::class,'removeCompetence']
    );


});








// ================= PUBLIC =================


// Consulter offres

Route::get(
    '/offres',
    [OffreController::class,'index']
);


Route::get(
    '/offres/{id}',
    [OffreController::class,'show']
);



// Recherche offres

Route::get(
    '/search/offres',
    [OffreController::class,'search']
);



// Consulter entreprises

Route::get(
    '/entreprises',
    [EntrepriseController::class,'index']
);


Route::get(
    '/entreprises/{id}',
    [EntrepriseController::class,'show']
);