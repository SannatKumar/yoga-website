<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SthulaVyayamaController;
use App\Http\Controllers\SukhsmaVyayamaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TrackVisits;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuideController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class, TrackVisits::class])->prefix('{lang}')->group(function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // })->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Placeholder routes for other pages (to be implemented)
    Route::get('/info', function () {
        $teachers = [
            [
                'name' => 'Jasmine',
                'photo' => '/images/natural_scene/bee_and_flower.jpeg',
                'title' => 'IYA Certified Yoga Teacher',
                'bio' => 'Jasmine specializes in restorative and prenatal yoga. Her classes focus on mindfulness, breath, and gentle movement.',
                'social' => [
                    'instagram' => 'https://instagram.com/jasmine.yoga',
                ],
            ],
            [
                'name' => 'Mango',
                'photo' => '/images/natural_scene/northern_lights_first.jpeg',
                'title' => 'IYA Certified Yoga Teacher',
                'bio' => 'Mango brings a playful spirit to his Vinyasa and AcroYoga classes. He believes yoga is for everyone, regardless of age or ability.',
                'social' => [
                    'facebook' => 'https://facebook.com/mangoyoga',
                ],
            ],
            [
                'name' => 'Apple',
                'photo' => '/images/natural_scene/blue_sky_forest_and_lake.jpeg',
                'title' => 'IYA Certified Yoga Teacher',
                'bio' => 'Apple is passionate about yoga for mental health and teaches meditation and pranayama workshops.',
                'social' => [
                    'website' => 'https://appleyoga.com',
                ],
            ],
            [
                'name' => 'Coconut',
                'photo' => '/images/natural_scene//fire_and_lake.jpeg',
                'title' => 'IYA Certified Yoga Teacher',
                'bio' => 'Coconut is a yoga therapist and anatomy expert, helping students safely deepen their practice.',
                'social' => [
                    'instagram' => 'https://instagram.com/coconutyoga',
                    'facebook' => 'https://facebook.com/coconutyoga',
                ],
            ],
            [
                'name' => 'Raj Kumar',
                'photo' => '/images/natural_scene/grass_and_sun.jpeg',
                'title' => 'IYA Certified Yoga Teacher',
                'bio' => 'Raj is a certified yoga instructor with 1.5 years of experience in Hatha and Vinyasa yoga.',
                'social' => [
                    'instagram' => 'https://instagram.com/rajyoga',
                    'facebook' => 'https://facebook.com/rajyoga',
                    'website' => 'https://rajyoga.com',
                ],
            ],
        ];
        return view('info', compact('teachers'));
    })->name('info');
    // Route::view('/guide', 'guide')->name('guide');
    Route::view('/philosophy', 'philosophy')->name('philosophy');
    Route::view('/videos', 'videos')->name('videos');
    Route::view('/contact', 'contact')->name('contact');

    //Guide Controller
    Route::get('/guide', [GuideController::class, 'getGuide'])->name('guide');

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
