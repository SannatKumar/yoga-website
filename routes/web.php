<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class])->prefix('{lang}')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Placeholder routes for other pages (to be implemented)
    Route::get('/info', function () {
        $teachers = [
            [
                'name' => 'Raj Sharma',
                'photo' => '/images/raj_profile_photo.jpg',
                'bio' => 'Raj is a certified yoga instructor with 10 years of experience in Hatha and Vinyasa yoga. He loves sharing the philosophy and practice of yoga with all ages.',
                'social' => [
                    'instagram' => 'https://instagram.com/rajyoga',
                    'facebook' => 'https://facebook.com/rajyoga',
                    'website' => 'https://rajyoga.com',
                ],
            ],
            [
                'name' => 'PA',
                'photo' => '/images/duipadahastasana.jpeg',
                'bio' => 'PA specializes in restorative and prenatal yoga. Her classes focus on mindfulness, breath, and gentle movement.',
                'social' => [
                    'instagram' => 'https://instagram.com/anita.yoga',
                ],
            ],
            [
                'name' => 'GS',
                'photo' => '/images/main_page_first_image_haukkaniemi.jpg',
                'bio' => 'GS brings a playful spirit to his Vinyasa and AcroYoga classes. He believes yoga is for everyone, regardless of age or ability.',
                'social' => [
                    'facebook' => 'https://facebook.com/mikkoyoga',
                ],
            ],
            [
                'name' => 'KOKC',
                'photo' => '/images/Vipareetakarani.jpeg',
                'bio' => 'KOKC is passionate about yoga for mental health and teaches meditation and pranayama workshops.',
                'social' => [
                    'website' => 'https://sitayoga.com',
                ],
            ],
            [
                'name' => 'SV',
                'photo' => '/images/yogamudra.png',
                'bio' => 'SV is a yoga therapist and anatomy expert, helping students safely deepen their practice.',
                'social' => [
                    'instagram' => 'https://instagram.com/johnleeyoga',
                    'facebook' => 'https://facebook.com/johnleeyoga',
                ],
            ],
        ];
        return view('info', compact('teachers'));
    })->name('info');
    Route::view('/philosophy', 'philosophy')->name('philosophy');
    Route::view('/videos', 'videos')->name('videos');
    Route::view('/contact', 'contact')->name('contact');

    //Gallery Routes
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/showgallerycard/id', [GalleryController::class, 'show'])->name('showgallerycard');
});

// Optionally, redirect root to default language
Route::get('/', function () {
    return redirect('/en');
});
