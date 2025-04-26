<?php

use App\Http\Controllers\App\AlbumController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Route::get('albums', function () {
    //     return Inertia::render('Album');
    // })->name('albums');
    Route::resource('albums', AlbumController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
