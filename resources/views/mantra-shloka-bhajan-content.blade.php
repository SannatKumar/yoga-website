@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">

            <div class="welcome-block">
                <a href="{{ route('lotus-page', ['lang' => app()->getLocale()]) }}">
                    <img src="/lotus-images/red_lotus.svg" alt="Welcome Icon" class="lotus-image">
                </a>
                <h1 class="mantra-title">{{ $mantra->title }}</h1>
            </div>

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="mantra-card mantra-meta">
                <div class="mantra-meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">Author</span>
                        <span class="meta-value">{{ $mantra->author }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Year</span>
                        <span class="meta-value">{{ $mantra->year }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Book</span>
                        <span class="meta-value">{{ $mantra->book }}</span>
                    </div>
                </div>
            </div>
        
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">
            <div class="mantra-card">
            <h3 class="section-title">Original</h3>
            <p class="mantra-text">{{ $mantra->content }}</p>
        </div>

        @if($mantra->translation)
        <div class="mantra-card">
            <h3 class="section-title">Translation ({{ $mantra->translation_language }}):</h3>
            <p class="translation-text">{{ $mantra->translation }}</p>
        </div>
        @endif

        <div class="card-container">
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

    .welcome-block {
        background: #1B4D3F;
        border-left: 6px solid #22c55e;
        border-right: 6px solid #3B82F5;
        border-radius: 0 0 16px 16px;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
        margin: 0.2rem auto;
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
        -webkit-background-clip: text;
    }

    .lotus-image{
        margin-left: auto;   
        margin-right: auto;
        margin-bottom: 0;    
        width: 12rem;        
        height: 60px;  
    }

    .welcome-text{
        font-weight: 600;       
        font-size: 1.5rem;      
        line-height: 60px;    
    }


    .mantra-container {
        max-width: 860px;
        margin: 0 auto 2rem auto;
        padding: 0 1rem;
    }
    .mantra-header {
        text-align: center;
        margin-bottom: 1rem;
    }
    .mantra-icon {
        width: 90px;
        height: 90px;
        display: block;
        margin: 0 auto 0.5rem auto;
    }
    .mantra-title {
        font-size: 2rem;
        font-weight: 800;
        color: #15803d;
        letter-spacing: 0.01em;
        margin: 0.25rem 0 0.5rem 0;
        text-align: center;
    }
    .mantra-card {
        background: #fff;
        border: 2px solid #22c55e;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(34,197,94,0.07);
        padding: 1rem 1.2rem;
        margin-bottom: 1rem;
    }
    .section-title {
        margin: 0 0 0.5rem 0;
        color: #15803d;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.01em;
    }
    .mantra-text {
        font-size: 1.25rem;
        line-height: 1.8;
        white-space: pre-line;
        color: #111;
        text-align: center;
    }
    .translation-text {
        font-size: 1.05rem;
        line-height: 1.7;
        white-space: pre-line;
        color: #222;
    }
    .mantra-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
    }
    .meta-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .meta-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #15803d;
        font-weight: 700;
    }
    .meta-value {
        font-size: 1.05rem;
        color: #111;
    }
    @media (max-width: 768px) {
        .mantra-meta-grid { grid-template-columns: 1fr; }
        .mantra-title { font-size: 1.6rem; }
        .mantra-icon { width: 72px; height: 72px; }
    }    /* Small Screen Sizes CSS */
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
