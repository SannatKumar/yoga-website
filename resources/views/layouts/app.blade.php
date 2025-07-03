<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yoga Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            min-height: 100vh;
            box-sizing: border-box;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .main-content {
            flex: 1 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 3.5rem;
        }
        @media (max-width: 900px) {
            .main-content {
                padding: 0 0.5rem 1.2rem 0.5rem;
            }
        }
        @media (max-width: 600px) {
            .main-content {
                padding-bottom: 0.7rem;
            }
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
    <div class="main-content">
        @include('layouts.header')
        <main class="w-full flex-1 flex flex-col items-center">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
</body>
</html> 