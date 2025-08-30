@props([
    'image_path' => '/lotus-images/yellow_lotus.svg',
    'text' => '',
    'description' => null,
])
<div class="welcome-block">
    
    <img src="/lotus-images/sun.svg" alt="Welcome Icon" class="sun-image">
    <div class="middle-section">
        <a href="{{ route('lotus-page', ['lang' => app()->getLocale()]) }}">
            <img src="{{$image_path}}" alt="Welcome Icon" class="lotus-image">
        </a>
        <h1 class="welcome-text">
            {{$text}}
        </h1>
    </div>
    <img src="/lotus-images/moon.svg" alt="Welcome Icon" class="moon-image">
    
</div>
<style>
.welcome-block {
        background: #1B4D3F;
        border-left: 6px solid #22c55e;
        border-right: 6px solid #3B82F5;
        border-radius: 0 0 16px 16px;
        color: #fff;
        display: flex;
        flex-direction: row;
        align-items: center;
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
    .sun-image,
.moon-image {
    flex: 0 0 60px;  /* lock each image at 60px width */
    height: 60px;    /* scale height to match */
    object-fit: contain;
    /* margin-top: 25px; */
}

.middle-section {
    flex: 1;                 /* take up all remaining space */
    display: flex;
    flex-direction: column;
    align-items: center;     /* center inside */
    justify-content: center;
    padding: 0 0.5rem;       /* spacing from the sides */
}

    .welcome-text{
        font-weight: 600;       
        font-size: 1.5rem;      
        line-height: 60px;    
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
    .welcome-block {
        color: #fff;
        display: flex;
        flex-direction: column;
        margin: 0rem auto;
        max-width: 100%;
    }

    .welcome-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .welcome-block h1 {
        font-family: 'Georgia', serif;
        font-size: 25px;
        color: white;
        -webkit-background-clip: text;
    }

    .lotus-image{
        margin-left: auto;   
        margin-right: auto;
        margin-bottom: 0;
        margin-top: 0;    
        width: 12rem;        
        height: 60px;  
    }

    .welcome-text{
        font-weight: 1000;       
        font-size: 1.5rem;      
        line-height: 60px;    
    }

}

@media (max-width: 575.98px) {
        .welcome-block {
        color: #fff;
        display: flex;
        flex-direction: column;
        margin: 0.25rem auto;
        max-width: 100%;
    }

    .welcome-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .welcome-block h1 {
        font-family: 'Georgia', serif;
        font-size: 15px;
        color: white;
        -webkit-background-clip: text;
    }

    .lotus-image{
        padding: 0;
        margin-left: auto;   
        margin-right: auto;
        margin-bottom: 0;
        margin-top: 0;    
        width: 12rem;        
        height: 30px;  
    }

    .welcome-text{
        font-weight: 1000;       
        font-size: 1.5rem;      
        line-height: 10px;    
    }

}
</style>
