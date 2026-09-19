@extends('layouts.app')

@section('content')
    <div class="main-div">
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/moon_lotus.svg" :text="__('messages.yoga-nidra') ?? '🙏 Yoga Nidra'" />
        </div>

        <div class="part-two-div">
            <div class="coming-soon">
                <h2>Yoga Nidra is on its way</h2>
                <p>Guided yogic sleep content isn't ready yet — we're working on it. Check back soon!</p>
            </div>
        </div>
    </div>
@endsection

<style>
    .main-div {
        background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
        width: 60%;
        display: flex;
        flex-direction: column;
        margin: 0 auto;
    }

    .part-one-div {
        margin-bottom: 20px;
    }

    .part-two-div {
        padding: 0 1rem;
    }

    .coming-soon {
        text-align: center;
        background: #fff;
        border-radius: 12px;
        padding: 3rem 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .coming-soon h2 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .coming-soon p {
        color: #666;
    }

    @media (max-width: 768px) {
        .main-div {
            width: 100%;
        }
    }
</style>
