<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
| Here is where you can register users routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "users" middleware group. Now create something great!
|
*/

Route::resource('users', UsersController::class)
    ->except([
        'show',
    ]);

// Users Password
Route::post('/users/reset/{id}', [UsersController::class, 'reset'])
    ->name('users.reset');
Route::get('/change-password', [UsersController::class, 'changePassword'])
    ->name('users.password');
Route::post('/reset', [NewPasswordController::class, 'changePassword'])
    ->name('changePassword');

// Users Name
Route::get('/change-name', [UsersController::class, 'changeName']);