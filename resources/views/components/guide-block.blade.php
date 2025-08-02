@props(['title', 'text', 'reference' => null])

<div class="guide-block">
    <h2 class="guide-title">{{ $title }}</h2>
    <p class="guide-text">{{ $text }}</p>
    @if($reference)
        <div class="guide-ref">— {{$reference}}</div>
    @endif
</div>


@once
    @push('styles')
        <link href="{{ asset('css/guide-text-block.css') }}" rel="stylesheet">
    @endpush
@endonce

<style>
/* .guide-block {
    background-color: #fff;
    border-left: 6px solid #22c55e;
    border-right: 6px solid #3B82F5;
    
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.5);
    margin-bottom: 2rem;
    transition: box-shadow 0.2s ease;
}  */

.guide-block {
  position: relative;
  background-color: #fff;
  border-left: 6px solid #22c55e;
  border-right: 6px solid #3B82F5;

  /* border-radius: 0 0 12px 12px; */

  border-radius:  20%/50px 0px 12px 0 ;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 2rem;
  transition: box-shadow 0.2s ease;
  overflow: hidden;
}




.guide-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #15803d;
    margin-bottom: 1rem;
}

.guide-text p {
    font-size: 1.05rem;
    color: #222;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.guide-ref{
    font-style: italic;
    color: #555;
    text-align: right;
    font-size: 0.95rem;
    margin-top: 1rem;
}

    
</style>