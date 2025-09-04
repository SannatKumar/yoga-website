@extends('layouts.app')

@section('content')
    <div class="main-div">

        <!--First Div starts -->
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/red_lotus.svg" :text="__('messages.about-us') ?? '🙏 About Us'" />
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-main-section">
                <h2 class="text-4xl font-bold text-gray-800 mb-12 text-center">
                    <span class="text-center text-lg text-gray-700">Meet our dedicated yoga teachers and contributors. Each
                        brings their unique experience and passion to help you on your yoga journey.</span>
                </h2>
            </div>
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">
            <div class="part-three-main-div">
                @foreach ($teachers as $teacher)
                    <div class="part-three-card-content">
                        <img src="{{ $teacher['photo'] }}" alt="{{ $teacher['name'] }}" style="width:100%"
                            class="fixed-size">
                        <h2 class="header-class"><a href="{{ url('teacher/' . $teacher['id']) }}">
                                {{ $teacher['name'] }}
                            </a>
                        </h2>

                        <p class="p-title">{{ $teacher['title'] }}</p>
                        <p>{{ $teacher['bio'] }}</p>
                        {{-- <p>{{ 'en/teacher/' . $teacher['id'] }}</p> --}}

                        <div class="card-footer">
                            <div class="social-links">
                                <a href="#" class="social-media-icon"><i class="fa fa-whatsapp"></i></a>
                                <a href="#" class="social-media-icon"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="social-media-icon"><i class="fa fa-linkedin"></i></a>
                                <a href="#" class="social-media-icon"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="social-media-icon"><i class="fa fa-instagram"></i></a>
                            </div>
                            <p class="contact-button"><button>Contact</button></p>
                        </div>


                    </div>
                @endforeach
            </div>

            {{-- <div class="card-container"> --}}
            {{-- @foreach ($teachers as $teacher)
                {{-- <div class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch"> --}}
            {{-- <div class="single-card">
                    <div class="single-card-div">
                        <img src="{{ $teacher['photo'] }}" alt="{{ $teacher['name'] }}" style="width:100%" class="fixed-size">
                                <h2>
                    <a href="{{ url('teacher/'.$teacher['id']) }}">
                        {{ $teacher['name'] }}
                    </a>
                    <p>{{ 'en/teacher/'.$teacher['id'] }}</p>
                </h2>
                        <p class="title">{{ $teacher['title'] }}</p>
                        <p>{{ $teacher['bio'] }}</p>
                        <div class="card-footer">
                             <div class="social-links" style="margin: 0; background-color: #fff; padding: 10px; border-radius: 5px;">
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-whatsapp"></i></a> 
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-twitter"></i></a>  
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-linkedin"></i></a>  
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-facebook"></i></a>
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-instagram"></i></a> 
                            </div> 
                            <p style="margin:0;"><button>Contact</button></p>
                        </div>
                    </div>
                </div>
            @endforeach --}}
            {{-- </div> --}}
        </div>
        <!--Third Div Ends-->

        <!--Fourth Div starts -->
        <div class="part-four-div">


        </div>
        <!--Fourth Div Ends-->

        <!--Fifth Div starts -->
        <div class="part-five-div">


        </div>
        <!--Fifth Div Ends-->

        <!--Sixth Div starts -->
        <div class="part-six-div">


        </div>
        <!--Six Div Ends-->

        <!--Seven Div starts -->
        <div class="part-seven-div">




        </div>
        <!--Seven Div Ends-->

        <!--Eight Div starts -->

        <div class="part-eight-div">

            <div class="part-eight-main-content">
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
        margin-bottom: 0px;
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
    .part-three-div{
        display: flex;
        justify-content: center;
    }

    .part-three-main-div {
        margin-left:10px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 5px;
    }

    .part-three-card-content {
        /* width & flex control */
        flex: 0 0 calc(33.333% - 15px); /* 3 per row */
        max-width: calc(33.333% - 15px);

        min-width: 280px;
        height: 450px;

        /* styling */
        border: 5px solid green;
        border-radius: 0.75rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .fixed-size {
        width: 120px;
        /* fixed width */
        height: 200px;
        /* fixed height */
        object-fit: cover;
        /* fill the box, crop overflow */
        border-radius: 0.25rem;
        /* optional rounded corners */
        display: block;
        /* remove inline spacing */
    }

    .header-class {
        font-size: 1.75rem;
        /* text-4xl → 36px (2.25rem) */
        font-weight: 500;
        /* font-bold */
        color: #1f2937;
        /* text-gray-800 */
        margin-bottom: 1rem;
        /* mb-12 → 48px (12 × 0.25rem) */
        text-align: center;
        /* text-center */

    }

    .social-links {
        margin: 2px 0px 0px 0px;
        background-color: #1B4D3F;
        padding: 10px;
        border-radius: 1px;
    }

    .social-media-icon{
        margin: 1px 16px; color:white;
    }

    .p-title {
        text-align: center;
        min-height: 10px;
        border: 2px solid black;
        /* light border */
        border-radius: 0.75rem;

    }

    .contact-button {
        text-align: center;
        min-height: 20px;
        width: 100%;
        background-color: black;
        background-color: white;
        background: black;
        color: white;
        border: 1px solid black;
        /* light border */
        border-radius: 0.10rem;

    }
    .contact-button button {
        padding: 5px;
    }

    .card-footer {
        margin-top: auto;
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
