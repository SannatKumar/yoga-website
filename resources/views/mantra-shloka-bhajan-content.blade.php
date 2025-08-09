@extends('layouts.app')

@section('content')
<div class="main-div">
    <div class="welcome-message-div">
        <h1>{{ $mantra->title }}</h1>
    </div>

    <div class="feature-box">
        <p><strong>Author:</strong> {{ $mantra->author }}</p>
        <p><strong>Year:</strong> {{ $mantra->year }}</p>
        <p><strong>Book:</strong> {{ $mantra->book }}</p>
    </div>

    <div class="feature-box">
        <h3>Original Mantra:</h3>
        <p style="font-size:1.2rem;">{{ $mantra->content }}</p>
    </div>

    @if($mantra->translation)
    <div class="feature-box">
        <h3>Translation ({{ $mantra->translation_language }}):</h3>
        <p>{{ $mantra->translation }}</p>
    </div>
    @endif
</div>
@endsection
