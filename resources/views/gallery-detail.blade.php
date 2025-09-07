@extends('layouts.app')

@php

// $steps = [
//     "Stand firmly with the feet together or hip-width apart, arms relaxed by the sides.",
//     "Steady the body and distribute weight evenly across both feet.",
//     "Raise the arms overhead.",
//     "Interlock the fingers, turn the palms upward, and place the hands on top of the head.",
//     "Fix the gaze slightly above eye level on a point on the wall. Keep the eyes steady throughout the practice.",
//     "Inhale and stretch the arms, shoulders, and chest upward.",
//     "Rise onto the toes, lifting the heels off the floor.",
//     "Stretch the entire body from head to toe without losing balance or moving the feet.",
//     "Breathe normally. At first, balance may be challenging, but it improves with practice.",
//     "Exhale, lower the heels, and bring the hands back onto the head.",
//     "This completes one round."
// ];
@endphp
@php
$image_paths = [
    '/lotus-images/red_lotus.svg','/lotus-images/yellow_lotus.svg'
];
@endphp
@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">

            <x-page-header image_path="/lotus-images/red_lotus.svg" :text="__('messages.practice-steps-and-guide') ?? '🙏 Practice Steps & Guide' " />
        </div>
        <!--First Div Ends-->
        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-div-main-section">
                <div class="images-and-desc">
                    <!-- Small preview image -->
                    <a href="#asana-popup">
                        <img src="/images/yogasana_pictures/virasana.jpeg" alt="Asana" class="asana-thumb">
                    </a>
                    <p>Virasana</p>
                </div>

                <!-- Hidden popup for bigger image -->
                <div id="asana-popup" class="popup">
                    <a href="#" class="close">&times;</a>
                    <img src="/images/yogasana_pictures/virasana.jpeg" alt="Asana Large">
                </div>

            </div>
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">
            <div class="div-three-main-div">
                <x-asana-step-card  header="'First Sit in Bajrasana'" :steps="$steps" :image_paths="$image_paths" />
            </div>

        </div>
        <!--Third Div Ends-->

        <!--Fourth Div starts -->
        <div class="part-four-div">

  <div class="asana-info benefits">
    <h3>Benefits</h3>
    <p>This asana develops physical and mental balance. The entire spine is stretched and loosened...</p>
  </div>

  <div class="asana-info contraindications">
    <h3>Contraindications</h3>
    <p>People with vertigo must take care or avoid it. Those with ankle injury need not stand on toes...</p>
  </div>
</div>


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
        margin-bottom: 1px;
    }

    .part-one-div p {
        font-size: 12px;
        align-self: center;

    }

    .part-two-div {
        margin-bottom: 2px;
        /*margin-top: 10px;*/

    }

    .part-two-div p {
        font-size: 12px;
        align-self: center;

    }

    .step-image-img{
        width: 100%;
        height: 100%;
        object-fit: contain;

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
    .card .card-footer {
        margin-top: auto;
    }

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

    .fixed-size {
        width: 200px;
        /* or any desired width */
        height: 250px;
        /* or any desired height */
        object-fit: cover;
        /* makes sure image fills the box */
        object-position: center;
        /* keeps it centered */
        border-radius: 8px;
        /* optional: for rounded corners */
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

    button:hover,
    a:hover {
        opacity: 0.7;
    }

    .images-and-desc{
        display: flex;              /* enable flexbox */
        flex-direction: column; 
            align-items: center;        /* center horizontally */
    justify-content: center;    /* center vertically (if height given) */
    text-align: center;         /* center text inside <p> or <h> */
    min-height: 300px;          /* optional: sets height to demonstrate vertical centering */
    gap: 10px;  

    }
    .part-two-div {
        text-align: center;
        margin-top: 20px;
    }

    .asana-thumb {
        width: 150px;
        height: 200px;
        /* small preview size */
        cursor: pointer;
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .asana-thumb:hover {
        transform: scale(1.05);
    }

    /* Popup overlay */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        text-align: center;
        /* padding: 50px; */
        padding-top: 5%;
    }

    .popup img {
        margin: 100px;
        height: 800px;
        width: 800px;
        max-width:100%;
        max-height: 100%;
        border-radius: 10px;
        box-shadow: 0 0 20px #000;
    }

    /* Show popup when linked */
    .popup:target {
        display: block;
    }

    /* Close button */
    .popup .close {
        position: absolute;
        top: 100px;
        right: 100px;
        text-decoration: none;
        font-size: 40px;
        color: white;
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

    .asana-card {
  background: #fff;
  border-radius: 16px;
  padding: 1.5rem;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  max-width: 700px;
  margin: 2rem auto;
  font-family: sans-serif;
}

.asana-title {
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 1.8rem;
  color: #2c3e50;
}

/* Step container */
.asana-steps {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 2rem;
}

.step {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  background: #f9f9f9;
  border-radius: 12px;
  padding: 1rem;
  border-left: 4px solid #25c55d;
}

.step-number {
  background: #25c55d;
  color: white;
  font-weight: bold;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.step-content {
  flex: 1;
}

/* Info blocks */
.asana-info {
  padding: 1rem;
  border-radius: 12px;
  margin-top: 1rem;
}

.benefits {
  background: #e6f7ed;
  border: 1px solid #25c55d;
}

.contraindications {
  background: #fff3f3;
  border: 1px solid #e74c3c;
}

</style>
