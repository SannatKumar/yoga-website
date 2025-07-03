@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; margin-bottom:2rem;">Our Yoga Philosophy</h1>
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
    </style>
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