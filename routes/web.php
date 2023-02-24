<?php

use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\MainController;
use App\Http\Controllers\RolesController;
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
Route::group(['middleware' => 'auth'], function () {
// Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')
            ->name('dashboard');
        Route::get('/doc', 'doc')
            ->name('documentation');
        Route::get('/settings', 'settings')
            ->name('settings');
    });
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/',[RolesController::class,'index'])->name('roles.index');
        Route::get('/list',[RolesController::class,'list'])->name('roles.list');
        Route::get('/show',[RolesController::class,'show'])->name('roles.show');
        Route::post('/store',[RolesController::class,'store'])->name('roles.store');
        Route::post('/destroy',[RolesController::class,'destroy'])->name('roles.destroy');
        // Route::resource('roles', 'RolesController');
    });
});
// Load another route file
require __DIR__.'/data/users.php';
require __DIR__.'/data/activity.php';
