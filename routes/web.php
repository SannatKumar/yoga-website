<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SthulaVyayamaController;
use App\Http\Controllers\SukhsmaVyayamaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TrackVisits;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\GuruStutiController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class, TrackVisits::class])->prefix('{lang}')->group(function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // })->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');    
    Route::get('/info', [TeacherController::class, 'index'])->name('info');
    Route::get('/teacher/{id}', [TeacherController::class,'getTeacher'])->name('teacher-profile');
    Route::view('/philosophy', 'philosophy')->name('philosophy');
    Route::view('/videos', 'videos')->name('videos');
    Route::view('/contact', 'contact')->name('contact');
    Route::view('/terms', 'terms')->name('terms');

    //Guide Controller
    Route::get('/guide', [GuideController::class, 'getGuide'])->name('guide');

        //Guru Stuti Controller
    Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti'])->name('guru-stuti');

    //Gallery Routes
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/showgallerycard/id', [GalleryController::class, 'show'])->name('showgallerycard');

    //Sthula Vyayama and Sukhsma Vyayama
    Route::get('/sthulavyayama', [SthulaVyayamaController::class, 'sthulaVyayama'])->name('sthulavyayama');
    Route::get('/sukhsmavyayama', [SukhsmaVyayamaController::class, 'sukhsmaVyayama'])->name('sukhsmavyayama');


    //Database Routes
    Route::get('/test-insert-user', [UserController::class, 'testInsertUser']);

    Route::get('/check-db', function () {
        return DB::connection()->getDatabaseName();
    });
});

// Optionally, redirect root to default language
Route::get('/', function () {
    return redirect('/en');
});
