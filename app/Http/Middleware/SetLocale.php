<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session first, then browser preference, then fallback to default
        $locale = Session::get('locale');

        if (! $locale) {
            // Check browser language preference
            $browserLocale = $request->getPreferredLanguage(['en', 'fi', 'np']);
            $locale = $browserLocale ?: config('app.locale');
        }

        // Validate locale
        if (! in_array($locale, ['en', 'fi', 'np'])) {
            $locale = config('app.locale');
        }

        // Set the application locale
        App::setLocale($locale);

        // Store in session for future requests
        Session::put('locale', $locale);

        return $next($request);
    }
}
