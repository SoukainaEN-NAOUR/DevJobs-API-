<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EntrepriseController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
   Route::get('/users', [UserController::class, 'index']);
   Route::get('/users/{id}', [UserController::class, 'show']);
   Route::put('/users/{id}', [UserController::class, 'update']);
   Route::delete('/users/{id}', [UserController::class, 'destroy']);
   // Entreprises
Route::get('/entreprises', [EntrepriseController::class, 'index']);
Route::get('/entreprises/{id}', [EntrepriseController::class, 'show']);
Route::post('/entreprises', [EntrepriseController::class, 'store']);
Route::put('/entreprises/{id}', [EntrepriseController::class, 'update']);
Route::delete('/entreprises/{id}', [EntrepriseController::class, 'destroy']);
});