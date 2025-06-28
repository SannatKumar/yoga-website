<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
});

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
