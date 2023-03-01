<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Roles Routes
|--------------------------------------------------------------------------
|
| Here is where you can register roles routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "roles" middleware group. Now create something great!
|
*/

Route::controller(RoleController::class)->group(function () {
    // Create, read, update, edit and delete roles
    Route::group(['prefix' => 'data'], function () {
        Route::resource('roles', RoleController::class)
            ->except([
                'show',
            ]);
    });

    // Recycle Roles
    Route::group(['prefix' => 'temp'], function () {
        Route::get('/roles', 'recycle')
            ->name('roles.recycle');
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/restore/{id}', 'restore');
            Route::post('/restore-all', 'restoreAll');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });
});
