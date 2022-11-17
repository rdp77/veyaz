<?php

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

Route::controller(UsersController::class)->group(function () {
    // Create, read, update, edit and delete users
    Route::group(['prefix' => 'data'], function () {
        Route::resource('users', UsersController::class)
            ->except([
                'show',
            ]);
    });

    // Recycle Users
    Route::group(['prefix' => 'temp'], function () {
        Route::get('/users', 'recycle')
            ->name('users.recycle');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/restore/{id}', 'restore');
            Route::post('/restore-all', 'restoreAll');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });

    // Users Password
    Route::post('/users/reset/{id}', 'reset')
        ->name('users.reset');
    Route::get('/change-password', 'changePassword')
        ->name('users.password');

    // Users Name
    Route::get('/change-name', 'changeName');
});
