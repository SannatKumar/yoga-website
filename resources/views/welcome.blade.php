@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <!-- Hero Section -->

    <!-- <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/main_page_first_image_haukkaniemi.jpg" 
                 alt="Yoga meditation" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <div class="relative z-10 text-center text-white px-6 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                {{ __('messages.welcome-to-your-yoga-journey') }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-2xl mx-auto">
                {{ __('messages.find-your-inner-peace-and-balance') }}
            </p>
            <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" 
               class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('messages.gallery') }}
            </a>
        </div>
    </section> -->
    <!-- Welcome Banner -->
    <section class="bg-gradient-to-r from-green-500 to-blue-500 text-white text-center py-6 shadow-md">
        <h1 class="text-2xl md:text-3xl font-semibold">
            {{ __('messages.namaste-welcome') ?? '🙏 Namaste & Welcome to Your Yoga Journey' }}
        </h1>
    </section>
    <!-- WH Yoga Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-12">
                {{ __('messages.discover-yoga-through-questions') ?? 'Explore Yoga Through Curiosity' }}
            </h2>

                        <!-- Steps Section -->
            <div class="guide-text-block-div">
                @foreach ($yogaIntroCards as $card)
                <x-guide-block 
                    :title="$card['title']" 
                    :text="$card['text']"  />
                @endforeach
            </div>
<!-- 
            <div class="grid md:grid-cols-5 gap-6 text-left">
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-bold mb-2 text-green-600">What is Yoga?</h3>
                    <p class="text-gray-700">Yoga means union—of breath, body, and awareness. It’s a way of being, not just doing.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-bold mb-2 text-blue-600">Why Yoga?</h3>
                    <p class="text-gray-700">To connect, balance, heal and understand life deeply—on and off the mat.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-bold mb-2 text-purple-600">When Yoga?</h3>
                    <p class="text-gray-700">Any moment that invites awareness becomes your yoga. It’s timeless.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-bold mb-2 text-yellow-600">How Yoga?</h3>
                    <p class="text-gray-700">With the breath, through movement, in stillness—guided by presence.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-bold mb-2 text-red-600">Where Yoga?</h3>
                    <p class="text-gray-700">Here. Now. In your body, in your breath, wherever you are.</p>
                </div>
            </div> -->
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">{{ __('messages.begin-your-inquiry') ?? 'Begin with Why – The Purpose of Yoga' }}</h2>
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
                        <img src="/images/Sarvangasana.jpeg" alt="Yoga poses gallery" class="w-full h-full object-cover">
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
                        <img src="/images/Matsyasana.jpeg" alt="Yoga information" class="w-full h-full object-cover">
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
                        <img src="/images/Vajroli.jpeg" alt="Yoga videos" class="w-full h-full object-cover">
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
            <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="inline-block bg-white text-green-600 font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('messages.get-started') ?? 'Get Started Today' }}
            </a>
        </div>
    </section>

    <div class="h-8 bg-gradient-to-b from-blue-500 to-gray-100"></div>

    <!-- Site Stats Section -->
    <!-- Site Stats Section -->
<section class="mt-32 px-6 py-20 bg-gray-100 border-t-4 border-green-200">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ __('messages.site-stats') ?? '📊 Site Statistics' }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 justify-center">
            <!-- Total Visits Circle -->
            <div class="flex flex-col items-center bg-white shadow-md rounded-full w-48 h-48 mx-auto justify-center transition-transform transform hover:scale-105">
                <div class="text-4xl font-extrabold text-blue-600">{{ $totalVisits }}</div>
                <div class="text-gray-700 mt-2 text-lg font-medium">{{ __('messages.total-visits') ?? 'Total Visits' }}</div>
            </div>

            <!-- Unique Visitors Circle -->
            <div class="flex flex-col items-center bg-white shadow-md rounded-full w-48 h-48 mx-auto justify-center transition-transform transform hover:scale-105">
                <div class="text-4xl font-extrabold text-green-600">{{ $uniqueVisitors }}</div>
                <div class="text-gray-700 mt-2 text-lg font-medium">{{ __('messages.unique-visitors') ?? 'Unique Visitors' }}</div>
            </div>
        </div>

        <div class="mt-12 text-sm text-gray-500">
            {{ __('messages.thank-you-for-visiting') ?? 'Thank you for being a part of our community.' }}
        </div>
    </div>
</section>
</div>
@endsection
