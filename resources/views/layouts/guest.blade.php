<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light">
        <div class="mb-4">
            <a href="/">
                <img src="{{ asset('logo.png') }}" class="img-fluid" alt="Logo" style="width: 80px; height: 80px;">
            </a>
        </div>

        <div class="w-100 bg-white shadow rounded p-4" style="max-width: 400px;">
            @yield('content')
        </div>
    </div>
</body>
</html>
