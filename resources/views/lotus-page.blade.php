@extends('layouts.app')

@section('content')
    <div class="main-div">
        <!--First Div starts -->
        <div class="part-one-div">

            <div class="welcome-block">
                <img src="/lotus-images/red_lotus.svg" alt="Welcome Icon" class="lotus-image">
                <h1 class="welcome-text">
                    Lotus
                </h1>
            </div>

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <img src="/lotus-images/chakra_image.png" alt="Meditative man" class="chakra-image">
            
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
