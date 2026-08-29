<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\GuruStutiController;
use App\Http\Controllers\LotusPageController;
use App\Http\Controllers\ShowAsanaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\CVGeneratorController;
use App\Http\Controllers\NepaliCalendarController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\MantraShlokaBhajanController;
use App\Http\Controllers\SthulaVyayamaController;
use App\Http\Controllers\SukhsmaVyayamaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TrackVisits;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SetDefaultLocaleForUrls;
use Illuminate\Support\Facades\DB;

// Locale switcher route - works from any page
Route::get('/set-locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'fi', 'np'])) {
        abort(400, 'Invalid locale');
    }

    // Store locale in session
    Session::put('locale', $locale);
    
    // Set application locale
    App::setLocale($locale);

    // Redirect back to previous page or home
    return redirect()->back()->with('locale_changed', true);
})->name('set-locale');

//This route helps Postman to post data if some CSRF Issue has come.
Route::get('/get-asanas', [TestController::class, 'getAsanas'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/add-asanas', [TestController::class, 'addAsanas'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::put('/update-asanas', [TestController::class, 'updateAsanas'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::delete('/delete-asanas', [TestController::class, 'deleteAsanas'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

//This route helps Postman to post data for asana steps if some CSRF Issue has come.
Route::post('/add-asana-steps', [GalleryController::class, 'addAsanaSteps'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


// Apply middleware to all routes
Route::middleware([SetLocale::class, SetDefaultLocaleForUrls::class, TrackVisits::class])->group(function () {
    
    // Home Controller - First Page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Guide Controller
    Route::get('/guide', [GuideController::class, 'getGuide'])->name('guide');

    // Guru Stuti Controller
    Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti'])->name('guru-stuti');

    // Philosophy page
    Route::view('/philosophy', 'philosophy')->name('philosophy');

    // Gallery Routes
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/showgallerycard/{id}', [GalleryController::class, 'show'])->name('showgallerycard');

    // Videos Routes
    Route::view('/videos', 'videos')->name('videos');

    // About us and Teacher Controller
    Route::get('/info', [TeacherController::class, 'index'])->name('info');
    Route::get('/teacher/{id}', [TeacherController::class, 'getTeacher'])->name('teacher-profile');

    // Contact Form
    Route::view('/contact', 'contact')->name('contact');
    
    // Terms of Use
    Route::view('/terms', 'terms')->name('terms');

    // Show Asanas Controller
    Route::get('/show-asana', [ShowAsanaController::class, 'getAsana'])->name('show-asana');
    //Add Asanas
    // Route::post('/addAsanas', [GalleryController::class, 'addAsanas']);


    // Utility Section
    Route::get('/cover-letter', [CoverLetterController::class, 'getCoverLetter'])->name('cover-letter');
    Route::get('/cv-generator', [CVGeneratorController::class, 'getCVGenerator'])->name('cv-generator');
    Route::get('/currency-converter', [CurrencyConverterController::class, 'getCurrencyConverter'])->name('currency-converter');
    Route::get('/nepali-calendar', [NepaliCalendarController::class, 'getNepaliCalendar'])->name('nepali-calendar');

    // Mantras, Shlokas and Bhajans
    Route::get('/mantra', [MantraShlokaBhajanController::class, 'getMantraShlokaBhajan'])->name('mantra-shloka-bhajan');
    Route::get('/mantra/{id}', [MantraShlokaBhajanController::class, 'getMantraShlokaBhajanContent'])->name('mantra-shloka-bhajan-content');

    // Sthula Vyayama and Sukhsma Vyayama
    Route::get('/sthula-vyayama', [SthulaVyayamaController::class, 'sthulaVyayama'])->name('sthula-vyayama');
    Route::get('/sukhsma-vyayama', [SukhsmaVyayamaController::class, 'sukhsmaVyayama'])->name('sukhsma-vyayama');

    //Lotus Controller
    Route::get('/lotus-page', [LotusPageController::class, 'getlotus'])->name('lotus-page');

    // Database Routes (for testing)
    Route::get('/test-insert-user', [UserController::class, 'testInsertUser']);
    Route::get('/check-db', function () {
        return DB::connection()->getDatabaseName();
    });
});
