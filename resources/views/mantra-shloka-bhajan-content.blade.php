@extends('layouts.app')

@section('content')
<div class="mantra-container">
    <div class="mantra-header">
        <img src="/lotus-images/red_lotus.svg" alt="Lotus" class="mantra-icon">
        <h1 class="mantra-title">{{ $mantra->title }}</h1>
    </div>

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
</div>

<style>
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
    }
</style>
@endsection
