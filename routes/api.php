<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('/teams',[TeamController::class, 'index'] );
Route::get('/teams/{id}',[TeamController::class, 'show'] );
Route::patch('/teams/{id}',[TeamController::class, 'update'] );
Route::delete('/teams/{id}',[TeamController::class, 'destroy'] );
Route::post('/teams',[TeamController::class, 'store'] );