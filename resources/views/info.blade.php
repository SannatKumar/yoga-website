@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">

            <div class="welcome-block">
                                <a href="{{ route('lotus-page', ['lang' => app()->getLocale()]) }}">
                <img src="/lotus-images/red_lotus.svg" alt="Welcome Icon" class="lotus-image">
                </a>
                <h1 class="welcome-text">
                    About Us
                </h1>
            </div>

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-main-section">
            <h2 class="text-4xl font-bold text-gray-800 mb-12 text-center">
            <span class="text-center text-lg text-gray-700">Meet our dedicated yoga teachers and contributors. Each brings their unique experience and passion to help you on your yoga journey.</span>
            </h2>
        </div>        
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">

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
                        <div class="card-footer">
                            <div class="social-links" style="margin: 0; background-color: #fff; padding: 10px; border-radius: 5px;">
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-whatsapp"></i></a> 
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-twitter"></i></a>  
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-linkedin"></i></a>  
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-facebook"></i></a>
                                <a href="#" style="margin: 1px 16px;"><i class="fa fa-instagram"></i></a> 
                            </div>
                            <p style="margin:0;"><button>Contact</button></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--Third Div Ends-->

        <!--Fourth Div starts -->
        <div class="part-four-div">
            

        </div>
        <!--Fourth Div Ends-->

        <!--Fifth Div starts -->
        <div class="part-five-div">


        </div>
        <!--Fifth Div Ends-->

        <!--Sixth Div starts -->
        <div class="part-six-div">


        </div>
        <!--Six Div Ends-->

        <!--Seven Div starts -->
        <div class="part-seven-div">
            

            

        </div>
        <!--Seven Div Ends-->

        <!--Eight Div starts -->

        <div class="part-eight-div">
            
            <div class="part-eight-main-content">
            </div>
        </div>
        <!-- Eight Div Ends-->

        <!--Ninth Div starts -->
        <div class="part-nine-div">
        </div> 
        <!--Ninth Div Ends -->
    </div>
@endsection

<style>
    /* Normal Screen CSS */
    .main-div {
        background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
        width: 60%;
        display: flex;
        flex-direction: column;
    }

    .part-one-div {
        margin-bottom: 40px;
    }

    .part-one-div p {
        font-size: 12px;
        align-self: center;

    }
    .part-two-div {
        /*margin-top: 10px;*/

    }

    .part-two-div p {
        font-size: 12px;
        align-self: center;

    }

    .welcome-block {
        background: #1B4D3F;
        border-left: 6px solid #22c55e;
        border-right: 6px solid #3B82F5;
        border-radius: 0 0 16px 16px;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
        margin: 0.2rem auto;
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
        color: white;
        -webkit-background-clip: text;
    }

    .lotus-image{
        margin-left: auto;   
        margin-right: auto;
        margin-bottom: 0;    
        width: 12rem;        
        height: 60px;  
    }

    .welcome-text{
        font-weight: 600;       
        font-size: 1.5rem;      
        line-height: 60px;    
    }





    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      justify-content: center;
      padding: 20px;
      height: auto;
      align-items: stretch;
    }

    /* Keep footer (icons + Contact) pinned to the bottom */
.card .card-footer { margin-top: auto; }
.card .card-footer p { 
    margin: 1px 2px; 
    
    height: 5px;
    background-color: #000; 
    padding: 10px; 
    border-radius: 5px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 350px;
  min-height: 520px;
  display: flex;
  flex-direction: column;
  height: 520px;
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

/* Clamp bio text to avoid cards growing unevenly */
/*
.card p:not(.title):not(:last-of-type) {
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
*/

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


    /* Small Screen Sizes CSS */
    /* Extra small devices (phones, < 576px) */
    @media (max-width: 575.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 100%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Small devices (phones, ≥ 576px and < 768px) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 100%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Medium devices (tablets, ≥ 768px and < 992px) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Large devices (laptops/desktops, ≥ 992px and < 1200px) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }

    /* Extra large devices (large desktops, ≥ 1200px) */
    @media (min-width: 1200px) {
        .main-div {
            background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
            width: 60%;
            display: flex;
            flex-direction: column;
        }
    }
</style>
