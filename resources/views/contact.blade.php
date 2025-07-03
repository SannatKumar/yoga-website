@extends('layouts.app')

@section('content')
    <h1>Contact Us</h1>
    <style>
        .form-wrapper {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .contact-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.25rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background: #fff;
            transition: border-color 0.2s;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #6c63ff;
            outline: none;
        }
        .contact-form button {
            background: #6c63ff;
            color: #fff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .contact-form button:hover {
            background: #554ee2;
        }
    </style>
    <div class="form-wrapper">
        <form action="#" method="POST" class="contact-form">
            @csrf
            <label for="name">{{ __('messages.name') }}</label>
            <input type="text" id="name" name="name" required>

            <label for="email">{{ __('messages.email') }}</label>
            <input type="email" id="email" name="email" required>

            <label for="message">{{ __('messages.message') }}</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">{{ __('messages.send-message') }}</button>
        </form>
    </div>
@endsection 