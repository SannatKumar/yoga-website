@extends('layouts.app')

@section('content')
<div class="mantra-list-container">
    <div class="mantra-list-header">
        <img src="/lotus-images/red_lotus.svg" alt="Lotus" class="mantra-list-icon">
        <h1 class="mantra-list-title">Mantras Collection</h1>
    </div>

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

<style>
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
@endsection
