<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarColorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('cars', [CarController::class, 'index']);
Route::get('cars/{id}', [CarController::class, 'show']);
Route::post('cars', [CarController::class, 'store']);
Route::put('cars/{id}', [CarController::class, 'update']);
Route::delete('cars/{id}', [CarController::class, 'delete']);

Route::get('colors', [CarColorController::class, 'index']);
Route::get('colors/{id}', [CarColorController::class, 'show']);
Route::post('colors', [CarColorController::class, 'store']);
// Route::put('cars/{id}', [CarController::class, 'update']);
// Route::delete('cars/{id}', [CarController::class, 'delete']);