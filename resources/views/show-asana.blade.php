@extends('layouts.app')

@section('content')
    <div class="main-div">
        <div class="welcome-message-div">
            <div class="welcome-block">
                <img src="/lotus-images/yellow_lotus.svg" alt="Welcome Icon" class="mx-auto mb-0 w-48 h-20">
                <h1 class="text-2xl md:text-3xl font-semibold">
                    {{ __('messages.namaste-welcome') ?? '🙏 Namaste & Welcome to Your Yoga Journey' }}
                </h1>
            </div>

        </div>
        <div class="question-answer-div">
            <p> Second Divison</p>
            <div class="guide-text-block-div">
                @foreach ($asana as $singleAsana)
                    <x-guide-block :title="$singleAsana['title']" :text="$singleAsana['text']" />
                @endforeach
            </div>
        </div>
        {{-- <div class="begin-inquiry-div">
            <p> First Divison</p>
        </div>
        <div class="explore-content-div">
            <p> First Divison</p>
        </div>
        <div class="ready-start-div">
            <p> First Divison</p>
        </div>
        <div class="site-stats-div">
            <p> First Divison</p>
        </div> --}}
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

    .welcome-message-div {
        margin-bottom: 2px;

    }

    .welcome-message-div p {
        font-size: 12px;
        align-self: center;

    }

    .welcome-block {
        background: #1B4D3F;
        /* soft green to blue */
        border-left: 6px solid #22c55e;
        border-right: 6px solid #3B82F5;
        border-radius: 0 0 16px 16px;
        color: #fff;
        padding: 0.5rem;
        margin: 0.5rem auto;
        max-width: 800px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .welcome-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .welcome-block h1 {
        font-family: 'Georgia', serif;
        font-size: 1.75rem;
        color: white;
        /* dark slate */
        line-height: 1.5;
        -webkit-background-clip: text;
    }

    .question-answer-div {
        background-color: aqua;

    }

    .question-answer-div p {
        font-size: 12px;
        align-self: center;

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
