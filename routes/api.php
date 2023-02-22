<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
    Route::post("/softdelete", [App\Http\Controllers\Api\UserController::class, 'softDelete']);
    Route::post("/restore", [App\Http\Controllers\Api\UserController::class, 'restore']);
    // Route::post('/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);  
});


