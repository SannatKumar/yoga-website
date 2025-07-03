<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class])->prefix('{lang}')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

    // Placeholder routes for other pages (to be implemented)
    Route::get('/info', function () {
        return view('info');
    })->name('info');

    Route::get('/videos', function () {
        return view('videos');
    })->name('videos');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
});

// Optionally, redirect root to default language
Route::get('/', function () {
    return redirect('/en');
});
