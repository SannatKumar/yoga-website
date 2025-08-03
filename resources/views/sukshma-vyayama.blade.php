@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <!-- Header Section -->
    <section class="py-16 px-6 bg-gradient-to-r from-green-500 to-blue-500">
        <div class="max-w-6xl mx-auto text-center text-white">
            <h1 class="text-5xl font-bold mb-4">{{ __('messages.sukhsma-vyayama') }}</h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                {{ __('messages.sukhsma-vyayama-desc') }}
            </p>
        </div>
    </section>

    <!-- Search and Filters Section -->
    <section class="py-8 px-6 bg-white shadow-sm">
        <div class="max-w-6xl mx-auto">
            <form method="GET" action="{{ route('sukhsma-vyayama', ['lang' => app()->getLocale()]) }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               value="{{ $search ?? '' }}"
                               placeholder="{{ __('messages.search-placeholder') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                        {{ __('messages.search') }}
                    </button>
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap gap-4">
                    <!-- Category Filter -->
                    <div class="flex-1 min-w-48">
                        <select name="category" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">{{ __('messages.all-categories') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ ($category ?? '') === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Difficulty Filter -->
                    <div class="flex-1 min-w-48">
                        <select name="difficulty" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">{{ __('messages.all-difficulties') }}</option>
                            @foreach($difficulties as $diff)
                                <option value="{{ $diff }}" {{ ($difficulty ?? '') === $diff ? 'selected' : '' }}>
                                    {{ $diff }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Clear Filters -->
                    <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                        {{ __('messages.clear-filters') }}
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-12 px-6">
        <div class="max-w-6xl mx-auto">
            @if(count($images) > 0)
                <!-- Results Count -->
                <div class="mb-8 text-center">
                    <p class="text-gray-600 text-lg">
                        {{ __('messages.showing') }} {{ count($images) }} {{ __('messages.yoga-pose') }}{{ count($images) !== 1 ? __('messages.s') : '' }}
                        @if($search || $category || $difficulty)
                            {{ __('messages.matching-your-filters') }}
                        @endif
                    </p>
                </div>

                <!-- Image Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($images as $image)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 group">
                            <!-- Image -->
                            <div class="relative h-64 overflow-hidden">
                               <a href="{{ route('showgallerycard',['lang' => app()->getLocale(), 'id'=>1])}}">
                                    <img src="{{ $image['image_url'] }}" 
                                         alt="{{ $image['title'] }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </a>
                                
                                <!-- Overlay with info -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                    <div class="text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('showgallerycard',['lang' => app()->getLocale(), 'id' => 1])}}" class="text-xl font-bold mb-2 block hover:underline">{{ $image['title'] }}</a>
                                        <p class="text-sm">{{ $image['description'] }}</p>
                                    </div>
                                </div>

                                <!-- Difficulty Badge -->
                                <div class="absolute top-4 right-4">
                                    @php
                                        $difficultyColors = [
                                            'Beginner' => 'bg-green-500',
                                            'Intermediate' => 'bg-yellow-500',
                                            'Advanced' => 'bg-red-500',
                                            'All Levels' => 'bg-blue-500'
                                        ];
                                        $color = $difficultyColors[$image['difficulty']] ?? 'bg-gray-500';
                                    @endphp
                                    <span class="{{ $color }} text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ __('messages.' . strtolower(str_replace(' ', '-', $image['difficulty']))) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $image['title'] }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $image['description'] }}</p>
                                
                                <!-- Category -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-green-600 font-semibold">{{ $image['category'] }}</span>
                                    
                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($image['tags'], 0, 2) as $tag)
                                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-24 h-24 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('messages.no-images-found') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('messages.try-adjusting-search') }}</p>
                    <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" 
                       class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                        {{ __('messages.view-all-images') }}
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 px-6 bg-gradient-to-r from-green-500 to-blue-500">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl font-bold mb-4">{{ __('messages.share-your-yoga-journey') }}</h2>
            <p class="text-xl mb-8 text-green-100">{{ __('messages.have-beautiful-photos') }}</p>
            <a href="/contact" class="inline-block bg-white text-green-600 font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('messages.share-your-photos') }}
            </a>
        </div>
    </section>
</div>
@endsection 