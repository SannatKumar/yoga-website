<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\GuruStutiController;
use App\Http\Controllers\ShowAsanaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SthulaVyayamaController;
use App\Http\Controllers\SukhsmaVyayamaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TrackVisits;
use App\Http\Middleware\SetLocale;
//DB Things
use Illuminate\Support\Facades\DB;

Route::middleware([SetLocale::class, TrackVisits::class])->prefix('{lang}')->group(function () {


    /*
    // Description to Read
    // The language prefix  and Track Visits has been added to Middleware.
    // The language will be added globally.
    // While getting the parameters from request, First is lang and Second is your Paramater coming into the request.
    //  
    Example Routes:
        Using Views Only:
        Route::view('/philosophy', 'philosophy')->name('philosophy');
        Using Controllers And Views:
        Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti'])->name('guru-stuti');  
    */
    //Home Controller First Page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Guide Controller
    Route::get('/guide', [GuideController::class, 'getGuide'])->name('guide');

    //Guru Stuti Controller
    Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti'])->name('guru-stuti');

    Route::view('/philosophy', 'philosophy')->name('philosophy');

    //Gallery Routes
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/showgallerycard/id', [GalleryController::class, 'show'])->name('showgallerycard');


    //Videos Routes And Controller Class
    Route::view('/videos', 'videos')->name('videos');

    //About us And Controller Class
    Route::get('/info', [TeacherController::class, 'index'])->name('info');
    Route::get('/teacher/{id}', [TeacherController::class,'getTeacher'])->name('teacher-profile');



    //Contact Form. This might get deleted later
    Route::view('/contact', 'contact')->name('contact');
    
    //Terms of Use And Controller Class
    Route::view('/terms', 'terms')->name('terms');



    //Testing the new component
        //Show Asanas Controller
    Route::get('/show-asana', [ShowAsanaController::class, 'getAsana'])->name('show-asana');




    //Sthula Vyayama and Sukhsma Vyayama
    Route::get('/sthula-vyayama', [SthulaVyayamaController::class, 'sthulaVyayama'])->name('sthula-vyayama');
    Route::get('/sukhsma-vyayama', [SukhsmaVyayamaController::class, 'sukhsmaVyayama'])->name('sukhsma-vyayama');


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
