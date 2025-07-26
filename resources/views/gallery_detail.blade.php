@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 justify-content-center">
        <div class="col-12 text-center">
            <img src="{{ $pose['image_url'] }}" alt="{{ $pose['title'] }}" class="img-fluid rounded shadow-sm mx-auto mb-4" style="max-width: 300px;">
            <h1 class="mb-3 display-4 font-bold text-4xl text-green-800">{{ $pose['title'] }}</h1>
        </div>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded mb-3">
                <h3 class="text-xl font-semibold mb-2">Introduction</h3>
                <p class="text-gray-800">{{ $pose['introduction'] ?? $pose['description'] }}</p>
            </div>
            @if (!empty($pose['description']) && ($pose['introduction'] ?? '') !== $pose['description'])
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-3">
                <h4 class="text-lg font-semibold mb-2">Description</h4>
                <p class="text-gray-700">{{ $pose['description'] }}</p>
            </div>
            @endif
        </div>
    </div>
    <x-pose-steps :steps="$pose['steps']" />
    <div class="row mb-4 justify-content-center">
        <div class="col-md-5 mb-3 mb-md-0">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 shadow-sm h-100">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    <h4 class="text-lg font-semibold text-green-800 mb-0">Benefits</h4>
                </div>
                <ul class="list-disc pl-5 text-green-900">
                    @foreach ($pose['benefits'] ?? [] as $benefit)
                        <li class="mb-1">{{ $benefit }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-5">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 shadow-sm h-100">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    <h4 class="text-lg font-semibold text-red-800 mb-0">Contraindications</h4>
                </div>
                <ul class="list-disc pl-5 text-red-900">
                    @foreach ($pose['contraindications'] ?? [] as $con)
                        <li class="mb-1">{{ $con }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}"
               style="display: inline-flex; align-items: center; padding: 0.75rem 2rem; background: #22c55e; color: #fff; font-weight: 600; font-size: 1.25rem; border-radius: 9999px; box-shadow: 0 2px 8px rgba(34,197,94,0.15); border: 2px solid #16a34a; transition: background 0.2s, color 0.2s; text-decoration: none;"
               onmouseover="this.style.background='#16a34a'"
               onmouseout="this.style.background='#22c55e'">
                <svg class="mr-2" style="width: 1.5rem; height: 1.5rem; min-width: 1.5rem;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                <span style="vertical-align: middle;">Back to Gallery</span>
            </a>
        </div>
    </div>
</div>
@endsection 