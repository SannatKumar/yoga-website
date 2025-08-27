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
                    {{ __('messages.asana-and-practices') ?? '🙏 Asana & Practices' }}
                </h1>
            </div>

        
        </div>
        <!--First Div Ends-->


        <!--Second Div starts -->
        <div class="part-two-div">
            <div class="part-two-main-section">
                <section id="yoga-practices" style="padding:2rem; font-family:sans-serif;">
                <div class="practice-grid">
                    <!-- Card 1 -->
                    <div class="practice-card">
                    <h3>Sukshma Vyayama</h3>
                    <p>Gentle, subtle exercises that prepare the body for deeper yoga practices.</p>
                    <a href="sukshma.html" class="btn">Learn More</a>
                    </div>

                    <!-- Card 2 -->
                    <div class="practice-card">
                    <h3>Sthula Vyayama</h3>
                    <p>Physical warm-up movements to energize and awaken the body.</p>
                    <a href="sthula.html" class="btn">Learn More</a>
                    </div>

                    <!-- Card 3 -->
                    <div class="practice-card">
                    <h3>Tibetan Rites</h3>
                    <p>Five ancient yoga-based exercises believed to enhance vitality and longevity.</p>
                    <a href="tibetan.html" class="btn">Learn More</a>
                    </div>

                    <!-- Card 4 -->
                    <div class="practice-card">
                    <h3>Surya Namaskara</h3>
                    <p>Sun Salutations — a sequence of 12 postures harmonizing body and breath.</p>
                    <a href="surya.html" class="btn">Learn More</a>
                    </div>

                    <!-- Card 5 -->
                    <div class="practice-card">
                    <h3>Yoga Nidra</h3>
                    <p>Guided yogic sleep for deep relaxation and inner awareness.</p>
                    <a href="nidra.html" class="btn">Learn More</a>
                    </div>
                </div>
            </section>

                
            </div>
                    
        
        </div>
        <!--Second Div Ends-->

        <!--Third Div starts -->
        <div class="part-three-div">

        </div>
        <!--Third Div Ends-->

        <!--Fourth Div starts -->
        <div class="part-four-div">
            
            <div class="part-four-main-section">
            </div>

        </div>
        <!--Fourth Div Ends-->

        <!--Fifth Div starts -->
        <div class="part-five-div">

            <div class="part-five-main-section">
            
            </div>

        </div>
        <!--Fifth Div Ends-->

        <!--Sixth Div starts -->
        <div class="part-six-div">

            <div class="part-six-main-section">
            </div>

        </div>
        <!--Six Div Ends-->

        <!--Seven Div starts -->
        <div class="part-seven-div">

        </div>
        <!--Seven Div Ends-->

        <!--Eight Div starts -->

        <div class="part-eight-div">
            
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

    .part-seven-div{
        text-align: center;
    }

    .part-seven-title{
        margin: 15px 0px;
        font-family: 'Great Vibes', cursive;
        font-size: 2.75rem;
        font-weight: 600;
    }

    .part-seven-main-content{
        display:flex;
        flex-direction: row;
        justify-content:center;
        gap: 80px;
    }

    .stat-one, .stat-two{

        width: 300px;
        height: 200px;
        background: radial-gradient(ellipse at center, #a7f3d0 0%, #34d399 100%);
        border-radius: 100% 50% 50% 50% / 100% 70% 30% 30%; /* teardrop-like */
        transform: rotate(0deg);
        padding: 4rem;
        text-align: center;
        font-family: 'Great Vibes', cursive;
        font-weight: 1000;
        font-size: 20px;
        /*color: #ffffff;           white numbers on green bg */
        text-shadow: 0 1px 2px rgba(0,0,0,0.3); /* slight glow for contrast */  
    }

    .part-eight-div{
        margin-top: 40px;
        text-align: center;
        padding: 10px;
        font-size: 1.75rem;
        font-weight: 600;
        color: #000;
        font-family: 'Great Vibes', cursive;
        display: flex;
        justify-content: center; /* horizontal centering */
        align-items: center;     /* vertical centering */
    }

    .part-eight-main-content{
        width: 1200px;
        height: 200px;
        background: radial-gradient(ellipse at center, #a7f3d0 0%, #34d399 100%);
        border-radius: 70% 50% 50% 50% / 70% 70% 30% 30%; /* teardrop-like */
        transform: rotate(0deg);
        padding: 5rem;

    }


    .practice-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.practice-card {
  background: #f9f9f9;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  text-align: center;
  transition: transform 0.2s ease;
}

.practice-card:hover {
  transform: translateY(-5px);
}

.practice-card h3 {
  margin-bottom: 0.5rem;
  color: #333;
}

.practice-card p {
  font-size: 0.9rem;
  color: #666;
  margin-bottom: 1rem;
}

.practice-card .btn {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-size: 0.9rem;
}

.practice-card .btn:hover {
  background: #45a049;
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
