<header style="width:100%;background:#1B4D3F;color:#fff;padding:0.7rem 0;box-shadow:0 2px 8px rgba(0,0,0,0.04);z-index:10;position:relative;">
    <nav style="max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;padding:0 1rem;">
        <div style="font-weight:700;font-size:1.3rem;letter-spacing:1px;">Yoga Platform</div>
        <ul style="display:flex;gap:1.2rem;list-style:none;margin:0;padding:0;flex-wrap:wrap;">
            <li><a href="{{ route('home', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('/') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.home') }}</a></li>
            <li><a href="{{ route('philosophy', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('philosophy*') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.philosophy') }}</a></li>
            <li><a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('gallery*') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.gallery') }}</a></li>
            <li><a href="{{ route('videos', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('videos*') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.videos') }}</a></li>
            <li><a href="{{ route('info', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('info*') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.info') }}</a></li>
            <li><a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" style="color:#fff;text-decoration:none;font-weight:500;{{ request()->is('contact*') ? 'border-bottom:2px solid #fff;' : '' }}">{{ __('messages.contact-us') }}</a></li>
        </ul>
        <div style="display:flex;gap:0.5rem;align-items:center;margin-left:1rem;">
            @php $currentLocale = app()->getLocale(); @endphp
            @php $currentRoute = request()->route() ? request()->route()->getName() : ''; @endphp
            <a href="{{ $currentRoute === 'home' ? '/en' : route($currentRoute, ['lang' => 'en']) }}" style="color:{{ $currentLocale === 'en' ? '#FFD700' : '#fff' }};font-weight:600;">{{ __('messages.English') }}</a> |
            <a href="{{ $currentRoute === 'home' ? '/fi' : route($currentRoute, ['lang' => 'fi']) }}" style="color:{{ $currentLocale === 'fi' ? '#FFD700' : '#fff' }};font-weight:600;">{{ __('messages.Finnish') }}</a> |
            <a href="{{ $currentRoute === 'home' ? '/np' : route($currentRoute, ['lang' => 'np']) }}" style="color:{{ $currentLocale === 'np' ? '#FFD700' : '#fff' }};font-weight:600;">{{ __('messages.NP') }}</a>
        </div>
    </nav>
    <style>
        @media (max-width: 900px) {
            header nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            header ul {
                gap: 0.7rem;
                font-size: 1rem;
            }
            header div[style*='margin-left:1rem'] {
                margin-left: 0;
                margin-top: 0.5rem;
            }
        }
        @media (max-width: 500px) {
            header nav {
                padding: 0 0.2rem;
            }
            header ul {
                gap: 0.4rem;
                font-size: 0.98rem;
            }
        }
    </style>
</header>
<style>
    main {
        margin-top: 1.2rem;
    }
    @media (max-width: 700px) {
        main {
            margin-top: 0.7rem;
        }
    }
</style> 