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
    Route::view('/info', 'info')->name('info');
    Route::view('/philosophy', 'philosophy')->name('philosophy');
    Route::view('/videos', 'videos')->name('videos');
    Route::view('/contact', 'contact')->name('contact');
});

// Optionally, redirect root to default language
Route::get('/', function () {
    return redirect('/en');
});
