<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionUndertakenController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Character junk
 */
Route::prefix('character')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/list',  [CharacterController::class, 'list'])->name('character.list');
    Route::get('/{id}',  [CharacterController::class, 'get'])->name('character.get');
    
});

Route::prefix('item')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/search/{query}',  [ItemController::class, 'search'])->name('item.search');
    Route::get('/list',  [ItemController::class, 'list'])->name('item.list');
    Route::get('/{id}',  [ItemController::class, 'get'])->name('item.get');
});

Route::prefix('mission')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',  [MissionController::class, 'index'])->name('mission.index');
    Route::get('/category/{id}', [MissionController::class, 'category'])->name('mission.category');
    Route::get('/undertaken', [MissionUndertakenController::class, 'list'])->name('mission.undertaken');
    Route::get('/active', [MissionUndertakenController::class, 'active'])->name('mission.active');
});
Route::prefix('mission')->middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::get('/admin',  [MissionController::class, 'admin'])->name('mission.admin');
});

Route::prefix('shop')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',  [MissionController::class, 'index'])->name('shop.index');
});
Route::prefix('shop')->middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::get('/admin',  [MissionController::class, 'admin'])->name('shop.admin');
});


require __DIR__.'/auth.php';
