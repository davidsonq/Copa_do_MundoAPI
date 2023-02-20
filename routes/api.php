<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teams',[TeamController::class, 'index'] );
Route::get('/teams/{id}',[TeamController::class, 'show'] );
Route::patch('/teams/{id}',[TeamController::class, 'update'] );
Route::delete('/teams/{id}',[TeamController::class, 'destroy'] );
Route::post('/teams',[TeamController::class, 'store'] );