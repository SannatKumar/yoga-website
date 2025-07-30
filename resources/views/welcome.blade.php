@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/main_page_first_image_haukkaniemi.jpg" 
                 alt="Yoga meditation" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <div class="relative z-10 text-center text-white px-6 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                {{ __('messages.welcome-to-your-yoga-journey') }}
                <!--<span class="text-green-300">{{ __('messages.yoga-bliss') }}</span>-->
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-2xl mx-auto">
                {{ __('messages.find-your-inner-peace-and-balance') }}
            </p>
            <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" 
               class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('messages.gallery') }}
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">{{ __('messages.why-yoga') }}</h2>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                {{ __('messages.why-yoga-text') }}
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">{{ __('messages.explore-our-content') }}</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Gallery Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/images/Sarvangasana.jpeg" 
                             alt="Yoga poses gallery" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.gallery') }}</h3>
                        <p class="text-gray-600 mb-4">{{ __('messages.gallery-desc') ?? 'Browse through beautiful yoga poses, meditation scenes, and inspiring imagery from around the world.' }}</p>
                        <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            {{ __('messages.gallery') }}
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/images/Matsyasana.jpeg" 
                             alt="Yoga information" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.info') ?? 'Yoga Information' }}</h3>
                        <p class="text-gray-600 mb-4">{{ __('messages.info-desc') ?? 'Learn about different yoga styles, techniques, benefits, and the philosophy behind this ancient practice.' }}</p>
                        <a href="{{ route('info', ['lang' => app()->getLocale()]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            {{ __('messages.info') ?? 'Read More' }}
                        </a>
                    </div>
                </div>

                <!-- Videos Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/images/Vajroli.jpeg" 
                             alt="Yoga videos" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.videos') ?? 'Yoga Videos' }}</h3>
                        <p class="text-gray-600 mb-4">{{ __('messages.videos-desc') ?? 'Watch guided yoga sessions, tutorials, and inspirational content to enhance your practice.' }}</p>
                        <a href="{{ route('videos', ['lang' => app()->getLocale()]) }}" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            {{ __('messages.videos') ?? 'Watch Videos' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 px-6 bg-gradient-to-r from-green-500 to-blue-500">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-6">{{ __('messages.ready-to-start') ?? 'Ready to Start Your Yoga Journey?' }}</h2>
            <p class="text-xl mb-8 text-green-100">{{ __('messages.join-community') ?? 'Join our community and discover the transformative power of yoga.' }}</p>
            <a href="{{route('contact', ['lang' => app()->getLocale()])}}" class="inline-block bg-white text-green-600 font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('messages.get-started') ?? 'Get Started Today' }}
            </a>
        </div>
    </section>
    <p>Total Visits: {{ $totalVisits }}</p>
    <p>Unique Visitors: {{ $uniqueVisitors }}</p>
</div>
@endsection
