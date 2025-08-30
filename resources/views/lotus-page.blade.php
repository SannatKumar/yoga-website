@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">
            <x-page-header image_path="/lotus-images/red_lotus.svg" :text="__('messages.lotus') ?? '🙏 Lotus' " />
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <img src="/lotus-images/complete_chakra_image_lotus.png" alt="Meditative man" class="chakra-image">
            
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
        margin-bottom: 0px;
    }

    .part-one-div p {
        font-size: 12px;
        align-self: center;

    }
.part-two-div {
    display: flex;
    justify-content: center; /* horizontal center */
    /*align-items: center;     vertical center*/
    height: 100vh;           /* full viewport height */
}

.chakra-image {
    max-width: 100%;
    height: auto;
        border: 4px solid #87ceeb; /* thickness + color */
    border-radius: 48px;    /* optional: rounded corners */
    padding: 4px; 
}


    .chakra-image{
        width: 600px;
        height: 800px;
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
        .chakra-image{
            width: 600px;
            height: 500px;
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
