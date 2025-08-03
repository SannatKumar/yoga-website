{{-- resources/views/teacher-profile.blade.php --}}
<div class="teacher-profile">
  <section class="hero">
    <img src="{{ $teacher->photo }}" alt="Profile photo of {{ $teacher->name }}">
    <h1>{{ $teacher->name }}</h1>
    <p class="tagline">{{ $teacher->tagline ?? 'Inspiring balance and strength'}}</p>
  </section>

  <section class="info">
    <h2>About</h2>
    <p>{{ $teacher->bio }}</p>
    <ul class="credentials">
  @foreach($teacher->certificates ?? [] as $cert)
    <li>{{ $cert }}</li>
  @endforeach
</ul>

<p><strong>Date of Birth:</strong>
  @if(isset($teacher->dob) && $teacher->dob instanceof \Carbon\Carbon)
    {{ $teacher->dob->format('F j, Y') }}
  @else
    Not specified
  @endif
</p>

<p><strong>Qualifications:</strong>
  {{ isset($teacher->qualifications) ? implode(', ', $teacher->qualifications) : 'N/A' }}
</p>

<section class="social">
  <h2>Connect</h2>
  @if(!empty($teacher->social['instagram']))
    <a href="{{ $teacher->social['instagram'] }}" target="_blank">Instagram</a>
  @endif
  {{-- Add more as needed --}}
</section>
</div>

<style>
    .teacher-profile {
  max-width: 600px;
  margin: 2rem auto;
  font-family: 'Arial', sans-serif;
  line-height: 1.6;
}
.hero {
  text-align: center;
}
.hero img {
  width: 150px; border-radius: 50%;
}
.tagline {
  font-style: italic;
  color: #555;
}
.credentials { list-style: disc; padding-left: 1.5rem; }
.social a {
  margin-right: 1rem;
  color: #2a8fbd; text-decoration: none;
}
</style>
