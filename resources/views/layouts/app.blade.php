<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('media/img/favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            <!-- Font Awesome desde CDN -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="sco-ui font-sans antialiased">
        <x-banner />

        {{-- Fondo institucional: escudo de Campeche en plata, sin letras, centrado, responsivo --}}
        <div class="bg-institucional" aria-hidden="true">
            <div class="bg-institucional__gradient-base"></div>
            <img src="{{ asset('media/img/campechecon.png') }}" alt=""
                class="bg-institucional__shield" />
            <div class="bg-institucional__gradient-overlay"></div>
        </div>

        <div class="relative min-h-screen z-10">
            <!-- Barra superior fija (navegación + encabezado) -->
            <div class="sticky top-0 z-50 bg-transparent">
                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="surface-panel border-b border-primary px-4 sm:px-6 lg:px-8 py-2">
                        <div class="max-w-7xl mx-auto">
                            {{ $header }}
                        </div>
                    </header>
                @endif
            </div>

            <!-- Page Content (Scrollable) -->
            <main class="pb-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>

{{--php artisan optimize:clear--}}
