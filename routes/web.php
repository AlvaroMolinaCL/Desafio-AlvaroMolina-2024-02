<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('genres', GenreController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('artists', ArtistController::class);
    Route::resource('playlists', PlaylistController::class);
});

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/search', [PublicController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
