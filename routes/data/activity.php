<?php

use App\Http\Controllers\Core\ActivityController;
use App\Http\Controllers\Core\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Log Routes
|--------------------------------------------------------------------------
|
| Here is where you can register log routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "log" middleware group. Now create something great!
|
*/

// Logs Users
Route::get('/log', [DashboardController::class, 'log'])
    ->name('dashboard.log');
Route::controller(ActivityController::class)->group(function () {
    // Logs All Users
    Route::get('/activity', 'activity')
        ->name('activity');
    Route::prefix('activity')->group(function () {
        Route::name('activity.')->group(function () {
            // Activity logs all users
            Route::get('list', 'list')
                ->name('list.index');
            // Create a new activity logs
            Route::post('list', 'listStore')
                ->name('list.store');
            // Activity type all users
            Route::get('type', 'type')
                ->name('type.index');
            // Create a new activity type logs
            Route::post('type', 'typeStore')
                ->name('type.store');
        });
    });
});
