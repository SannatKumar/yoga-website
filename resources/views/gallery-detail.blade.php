@extends('layouts.app')

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

    img.fixed-size {
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
        padding-top: 5%;
    }

    .popup img {
        max-width: 80%;
        max-height: 80%;
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
</style>
