@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100">
            <div class="welcome-block">
              <img src="/lotus-images/red_lotus.svg" alt="Welcome Icon" class="mx-auto mb-0 w-48 h-20">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-700">Guru Stuti</h1>
        </div>

                                <!-- Steps Section -->
            <div class="guide-text-block-div">
                @foreach ($guruStutis as $guruStuti)
                <x-guide-block 
                    :title="$guruStuti['title']" 
                    :text="$guruStuti['text']"  />
                @endforeach
            </div>
            <section class="mt-32 px-6 py-20 ">
</section>
</div>
@endsection

<style>
        .welcome-block {
  background: #1B4D3F; /* soft green to blue */
  border-left: 6px solid #22c55e;
  border-right: 6px solid #3B82F5;
  border-radius: 0 0 16px 16px;
  color: #fff;
  padding: 2rem;
  margin: 2rem auto;
  max-width: 800px;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.welcome-block:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

.welcome-block h1 {
  font-family: 'Georgia', serif;
  font-size: 1.75rem;
  color: white; /* dark slate */
  line-height: 1.5;
  -webkit-background-clip: text;
}
</style>