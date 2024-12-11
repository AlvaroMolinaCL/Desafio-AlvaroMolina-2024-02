<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PublicController;
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

// Rutas accesibles públicamente
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/search', [PublicController::class, 'search'])->name('search');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mantenedores
    Route::resource('genres', GenreController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('artists', ArtistController::class);
    Route::resource('playlists', PlaylistController::class);
});

// Rutas de autenticación
require __DIR__ . '/auth.php';
