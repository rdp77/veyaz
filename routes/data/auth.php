<?php

use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth']
],function () {

    // Permission read
    Route::get('/auth/permissions', [PermissionController::class, 'index'])->name('permissions.index');

    Route::controller(RoleController::class)->group(function () {
        
        // Create, read, update, edit and delete users
        Route::group(['prefix' => 'auth'], function () {
            Route::resource('roles', RoleController::class)->except(['show']);
        });

        // Recycle Roles
        Route::group(['prefix' => 'temp'], function () {
            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', 'recycle')->name('roles.recycle');
                Route::get('/restore/{id}', 'restore');
                Route::post('/restore-all', 'restoreAll');
                Route::delete('/delete/{id}', 'delete');
                Route::delete('/delete-all', 'deleteAll');
            });
        });
    });
});
