<?php

use App\Http\Controllers\App\AlbumController;
use App\Http\Controllers\App\CategoryController;
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

    Route::resource('albums', AlbumController::class);
    Route::resource('categories', CategoryController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
