@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/violet_lotus.svg" :text="__('messages.mantra-collection') ?? '🙏 Mantra Collection' " />

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-main-section">

                <div class="mantra-grid">
                    @foreach($mantras as $mantra)
                    <a class="mantra-card-link" href="{{ route('mantra-shloka-bhajan-content', ['lang' => app()->getLocale(), 'id' => $mantra->id]) }}">
                        <div class="mantra-item">
                            <div class="mantra-item-title">{{ $mantra->title }}</div>
                            <div class="mantra-item-meta">
                                <span><span class="meta-label">Author:</span> {{ $mantra->author }}</span>
                                <span><span class="meta-label">Year:</span> {{ $mantra->year }}</span>
                                <span><span class="meta-label">Book:</span> {{ $mantra->book }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>        
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">

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

    .mantra-list-container {
        max-width: 1100px;
        margin: 0 auto 2rem auto;
        padding: 0 1rem;
    }
    .mantra-list-header {
        text-align: center;
        margin-bottom: 1rem;
    }
    .mantra-list-icon {
        width: 90px;
        height: 90px;
        display: block;
        margin: 0 auto 0.5rem auto;
    }
    .mantra-list-title {
        font-size: 2rem;
        font-weight: 800;
        color: #15803d;
        letter-spacing: 0.01em;
        margin: 0.25rem 0 0.5rem 0;
    }
    .mantra-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }
    .mantra-card-link {
        text-decoration: none;
        display: block;
    }
    .mantra-item {
        background: #fff;
        border: 2px solid #22c55e;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(34,197,94,0.07);
        padding: 1rem 1.2rem;
        height: 100%;
        transition: transform 120ms ease, box-shadow 120ms ease;
        box-sizing: border-box;
        overflow: hidden;
    }
    .mantra-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(34,197,94,0.12);
    }
    .mantra-item-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: #111;
        text-align: center;
        margin-bottom: 0.5rem;
        overflow-wrap: anywhere;
        word-break: break-word;
    }
    .mantra-item-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 0.5rem 0.75rem;
        color: #111;
    }
    .mantra-item-meta span {
        display: flex;
        gap: 0.35rem;
        align-items: baseline;
        justify-content: center;
        font-size: 0.98rem;
        text-align: center;
        overflow-wrap: anywhere;
        word-break: break-word;
        max-width: 100%;
    }
    .meta-label {
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #15803d;
        font-weight: 700;
    }
    @media (max-width: 1024px) {
        .mantra-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 640px) {
        .mantra-grid { grid-template-columns: 1fr; }
        .mantra-list-title { font-size: 1.6rem; }
        .mantra-list-icon { width: 72px; height: 72px; }
    }
</style>
