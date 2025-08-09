@extends('layouts.app')

@section('content')
<div class="main-div">
    <div class="welcome-message-div">
        <h1>Currency Converter</h1>
    </div>

    <div class="feature-box">
        <form id="currencyForm">
            <input type="number" id="amount" placeholder="Amount" required>
            <select id="fromCurrency">
                <option value="USD">USD</option>
                <option value="NPR">NPR</option>
            </select>
            <select id="toCurrency">
                <option value="NPR">NPR</option>
                <option value="USD">USD</option>
            </select>
            <button type="submit">Convert</button>
        </form>
        <p id="result"></p>
    </div>
</div>

<script>
document.getElementById('currencyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const amount = document.getElementById('amount').value;
    const from = document.getElementById('fromCurrency').value;
    const to = document.getElementById('toCurrency').value;

    fetch(`https://api.exchangerate.host/convert?from=${from}&to=${to}&amount=${amount}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('result').textContent = `Converted: ${data.result} ${to}`;
        });
});
</script>
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