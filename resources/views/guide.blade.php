@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 py-16 px-6">

    <!-- Page Heading -->
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            {{ __('messages.yoga-practice-guide') ?? '🧘 Yoga Practice Guide' }}
        </h1>
        <p class="text-lg text-gray-600">
            {{ __('messages.follow-these-steps') ?? 'Follow these steps to deepen your practice and connect within.' }}
        </p>
    </div>

   
    <!-- Steps Section -->
    <div class="guide-text-block-div">
        @foreach ($guideBlocks as $block)
        <x-guide-block 
            :title="$block['title']" 
            :text="$block['text']" 
            :reference="$block['reference']" />
        @endforeach
    </div>

</div>
@endsection
