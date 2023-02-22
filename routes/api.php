<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:api')->group(function () {
    Route::get('/login', function () {
        if (Auth::user()->role === 'admin') {
            return response()->json(['password' => Auth::user()->password]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    });
})->middleware(['role:admin']);
// Route::post('api/login', [LoginController::class, 'login']);
