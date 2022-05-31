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

Route::get('/log', [DashboardController::class, 'log'])
    ->name('dashboard.log');
Route::get('/activity', [ActivityController::class, 'activity'])
    ->name('activity');
Route::prefix('activity')->group(function () {
    Route::name('activity.')->group(function () {
        Route::get('list', [ActivityController::class, 'list'])
            ->name('list.index');
        Route::post('list', [ActivityController::class, 'listStore'])
            ->name('list.store');
        Route::get('type', [ActivityController::class, 'type'])
            ->name('type.index');
        Route::post('type', [ActivityController::class, 'typeStore'])
            ->name('type.store');
    });
});