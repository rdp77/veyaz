<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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
Route::post('/change-name', [UsersController::class, 'changeName'])
    ->name('users.name');
