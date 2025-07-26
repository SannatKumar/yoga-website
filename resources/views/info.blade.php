@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-4xl font-bold text-center mb-8 text-green-800">About Us</h1>
    <div class="mx-auto mb-10 max-w-2xl">
        <div class="bg-green-50 border-l-4 border-green-400 rounded-lg p-5 flex items-center justify-center gap-3 shadow-sm">
            <svg class="flex-shrink-0" style="width:2.2rem;height:2.2rem;min-width:2.2rem;" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#22c55e" stroke-width="2" fill="#bbf7d0"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2 4-4" /></svg>
            <span class="text-center text-lg text-gray-700">Meet our dedicated yoga teachers and contributors. Each brings their unique experience and passion to help you on your yoga journey.</span>
        </div>
    </div>
    <div class="row justify-content-center g-4">
        @foreach($teachers as $teacher)
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-5 d-flex align-items-stretch">
                <div class="card shadow-sm border-0 w-100 h-100 text-center p-4 teacher-card" style="min-height: 370px;">
                    <img src="{{ $teacher['photo'] }}" alt="{{ $teacher['name'] }}" class="rounded-circle mx-auto mb-4" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #22c55e; margin-top: 8px;">
                    <h3 class="text-xl font-semibold text-green-900 mb-2">{{ $teacher['name'] }}</h3>
                    <p class="text-gray-700 mb-4 small">{{ $teacher['bio'] }}</p>
                    <div class="d-flex justify-content-center gap-3 mt-2 mb-1">
                        @if(isset($teacher['social']['instagram']))
                            <a href="{{ $teacher['social']['instagram'] }}" target="_blank" class="social-icon instagram" title="Instagram">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1 0 2a1 1 0 0 1 0-2z"/></svg>
                            </a>
                        @endif
                        @if(isset($teacher['social']['facebook']))
                            <a href="{{ $teacher['social']['facebook'] }}" target="_blank" class="social-icon facebook" title="Facebook">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M17 2.1c-3.9 0-7 3.1-7 7v2H7v3h3v7h3v-7h2.1l.4-3H13V9c0-1.1.9-2 2-2h2V4.1c-.6-.1-1.3-.1-2-.1z"/></svg>
                            </a>
                        @endif
                        @if(isset($teacher['social']['website']))
                            <a href="{{ $teacher['social']['website'] }}" target="_blank" class="social-icon website" title="Website">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2c1.85 0 3.55.63 4.9 1.69l-1.45 1.45A6.978 6.978 0 0 0 12 6c-1.1 0-2.13.23-3.05.64l-1.45-1.45A7.978 7.978 0 0 1 12 4zm0 16c-1.85 0-3.55-.63-4.9-1.69l1.45-1.45A6.978 6.978 0 0 0 12 18c1.1 0 2.13-.23 3.05-.64l1.45 1.45A7.978 7.978 0 0 1 12 20zm8-8c0 1.85-.63 3.55-1.69-4.9l-1.45-1.45A6.978 6.978 0 0 0 18 12c0-1.1-.23-2.13-.64-3.05l1.45-1.45A7.978 7.978 0 0 1 20 12zM4 12c0-1.85.63-3.55 1.69-4.9l1.45 1.45A6.978 6.978 0 0 0 6 12c0 1.1.23 2.13.64 3.05l-1.45 1.45A7.978 7.978 0 0 1 4 12z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
.social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #f3f4f6;
    color: #555;
    font-size: 1.3rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    margin: 0 4px;
}
.social-icon.instagram {
    background: #fdf2f8;
    color: #e1306c;
}
.social-icon.facebook {
    background: #eff6ff;
    color: #1877f3;
}
.social-icon.website {
    background: #ecfdf5;
    color: #059669;
}
.social-icon:hover {
    background: #22c55e;
    color: #fff;
    box-shadow: 0 4px 16px rgba(34,197,94,0.15);
    text-decoration: none;
}
.teacher-card { margin-bottom: 2.5rem !important; padding: 2rem !important; min-height: 370px; }
@media (min-width: 576px) { .teacher-card { margin-bottom: 2.5rem !important; padding: 2rem !important; min-height: 370px; } }
@media (min-width: 768px) { .teacher-card { margin-bottom: 2.5rem !important; padding: 2rem !important; min-height: 370px; } }
</style>
@endsection 