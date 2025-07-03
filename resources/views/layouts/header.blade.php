<header class="w-full bg-[#1B4D3F] text-white py-4 px-6 mb-6">
    <nav class="flex items-center justify-between gap-4 mb-2">
        <div class="flex gap-6">
            <a href="{{ route('home', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('/') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.home') }}</a>
            <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('gallery*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.gallery') }}</a>
            <a href="{{ route('info', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('info*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.info') }}</a>
            <a href="{{ route('philosophy', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('philosophy*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.philosophy') }}</a>
            <a href="{{ route('videos', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('videos*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.videos') }}</a>
            <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="font-semibold {{ request()->is('contact*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">{{ __('messages.contact-us') }}</a>
        </div>
        <div class="flex gap-2 items-center">
            @php $currentLocale = app()->getLocale(); @endphp
            @php
                $currentRoute = request()->route() ? request()->route()->getName() : '';
            @endphp
            <a href="{{ $currentRoute === 'home' ? '/en' : route($currentRoute, ['lang' => 'en']) }}" class="font-semibold {{ $currentLocale === 'en' ? 'text-yellow-300' : 'text-white/80 hover:text-white' }}">{{ __('messages.English') }}</a> |
            <a href="{{ $currentRoute === 'home' ? '/fi' : route($currentRoute, ['lang' => 'fi']) }}" class="font-semibold {{ $currentLocale === 'fi' ? 'text-yellow-300' : 'text-white/80 hover:text-white' }}">{{ __('messages.Finnish') }}</a> |
            <a href="{{ $currentRoute === 'home' ? '/np' : route($currentRoute, ['lang' => 'np']) }}" class="font-semibold {{ $currentLocale === 'np' ? 'text-yellow-300' : 'text-white/80 hover:text-white' }}">{{ __('messages.NP') }}</a>
        </div>
    </nav>
</header> 