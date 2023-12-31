<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DirectionController;
use App\Http\Controllers\Api\TypeController;
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
Route::apiResource('equipment-types', TypeController::class);
Route::apiResource('directions', DirectionController::class);
Route::apiResource('departments', DepartmentController::class);
