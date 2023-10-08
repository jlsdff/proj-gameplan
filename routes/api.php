<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/players', [PlayersController::class, 'index']);
Route::post('/players', [PlayersController::class, 'store']);
Route::get('/players/{id}', [PlayersController::class, 'show']);
Route::put('/players/{id}', [PlayersController::class, 'update']);
Route::delete('/players/{id}', [PlayersController::class, 'destroy']);


Route::get('/teams', [TeamController::class, 'index']);
Route::post('/teams', [TeamController::class, 'store']);
Route::get('/teams/{id}', [TeamController::class, 'show']);
Route::put('/teams/{id}', [TeamController::class, 'update']);
Route::delete('/teams/{id}', [TeamController::class, 'destroy']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout', [AuthController::class, 'logout']);
});
 