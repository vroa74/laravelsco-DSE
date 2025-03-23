<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Oficialia de partes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* ! tailwindcss v3.4.1 | Solución personalizada para evitar desbordamientos */
            html, body {
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }
            img {
                max-width: 100%;
                height: auto;
            }
            .no-scroll {
                overflow-x: hidden;
            }
        </style>
    @endif
</head>
<body class="font-sans antialiased dark:bg-black text-white no-scroll">
<div class="bg-gray-950 text-black/50 dark:bg-black dark:text-white/50">
    <!-- Ajustamos la imagen de fondo -->
    <img id="background" class="absolute left-0 top-0 w-[50%] opacity-10 object-cover" src="{{ asset('media/img/background.png') }}" alt="Laravel background" />

    @include('layouts.navbar')

    <div class="container mx-auto mt-4 pt-16">
        @yield('content')
    </div>

    <div class="container mx-auto mt-4">
        @include('layouts.footer')
    </div>
</div>
</body>
</html>
