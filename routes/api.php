<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/players', [PlayersController::class, 'index']);
Route::post('/players', [PlayersController::class, 'store']);
Route::get('/players/{id}', [PlayersController::class, 'show']);
Route::put('/players/{id}', [PlayersController::class, 'update']);
Route::delete('/players/{id}', [PlayersController::class, 'destroy']);


Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout', [AuthController::class, 'logout']);
});
