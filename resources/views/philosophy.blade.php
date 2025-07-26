@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold text-center mb-8 text-green-800" style="letter-spacing:0.01em;">{{ __('messages.yoga-philosophy') ?? 'Yoga Philosophy' }}</h1>
    <div class="container mb-5">
        <div class="row justify-content-center g-4 flex-wrap">
            <div class="col-12 col-md-6 col-lg-2 mb-4 d-flex align-items-stretch">
                <div class="quote-card p-4 h-100 w-100">
                    <div class="quote-title mb-2">The Light Within</div>
                    <div class="quote-text mb-3">Yoga is the journey of the self, through the self, to the self.</div>
                    <div class="quote-ref">— The Bhagavad Gita</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex align-items-stretch">
                <div class="quote-card p-4 h-100 w-100">
                    <div class="quote-title mb-2">On Practice</div>
                    <div class="quote-text mb-3">Practice and all is coming.</div>
                    <div class="quote-ref">— Sri K. Pattabhi Jois</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex align-items-stretch">
                <div class="quote-card p-4 h-100 w-100">
                    <div class="quote-title mb-2">Yoga Sutra</div>
                    <div class="quote-text mb-3">Yogaś citta-vṛtti-nirodhaḥ (Yoga is the cessation of the fluctuations of the mind).</div>
                    <div class="quote-ref">— Patanjali, Yoga Sutras 1.2</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex align-items-stretch">
                <div class="quote-card p-4 h-100 w-100">
                    <div class="quote-title mb-2">On Compassion</div>
                    <div class="quote-text mb-3">Be kind whenever possible. It is always possible.</div>
                    <div class="quote-ref">— The Dalai Lama</div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-4 d-flex align-items-stretch">
                <div class="quote-card p-4 h-100 w-100">
                    <div class="quote-title mb-2">Mahavakyas (Great Sayings)</div>
                    <ul class="mahavakya-list mb-0">
                        <li><span class="mahavakya">{{ __('messages.mahavakya-1') }}</span> <span class="mahavakya-ref">(Consciousness is Brahman)</span></li>
                        <li><span class="mahavakya">{{ __('messages.mahavakya-2') }}</span> <span class="mahavakya-ref">(I am Brahman)</span></li>
                        <li><span class="mahavakya">{{ __('messages.mahavakya-3') }}</span> <span class="mahavakya-ref">(That Thou Art)</span></li>
                        <li><span class="mahavakya">{{ __('messages.mahavakya-4') }}</span> <span class="mahavakya-ref">(This Self is Brahman)</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style>
        .philosophy-section {
            max-width: 800px;
            margin: 0 auto 2rem auto;
            padding: 1.5rem 1.5rem 1.2rem 1.5rem;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-left: 6px solid #6c63ff;
        }
        .philosophy-section:nth-child(odd) {
            background: #f3f1ff;
            border-left: 6px solid #554ee2;
        }
        .philosophy-section h2 {
            color: #6c63ff;
            margin-bottom: 0.7rem;
            font-size: 1.3rem;
        }
        .philosophy-section p {
            color: #444;
            font-size: 1.08rem;
            margin-bottom: 0;
        }
        @media (max-width: 900px) {
            .philosophy-section {
                max-width: 98vw;
                padding: 1.1rem 0.7rem 1rem 0.7rem;
            }
        }
    .quote-card {
        background: #fff;
        border: 2px solid #22c55e;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(34,197,94,0.07);
        color: #111;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .quote-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: #15803d;
        letter-spacing: 0.01em;
    }
    .quote-text {
        font-size: 1.18rem;
        color: #111;
        text-align: center;
        font-style: italic;
        position: relative;
    }
    .quote-text:before, .quote-text:after {
        content: '“';
        color: #22c55e;
        font-size: 1.5rem;
        vertical-align: top;
        font-style: normal;
    }
    .quote-text:after {
        content: '”';
        vertical-align: bottom;
    }
    .quote-ref {
        text-align: right;
        font-size: 0.98rem;
        color: #444;
        font-style: italic;
        margin-top: auto;
    }
    .mahavakya-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    .mahavakya-list li {
        margin-bottom: 0.5rem;
        font-size: 1.08rem;
        color: #111;
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
    }
    .mahavakya {
        font-weight: 600;
        color: #15803d;
        margin-right: 0.5em;
    }
    .mahavakya-ref {
        font-style: italic;
        color: #444;
        font-size: 0.98em;
    }
    @media (max-width: 991px) {
        .quote-card { min-height: 200px; }
    }
    @media (max-width: 767px) {
        .quote-card { min-height: 180px; }
    }
    /* New green/white theme for philosophy sections */
    .philosophy-section {
        max-width: 800px;
        margin: 0 auto 2rem auto;
        padding: 1.5rem 1.5rem 1.2rem 1.5rem;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(34,197,94,0.07);
        border-left: 6px solid #22c55e;
        border-right: 2px solid #bbf7d0;
    }
    .philosophy-section h2 {
        color: #15803d;
        margin-bottom: 0.7rem;
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 0.01em;
    }
    .philosophy-section p {
        color: #222;
        font-size: 1.08rem;
        margin-bottom: 0;
    }
    @media (max-width: 900px) {
        .philosophy-section {
            max-width: 98vw;
            padding: 1.1rem 0.7rem 1rem 0.7rem;
        }
    }
    </style>
    <h1 class="text-4xl font-bold text-center mb-8 text-green-800" style="letter-spacing:0.01em;">{{__('messages.learning-and-understanding')}}</h1>
    <div class="philosophy-section">
        <h2>1. Yoga as a Journey, Not a Destination</h2>
        <p>
            We believe yoga is a lifelong journey of self-discovery and growth. Every practice, no matter how small, brings us closer to our true selves.
        </p>
    </div>
    <div class="philosophy-section">
        <h2>2. Mind-Body Connection</h2>
        <p>
            Our approach emphasizes the harmony between mind and body. Through breath, movement, and mindfulness, we cultivate balance and inner peace.
        </p>
    </div>
    <div class="philosophy-section">
        <h2>3. Inclusivity and Compassion</h2>
        <p>
            Yoga is for everyone. We foster a welcoming environment where all students, regardless of background or ability, are supported with compassion and respect.
        </p>
    </div>
    <div class="philosophy-section">
        <h2>4. Growth Through Consistency</h2>
        <p>
            Consistent practice leads to transformation. We encourage regular participation, knowing that small, steady steps create lasting change.
        </p>
    </div>
    <div class="philosophy-section">
        <h2>5. Living Yoga Off the Mat</h2>
        <p>
            Yoga extends beyond physical postures. We inspire our community to embody yogic values—kindness, patience, and gratitude—in daily life.
        </p>
    </div>
@endsection 