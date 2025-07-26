@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <img src="{{ $pose['image_url'] }}" alt="{{ $pose['title'] }}" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <h1 class="mb-3">{{ $pose['title'] }}</h1>
            <p><strong>Category:</strong> {{ $pose['category'] }}</p>
            <p><strong>Difficulty:</strong> {{ $pose['difficulty'] }}</p>
            <p><strong>Tags:</strong> {{ implode(', ', $pose['tags']) }}</p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h3>Introduction</h3>
            <p>{{ $pose['introduction'] ?? $pose['description'] }}</p>
        </div>
    </div>
    @if (!empty($pose['steps']))
    <div class="row mb-4">
        <div class="col-12">
            <h3>12 Steps</h3>
            <ol>
                @foreach ($pose['steps'] as $step)
                    <li><strong>{{ $step['name'] }}</strong>: {{ $step['desc'] }}</li>
                @endforeach
            </ol>
        </div>
    </div>
    @endif
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Benefits</h4>
            <ul>
                @foreach ($pose['benefits'] ?? [] as $benefit)
                    <li>{{ $benefit }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Contraindications</h4>
            <ul>
                @foreach ($pose['contraindications'] ?? [] as $con)
                    <li>{{ $con }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}" class="btn btn-secondary">Back to Gallery</a>
        </div>
    </div>
</div>
@endsection 