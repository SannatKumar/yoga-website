@extends('layouts.app')

@section('content')
<div class="main-div">
    <div class="welcome-message-div">
        <h1>Cover Letter Builder</h1>
    </div>

    <div class="feature-box">
        <form method="POST" action="{{ route('cover-letter',['lang' => app()->getLocale()]) }}">
            @csrf
            <label>Your Name:</label>
            <input type="text" name="name" required><br>
            <label>Position:</label>
            <input type="text" name="position" required><br>
            <label>Company:</label>
            <input type="text" name="company" required><br>
            <button type="submit">Generate Cover Letter</button>
        </form>
    </div>
</div>
@endsection

<style>
    /* General Layout */
.main-div {
    background-image: linear-gradient(to bottom right, #f0fdf4, #eff6ff);
    width: 60%;
    display: flex;
    flex-direction: column;
    margin: auto;
    padding: 1rem;
}

.welcome-message-div, 
.question-answer-div, 
.feature-box {
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

/* Specific Sections */
.welcome-message-div {
    background: #1B4D3F;
    color: #fff;
    text-align: center;
}

.welcome-message-div h1 {
    font-family: 'Georgia', serif;
}

.question-answer-div {
    background-color: #dbeafe;
}

.feature-box {
    background: #fff;
}

/* Responsive */
@media (max-width: 767.98px) {
    .main-div {
        width: 100%;
    }
}
</style>
