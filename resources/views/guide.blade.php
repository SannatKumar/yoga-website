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
    <div class="max-w-5xl mx-auto space-y-12">

        <!-- Step 1 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-1-title') ?? 'Step 1: Choose a Space' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-1-desc') ?? 'Find a clean and peaceful meditation space of your choice. Lay down your mat and prepare yourself mentally.' }}</p>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-2-title') ?? 'Step 2: Sit & Chant Guru Stuti' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-2-desc') ?? 'Sit in any comfortable meditative posture and chant the Guru Stuti to invoke inner wisdom and guidance.' }}</p>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-3-title') ?? 'Step 3: Start with Sukshma Vyayama' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-3-desc') ?? 'Begin with subtle yogic warm-up movements to energize joints and prepare the body for deeper practice.' }}</p>
        </div>

        <!-- Step 4 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-4-title') ?? 'Step 4: Practice Sthula Vyayama' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-4-desc') ?? 'Follow with larger body movements to activate muscles, improve circulation, and increase flexibility.' }}</p>
        </div>

        <!-- Step 5 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-5-title') ?? 'Step 5: Pawanmuktasana Series' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-5-desc') ?? 'Perform gas-relieving series to detoxify, improve digestion, and release energy blocks.' }}</p>
        </div>

        <!-- Step 6 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-6-title') ?? 'Step 6: Asanas (Standing, Sitting, Supine)' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-6-desc') ?? 'Move through standing, sitting, and lying postures in sequence. Maintain awareness of breath and alignment.' }}</p>
        </div>

        <!-- Step 7 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-7-title') ?? 'Step 7: Savasana' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-7-desc') ?? 'Lie down in corpse pose and relax every part of your body for at least 3 minutes. Let go completely.' }}</p>
        </div>

        <!-- Step 8 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-8-title') ?? 'Step 8: Pranayama (Kapalbhati, Bhastrika, Anuloma-Viloma)' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-8-desc') ?? 'Perform energizing and balancing breathwork techniques with mindfulness and correct posture.' }}</p>
        </div>

        <!-- Step 9 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-9-title') ?? 'Step 9: Mudras & Bhramari' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-9-desc') ?? 'Practice selected mudras (hand gestures) and the humming Bhramari Pranayama to induce calmness and mental focus.' }}</p>
        </div>

        <!-- Step 10 -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-2">{{ __('messages.step-10-title') ?? 'Step 10: Silent Meditation & Closing' }}</h2>
            <p class="text-gray-700">{{ __('messages.step-10-desc') ?? 'Sit in silence, focus on a mantra or image of the divine. Conclude with gratitude and closing chants.' }}</p>
        </div>

    </div>

</div>
@endsection
