<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\MainController;

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

// Front End
Route::get('/', function () {
    return view('home');
});
// Backend
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
// Debug
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
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

require __DIR__ . '/auth.php';
require __DIR__ . '/data/users.php';
require __DIR__ . '/data/activity.php';