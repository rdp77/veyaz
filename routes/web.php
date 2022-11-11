<?php

use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Routes
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->name('dashboard');
    Route::get('/doc', 'doc')
        ->name('documentation');
    Route::get('/settings', 'settings')
        ->name('settings');
});

// Server Monitor
Route::get('/server-monitor', [DashboardController::class, 'serverMonitor'])
    ->name('dashboard.server-monitor');
Route::prefix('server-monitor')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('refresh', 'serverMonitorRefresh')
            ->name('dashboard.server-monitor.refresh');
        Route::get('refresh-all', 'serverMonitorRefreshAll')
            ->name('dashboard.server-monitor.refreshAll');
    });
});

// Load another route file
require __DIR__.'/data/usersRoute.php';
require __DIR__.'/data/activityRoute.php';

// Master Data Route

