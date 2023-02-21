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

Route::controller(UsersController::class)->group(function () {
    // Create, read, update, edit and delete Roles
    Route::group(['prefix' => 'data'], function () {
        Route::resource('roles', RoleController::class)
            ->except([
                'show',
            ]);
    });
});
