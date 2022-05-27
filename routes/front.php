<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register front routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "front" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])
    ->name('frontend.home');