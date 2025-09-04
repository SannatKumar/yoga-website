@props([
    'image_paths' => [],
    'header' => 'header-text',
    'description' => null,
    'steps' => [],
])

<div class="div-three-main-element">
    <div class="text">
        <h2 class="header-class">{{ $header }}</h2>

        @if($description)
            <p>{{ $description }}</p>
        @endif

        <div class="steps-text">
            <ol class="steps">
                @foreach ($steps as $step)
                    <li>
                        <div class="step-number">{{ $loop->iteration }}</div>
                        <div class="step-text">{{ $step }}</div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <div class="step-images">
        <div class="image-container">
        @foreach ($image_paths as $path)
            <img src="{{ $path }}" alt="Asana Step" class="step-image-img">
        @endforeach
        </div>
    </div>
</div>

<style>
/* Main container */
.div-three-main-element {
    display: flex;
    flex-direction: row;
    width: 100%;
    border-radius: 40px;
    border: 2px solid green;
    min-height: 200px;
    overflow: hidden;
    box-sizing: border-box;
    padding: 5px;
    align-items: stretch;
}

/* Text side */
.div-three-main-element .text {
    flex: 0 0 60%;
    padding: 20px;
}

/* Images side */
.div-three-main-element .step-images {
    flex: 0 0 40%;
    padding: 20px;
    align-items: stretch;
}



/* Header */
.header-class {
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
    color: #2c3e50;
}

/* Steps container */
.steps-text {
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #25c55d;
}

/* Steps list */
.steps {
    list-style: none;
    padding-left: 1.5rem;
    margin: 1rem 0;
}

.steps li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    position: relative;
}

/* Step number */
.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #25c55d;
    color: white;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-right: 12px;
    font-size: 1rem;
}

/* Step text */
.step-text {
    flex: 1;
    line-height: 1.5;
}



/* Individual images */
.step-image-img {
    flex: 1;
    max-width: 250px;
    /* height: 100%; */
    border-radius: 12px;
    border: 1px solid #ccc;
    object-fit: cover;
}
.image-container{
    flex: 1; 
    width: 100%;
    height: 25%;
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #25c55d;
    /* margin: 72px 0px 5px 0px;; */

}
</style>
