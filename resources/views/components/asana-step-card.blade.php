@props([
    'header' => 'header-text',
    'description' => null,
    'steps' => [],
    'image_url' => null,
    'image_header' => 'Final Pose',
    'image_alt' => 'Asana final pose',
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
        <h2 class="header-class">{{ $image_header }}</h2>
        <div class="image-container">
            <img src="{{ $image_url ?? '/lotus-images/blank_image.jpg' }}" alt="{{ $image_alt }}" class="step-image-img">
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
    flex: 0 0 50%;
    padding: 20px;
    min-width: 0;
}

/* Images side */
.div-three-main-element .step-images {
    flex: 0 0 50%;
    padding: 20px;
    min-width: 0;
    display: flex;
    flex-direction: column;
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
    padding: 20px;
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



/* Single final-pose image, filling its container without distortion */
.step-image-img {
    width: 100%;
    height: 100%;
    min-height: 280px;
    border-radius: 8px;
    object-fit: cover;
    display: block;
}

.image-container {
    flex: 1;
    width: 100%;
    box-sizing: border-box;
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #25c55d;
}
</style>
