<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\MainController;

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

// Backend
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::get('/log', [DashboardController::class, 'log'])
    ->name('dashboard.log');
// Debug
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
// Server Monitor
Route::get('/server-monitor', [DashboardController::class, 'serverMonitor'])
    ->name('dashboard.server-monitor');
Route::prefix('server-monitor')->group(function () {
    Route::get('refresh', [DashboardController::class, 'serverMonitorRefresh'])
        ->name('dashboard.server-monitor.refresh');
    Route::get('refresh-all', [DashboardController::class, 'serverMonitorRefreshAll'])
        ->name('dashboard.server-monitor.refreshAll');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
require __DIR__ . '/data/users.php';