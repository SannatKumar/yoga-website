@extends('layouts.app')

@section('content')
    <div class="main-div">
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/sky_blue_lotus.svg" :text="__('messages.surya-namaskara') ?? '🙏 Surya Namaskara'" />
        </div>

        @if ($suryaNamaskara)
            <div class="part-two-div">
                @if ($suryaNamaskara->introduction)
                    <p class="intro-text">{{ $suryaNamaskara->introduction }}</p>
                @endif
            </div>

            <div class="part-three-div">
                <div class="asana-info benefits">
                    <h3>Benefits</h3>
                    @if ($suryaNamaskara->benefits->isNotEmpty())
                        <ul class="info-list">
                            @foreach ($suryaNamaskara->benefits as $benefit)
                                <li>{{ $benefit->benefit }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No benefits listed yet.</p>
                    @endif
                </div>

                <div class="asana-info contraindications">
                    <h3>Contraindications</h3>
                    @if ($suryaNamaskara->contraindications->isNotEmpty())
                        <ul class="info-list">
                            @foreach ($suryaNamaskara->contraindications as $contraindication)
                                <li>{{ $contraindication->contraindication }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No contraindications listed yet.</p>
                    @endif
                </div>
            </div>

            <div class="part-four-div">
                <h2 class="sequence-title">The 12 Postures</h2>

                @if ($suryaNamaskara->steps->isNotEmpty())
                    <ol class="sequence-list">
                        @foreach ($suryaNamaskara->steps as $step)
                            <li class="sequence-step">
                                <div class="step-number">{{ $step->step_order }}</div>
                                <div class="step-body">
                                    @if ($step->asana)
                                        <a href="{{ route('asana-details', ['lang' => app()->getLocale(), 'id' => $step->asanas_id]) }}" class="step-title">
                                            {{ $step->asana->asana_name }}
                                        </a>
                                    @else
                                        <span class="step-title">Unknown posture</span>
                                    @endif
                                    <div class="step-meta">
                                        @if ($step->breathing)
                                            <span class="meta-pill"><span class="meta-label">Breath</span> {{ $step->breathing }}</span>
                                        @endif
                                        @if ($step->chakra)
                                            <span class="meta-pill"><span class="meta-label">Chakra</span> {{ $step->chakra }}</span>
                                        @endif
                                        @if ($step->mantra)
                                            <span class="meta-pill"><span class="meta-label">Mantra</span> {{ $step->mantra }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p>The posture sequence hasn't been added yet.</p>
                @endif
            </div>
        @else
            <!-- Happy fallback: no Surya Namaskara data yet -->
            <div class="part-two-div">
                <div class="coming-soon">
                    <h2>Surya Namaskara is on its way</h2>
                    <p>We're still putting this practice together. Check back soon!</p>
                </div>
            </div>
        @endif
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

    .intro-text {
        color: #444;
        line-height: 1.6;
        padding: 0 1rem;
    }

    .part-two-div,
    .part-three-div,
    .part-four-div {
        margin-bottom: 2rem;
        padding: 0 1rem;
    }

    .part-three-div {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .asana-info {
        flex: 1;
        min-width: 260px;
        padding: 1rem;
        border-radius: 12px;
    }

    .benefits {
        background: #e6f7ed;
        border: 1px solid #25c55d;
    }

    .contraindications {
        background: #fff3f3;
        border: 1px solid #e74c3c;
    }

    .info-list {
        margin: 0;
        padding-left: 1.2rem;
    }

    .info-list li {
        margin-bottom: 0.4rem;
    }

    .sequence-title {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        color: #2c3e50;
    }

    .sequence-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sequence-step {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        background: #f9f9f9;
        border-radius: 12px;
        padding: 1rem;
        border-left: 4px solid #25c55d;
    }

    .step-number {
        background: #25c55d;
        color: white;
        font-weight: bold;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .step-body {
        flex: 1;
    }

    .step-title {
        display: block;
        font-weight: bold;
        font-size: 1.1rem;
        color: #2c3e50;
        text-decoration: none;
        margin-bottom: 0.5rem;
    }

    .step-title:hover {
        text-decoration: underline;
    }

    .step-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .meta-pill {
        background: #fff;
        border: 1px solid #3498db;
        border-radius: 20px;
        padding: 0.3rem 0.8rem;
        font-size: 13px;
        color: #2c3e50;
    }

    .meta-label {
        font-weight: bold;
        color: #3498db;
        margin-right: 0.3rem;
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
