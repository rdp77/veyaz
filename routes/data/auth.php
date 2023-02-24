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
                Route::get('/', 'index')->name('roles.recycle');
                Route::post('/{id}/restore', 'restore')->name('roles.restore');
                Route::post('/restore-all', 'restoreAll')->name('roles.restoreAll');
                Route::delete('/{id}/delete-permanent', 'delete')->name('roles.delete');
                Route::delete('/delete-all-permanent', 'deleteAll')->name('roles.deleteAll');
            });
        });
    });
});
