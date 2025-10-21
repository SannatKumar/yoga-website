
# Laravel CSRF issues with postman

The route below ignores the csrf issues.
Route::post('/addAsanas', [GalleryController::class, 'addAsanas'])->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


