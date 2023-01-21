<?php

use App\Http\Controllers\UsersController;
use App\Http\Middleware\SetUserToWebRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Hydrators\UserHydrator;
use LaravelCommon\App\Http\Middleware\EntityUnit;

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
    Route::middleware([SetUserToWebRequest::NAME])->group(function() {
        Route::group(['prefix' => 'data'], function () {
            // Route::resource('users', UsersController::class)
            //     ->names([
            //         'store', ['middleware' => UserHydrator::NAME]
            //     ])
            //     ->except([
            //         'show',
            //     ])->middleware([
            //         SetUserToWebRequest::NAME
                // ]);
            // Route::resource('users/create', UsersController::class)
            //     ->except([
            //         'show',
            //     ]);
            Route::get('users', [UsersController::class, 'index'])->name('users.index');
            Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
            Route::post('users/store', [UsersController::class, 'store'])
                ->name('users.store')
                ->middleware([
                    UserHydrator::NAME,
                    EntityUnit::NAME
                ]);
            Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
            Route::put('users/update/{user}', [UsersController::class, 'update'])
                ->name('users.update')
                ->middleware([
                    UserHydrator::NAME,
                    EntityUnit::NAME
                ]);

            Route::get('users/delete/{user}', [UsersController::class, 'delete'])
                ->name('users.delete')
                ->middleware([
                    UserHydrator::NAME
                ]);;
              
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
    
});
