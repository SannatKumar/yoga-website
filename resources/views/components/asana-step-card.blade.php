@props([
    'image_path' => '/lotus-images/yellow_lotus.svg',
    'header' => 'header-text',
    'description' => null,
])
<div class="div-three-main-element">
    <div class="text">
        <h2 class="header-class"> Step 1</h2>
        <p> First {{$header}} </p>
        <p> Focus on your breath.</p>
    </div>
    <div class="step-image">
        <img src="{{$image_path}}" alt="Asana Large" class="step-image-img">
    </div>
</div>
<style>
    .div-three-main-element {
        display: flex;
        max-height: 300px;
        min-width: 100%;
        border-radius: 40px;
        border: 2px solid green;
        min-height: 200px;
        overflow: hidden;
        /* keeps things neat */
        flex: 0 0 40%;
        /* takes up 60% width */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* 
/* text side */
.div-three-main-element .text {
  flex: 0 0 60%;   
  padding: 20px;
  box-sizing: border-box;
} 



.step-image {
  max-width: 100%;
  max-height: 20%;
  background-color: #000;

  border-radius: 0 10px 10px 0;
}
</style>
