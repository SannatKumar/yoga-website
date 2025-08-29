@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/yellow_lotus.svg" :text="__('messages.namaste-welcome') ??'🙏 Namaste & Welcome to Your Yoga Journey'" />

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-main-section">
            <h2 class="text-4xl font-bold text-gray-800 mb-12 text-center">
                {{ __('messages.discover-yoga-through-questions') ?? 'Explore Yoga Through Curiosity' }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($yogaIntroCards as $card)
                       @if (in_array($card['title'], ['Why Yoga?', 'When Yoga?', 'How Yoga?', 'Where Yoga?', 'What is Yoga?', 'For Whom Yoga?']))
                            <x-guide-block :title="$card['title']" :text="$card['text']" />
                        @endif
                    @endforeach
                </div>
                
            </div>
        
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">

            <section class="py-12 px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Yoga Philosophy Highlights</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($philosophyHighlights as $item)
                        <x-philosophy-card :title="$item['title']" :excerpt="$item['excerpt']" :href="$item['href']" :image="$item['image']" />
                    @endforeach
                </div>
            </div>
            </section>

        </div>
        <!--Third Div Ends-->

        <!--Fourth Div starts -->
        <div class="part-four-div">
            
            <div class="part-four-main-section">
                <section class="py-20 px-6 from-green-50 to-blue-50">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-4xl font-bold text-gray-800 mb-6">
                            {{ __('messages.begin-your-inquiry') ?? 'Begin with Why – The Purpose of Yoga' }}</h2>
                        <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                            {{ __('messages.why-yoga-text') }}
                        </p>
                    </div>
                </section>
            </div>

        </div>
        <!--Fourth Div Ends-->

        <!--Fifth Div starts -->
        <div class="part-five-div">

            <div class="part-five-main-section">
            
                <section class="py-20 px-6 bg-gray-50">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">{{ __('messages.explore-our-content') }}</h2>

                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Gallery Card -->
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <div class="h-64 overflow-hidden">
                                <img src="/images/Sarvangasana.jpeg" alt="Yoga poses gallery"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.gallery') }}</h3>
                                <p class="text-gray-600 mb-4">
                                    {{ __('messages.gallery-desc') ?? 'Browse through beautiful yoga poses, meditation scenes, and inspiring imagery from around the world.' }}
                                </p>
                                <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                    {{ __('messages.gallery') }}
                                </a>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <div class="h-64 overflow-hidden">
                                <img src="/images/Matsyasana.jpeg" alt="Yoga information" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                    {{ __('messages.info') ?? 'Yoga Information' }}</h3>
                                <p class="text-gray-600 mb-4">
                                    {{ __('messages.info-desc') ?? 'Learn about different yoga styles, techniques, benefits, and the philosophy behind this ancient practice.' }}
                                </p>
                                <a href="{{ route('info', ['lang' => app()->getLocale()]) }}"
                                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                    {{ __('messages.info') ?? 'Read More' }}
                                </a>
                            </div>
                        </div>

                        <!-- Videos Card -->
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <div class="h-64 overflow-hidden">
                                <img src="/images/Vajroli.jpeg" alt="Yoga videos" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.videos') ?? 'Yoga Videos' }}
                                </h3>
                                <p class="text-gray-600 mb-4">
                                    {{ __('messages.videos-desc') ?? 'Watch guided yoga sessions, tutorials, and inspirational content to enhance your practice.' }}
                                </p>
                                <a href="{{ route('videos', ['lang' => app()->getLocale()]) }}"
                                    class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                    {{ __('messages.videos') ?? 'Watch Videos' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </section>

            </div>

        </div>
        <!--Fifth Div Ends-->

        <!--Sixth Div starts -->
        <div class="part-six-div">

            <div class="part-six-main-section">
                <section class="py-20 px-6 bg-gradient-to-r from-green-500 to-blue-500">
                    <div class="max-w-4xl mx-auto text-center text-white">
                        <h2 class="text-4xl font-bold mb-6">
                            {{ __('messages.ready-to-start') ?? 'Ready to Start Your Yoga Journey?' }}</h2>
                        <p class="text-xl mb-8 text-green-100">
                            {{ __('messages.join-community') ?? 'Join our community and discover the transformative power of yoga.' }}
                        </p>
                        <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}"
                            class="inline-block bg-white text-green-600 font-semibold px-8 py-4 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            {{ __('messages.get-started') ?? 'Get Started Today' }}
                        </a>
                    </div>
                </section>
            </div>

        </div>
        <!--Six Div Ends-->

        <!--Seven Div starts -->
        <div class="part-seven-div">
            
            <h2 class="part-seven-title">{{ __('messages.site-stats') ?? 'Site Statistics' }}</h2>
            
            <div class="part-seven-main-content">
                
                <div class="stat-one">
                    <p class="stat-one-p">{{ number_format($totalVisits) }}</p>
                    <h2 class="stat-one-h2">{{ __('messages.total-visits') ?? 'Total Visits' }}</h2>
                </div>

                <div class="stat-two">
                    <p class="stat-two-p">{{ number_format($uniqueVisitors) }}</p>
                    <h2 class="stat-two-h2">{{ __('messages.unique-visitors') ?? 'Unique Visitors' }}</h2>
                </div>

            </div>

        </div>
        <!--Seven Div Ends-->

        <!--Eight Div starts -->

        <div class="part-eight-div">
            
            <div class="part-eight-main-content">
                <div class="eight-main-content-div">
                    <p class="">{{ __('messages.thank-you-for-visiting') ?? 'Thank you for visiting the platform.' }}</p>
                    <p class="">{{ __('messages.grateful-note') ?? 'We’re grateful you’re here. Stay curious, stay kind, keep practicing.' }}</p>
                </div>
            </div>
        </div>
        <!-- Eight Div Ends-->

        <!--Ninth Div starts -->
        <div class="part-nine-div">
        </div> 
        <!--Ninth Div Ends -->
    </div>
@endsection

<style>
    /* Normal Screen CSS */
    .main-div {
        background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
        width: 60%;
        display: flex;
        flex-direction: column;
    }

    .part-one-div {
        margin-bottom: 40px;
    }

    .part-one-div p {
        font-size: 12px;
        align-self: center;

    }
    .part-two-div {
        /*margin-top: 10px;*/

    }

    .part-two-div p {
        font-size: 12px;
        align-self: center;

    }
    .part-seven-div{
        text-align: center;
    }

    .part-seven-title{
        margin: 15px 0px;
        font-family: 'Great Vibes', cursive;
        font-size: 2.75rem;
        font-weight: 600;
    }

    .part-seven-main-content{
        display:flex;
        flex-direction: row;
        justify-content:center;
        gap: 80px;
    }

    .stat-one, .stat-two{

        width: 300px;
        height: 200px;
        background: radial-gradient(ellipse at center, #a7f3d0 0%, #34d399 100%);
        border-radius: 100% 50% 50% 50% / 100% 70% 30% 30%; /* teardrop-like */
        transform: rotate(0deg);
        padding: 4rem;
        text-align: center;
        font-family: 'Great Vibes', cursive;
        font-weight: 1000;
        font-size: 20px;
        /*color: #ffffff;           white numbers on green bg */
        text-shadow: 0 1px 2px rgba(0,0,0,0.3); /* slight glow for contrast */  
    }

    .part-eight-div{
        margin-top: 40px;
        text-align: center;
        padding: 10px;
        font-size: 1.75rem;
        font-weight: 600;
        color: #000;
        font-family: 'Great Vibes', cursive;
        display: flex;
        justify-content: center; /* horizontal centering */
        align-items: center;     /* vertical centering */
    }

    .part-eight-main-content{
        width: 1200px;
        height: 200px;
        background: radial-gradient(ellipse at center, #a7f3d0 0%, #34d399 100%);
        border-radius: 70% 50% 50% 50% / 70% 70% 30% 30%; /* teardrop-like */
        transform: rotate(0deg);
        padding: 5rem;

    }


    /* Small Screen Sizes CSS */
    /* Extra small devices (phones, < 576px) */
    @media (max-width: 575.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 100%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Small devices (phones, ≥ 576px and < 768px) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 100%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Medium devices (tablets, ≥ 768px and < 992px) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Large devices (laptops/desktops, ≥ 992px and < 1200px) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Extra large devices (large desktops, ≥ 1200px) */
    @media (min-width: 1200px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }
</style>
