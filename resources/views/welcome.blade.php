@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2020&q=80" 
                 alt="Yoga meditation" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <div class="relative z-10 text-center text-white px-6 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Welcome to Your 
                <span class="text-green-300">Yoga Journey</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-2xl mx-auto">
                Discover the art of yoga through information, beautiful images, and inspiring videos. 
                Share your practice and connect with the yoga community.
            </p>
            <a href="/gallery" 
               class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Explore Yoga Gallery
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Why Yoga?</h2>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Yoga is more than just physical exercise. It's a journey of self-discovery, mindfulness, and inner peace. 
                Our platform helps you explore different yoga styles, learn proper techniques, and find inspiration 
                for your daily practice.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">Explore Our Content</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Gallery Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Yoga poses gallery" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Yoga Gallery</h3>
                        <p class="text-gray-600 mb-4">Browse through beautiful yoga poses, meditation scenes, and inspiring imagery from around the world.</p>
                        <a href="/gallery" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            View Gallery
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2020&q=80" 
                             alt="Yoga information" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Yoga Information</h3>
                        <p class="text-gray-600 mb-4">Learn about different yoga styles, techniques, benefits, and the philosophy behind this ancient practice.</p>
                        <a href="/info" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            Read More
                        </a>
                    </div>
                </div>

                <!-- Videos Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Yoga videos" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Yoga Videos</h3>
                        <p class="text-gray-600 mb-4">Watch guided yoga sessions, tutorials, and inspirational content to enhance your practice.</p>
                        <a href="/videos" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            Watch Videos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 px-6 bg-gradient-to-r from-green-500 to-blue-500">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Ready to Start Your Yoga Journey?</h2>
            <p class="text-xl mb-8 text-green-100">Join our community and discover the transformative power of yoga.</p>
            <a href="/contact" class="inline-block bg-white text-green-600 font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Get Started Today
            </a>
        </div>
    </section>
</div>
@endsection
