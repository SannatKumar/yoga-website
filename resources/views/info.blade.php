@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
<!-- <div class="container py-5 min-h-screen"> -->
    <h1 class="text-4xl font-bold text-center mb-8 text-green-800">About Us</h1>
    <div class="mx-auto mb-10 max-w-2xl">
        <div class="bg-green-50 border-l-4 border-green-400 rounded-lg p-5 flex items-center justify-center gap-3 shadow-sm">
            <svg class="flex-shrink-0" style="width:2.2rem;height:2.2rem;min-width:2.2rem;" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#22c55e" stroke-width="2" fill="#bbf7d0"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2 4-4" /></svg>
            <span class="text-center text-lg text-gray-700">Meet our dedicated yoga teachers and contributors. Each brings their unique experience and passion to help you on your yoga journey.</span>
        </div>
    </div>
    <!-- <div class="row justify-content-center g-4"> -->
    <div class="card-container">
    @foreach($teachers as $teacher)
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 text-center">
                <img src="{{ $teacher['photo'] }}" alt="{{ $teacher['name'] }}" style="width:100%" class="fixed-size">
                        <h2>
            <a href="{{ url('teacher/'.$teacher['id']) }}">
                {{ $teacher['name'] }}
            </a>
            <p>{{ 'en/teacher/'.$teacher['id'] }}</p>
        </h2>
                <p class="title">{{ $teacher['title'] }}</p>
                <p>{{ $teacher['bio'] }}</p>
                <div style="margin: 24px 0;">
                    <a href="#"><i class="fa fa-dribbble"></i></a> 
                    <a href="#"><i class="fa fa-twitter"></i></a>  
                    <a href="#"><i class="fa fa-linkedin"></i></a>  
                    <a href="#"><i class="fa fa-facebook"></i></a> 
                </div>
                <p><button>Contact</button></p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<style>
.container{
    min-height: 1260px;
}
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      justify-content: center;
      padding: 20px;
      height: 450px;
    }
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 350px;
  min-height: 420px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

img.fixed-size {
  width: 200px;       /* or any desired width */
  height: 250px;      /* or any desired height */
  object-fit: cover;  /* makes sure image fills the box */
  object-position: center; /* keeps it centered */
  border-radius: 8px; /* optional: for rounded corners */
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  /* font-size: 22px; */
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}

@media (min-width: 576px) { 
    .teacher-card { 
        margin-bottom: 2.5rem !important; 
        padding: 2rem !important; 
        min-height: 370px; 
    }
    .container{
        min-height: 2000px;
    } 
}
@media (min-width: 768px) {
     .teacher-card {
         margin-bottom: 2.5rem !important; 
         padding: 2rem !important; 
         min-height: 370px; } 
    }
    .container{
        min-height: 100vh;
    }
</style>
@endsection 