<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Articles Routes
|--------------------------------------------------------------------------
|
| Here is where you can register articles routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "articles" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'data'], function () {
    Route::resources([
        'articles' => ArticlesController::class,
        'category' => CategoryController::class,
        'tags' => TagsController::class,
    ]);
});

Route::group(['prefix' => 'temp'], function () {
    Route::get('/users', [UsersController::class, 'recycle'])
        ->name('users.recycle');
    Route::group(['prefix' => 'users'], function () {
        Route::get('/restore/{id}', [UsersController::class, 'restore'])
            ->name('users.restore');
        Route::delete('/delete/{id}', [UsersController::class, 'delete']);
        Route::delete('/delete-all', [UsersController::class, 'deleteAll']);
    });
});

// Users Password
Route::post('/users/reset/{id}', [UsersController::class, 'reset'])
    ->name('users.reset');
Route::get('/change-password', [UsersController::class, 'changePassword'])
    ->name('users.password');
Route::post('/reset', [NewPasswordController::class, 'changePassword'])
    ->name('changePassword');

// Users Name
Route::get('/change-name', [UsersController::class, 'changeName']);
