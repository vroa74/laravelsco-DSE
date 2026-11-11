<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome desde CDN -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="relative min-h-screen bg-slate-950 text-white">
        {{-- Fondo institucional: escudo del Estado de Campeche con degradado al 80% --}}
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden" aria-hidden="true">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-950 via-slate-950 to-black"></div>
            <img src="{{ asset('media/img/ple_legis_65.png') }}" alt=""
                class="absolute left-1/2 top-1/2 w-[min(92vw,780px)] max-w-none -translate-x-1/2 -translate-y-1/2 opacity-80 mix-blend-screen select-none" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-slate-950/20"></div>
        </div>

        <div class="relative z-10 font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
