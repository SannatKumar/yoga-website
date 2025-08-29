@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100">
           <x-page-header image_path="/lotus-images/red_lotus.svg" :text="__('messages.asana-and-practices') ?? '🙏 Guru Stuti' " />
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
        
</style>