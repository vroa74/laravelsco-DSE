<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Componentes Instalados') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Composer Components -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-4 h-4 bg-amber-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Componentes Composer</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $composerPackages = [
                                // Require (Producción)
                                'barryvdh/laravel-dompdf' => 'Laravel wrapper para DOMPDF - Generador de PDFs',
                                'barryvdh/laravel-snappy' =>
                                    'Laravel wrapper para wkhtmltopdf - Generador de PDFs/Imágenes',
                                'endroid/qr-code' => 'Generador de códigos QR',
                                'laravel-lang/common' => 'Traducciones comunes para Laravel',
                                'laravel/framework' => 'Framework web de PHP',
                                'laravel/jetstream' => 'Kit de autenticación con Livewire/Inertia',
                                'laravel/sanctum' => 'API de autenticación para SPA',
                                'laravel/tinker' => 'REPL de Laravel',
                                'livewire/livewire' => 'Framework full-stack para Laravel',
                                'maatwebsite/excel' => 'Librería para importar/exportar Excel',
                                'wireui/wireui' => 'Componentes UI para Livewire',

                                // Require-dev (Desarrollo)
                                'fakerphp/faker' => 'Generador de datos falsos',
                                'laravel-lang/lang' => 'Traducciones completas para Laravel',
                                'laravel/pail' => 'Log viewer para Laravel',
                                'laravel/pint' => 'Code style fixer para Laravel',
                                'laravel/sail' => 'Docker development environment',
                                'mockery/mockery' => 'Framework de mocking',
                                'nunomaduro/collision' => 'Error handler mejorado',
                                'pestphp/pest' => 'Framework de testing moderno',
                                'pestphp/pest-plugin-laravel' => 'Plugin de Pest para Laravel',
                            ];
                        @endphp

                        @foreach ($composerPackages as $package => $description)
                            <div
                                class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-amber-900 dark:text-amber-100 mb-1">
                                            {{ $package }}
                                        </h4>
                                        <p class="text-xs text-amber-700 dark:text-amber-300">
                                            {{ $description }}
                                        </p>
                                    </div>
                                    <div class="ml-3">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100">
                                            Composer
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Node Components -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Componentes Node.js</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $nodePackages = [
                                // Dependencies (Producción)
                                '@fontsource/arimo' => 'Fuente Arimo de Google Fonts',
                                '@fontsource/roboto' => 'Fuente Roboto de Google Fonts',
                                '@vitejs/plugin-vue' => 'Plugin Vue.js para Vite',
                                'alpinejs' => 'Framework JavaScript ligero',
                                'flowbite' => 'Componentes UI para Tailwind CSS',
                                'vue' => 'Framework JavaScript progresivo',

                                // DevDependencies (Desarrollo)
                                '@tailwindcss/forms' => 'Plugin de formularios para Tailwind',
                                '@tailwindcss/typography' => 'Plugin de tipografía para Tailwind',
                                'autoprefixer' => 'Prefijos CSS automáticos',
                                'axios' => 'Cliente HTTP para JavaScript',
                                'concurrently' => 'Ejecutar múltiples comandos simultáneamente',
                                'laravel-vite-plugin' => 'Plugin de Vite para Laravel',
                                'postcss' => 'Procesador de CSS',
                                'tailwindcss' => 'Framework CSS utilitario',
                                'vite' => 'Build tool moderno',
                            ];
                        @endphp

                        @foreach ($nodePackages as $package => $description)
                            <div
                                class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-green-900 dark:text-green-100 mb-1">
                                            {{ $package }}
                                        </h4>
                                        <p class="text-xs text-green-700 dark:text-green-300">
                                            {{ $description }}
                                        </p>
                                    </div>
                                    <div class="ml-3">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                            Node.js
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-amber-900 dark:text-amber-100">Componentes Composer</h4>
                            <p class="text-2xl font-bold text-amber-800 dark:text-amber-200">
                                {{ count($composerPackages) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-green-900 dark:text-green-100">Componentes Node.js</h4>
                            <p class="text-2xl font-bold text-green-800 dark:text-green-200">{{ count($nodePackages) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="mt-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Total de Componentes</h4>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">
                        {{ count($composerPackages) + count($nodePackages) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ count($composerPackages) }} Composer + {{ count($nodePackages) }} Node.js
                    </p>
                </div>
            </div>

            <!-- Detalles por categoría -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">Producción</h4>
                    <p class="text-lg font-bold text-blue-800 dark:text-blue-200">10 Composer + 6 Node.js</p>
                    <p class="text-xs text-blue-600 dark:text-blue-300 mt-1">Componentes esenciales para el
                        funcionamiento</p>
                </div>

                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-purple-900 dark:text-purple-100 mb-2">Desarrollo</h4>
                    <p class="text-lg font-bold text-purple-800 dark:text-purple-200">9 Composer + 8 Node.js</p>
                    <p class="text-xs text-purple-600 dark:text-purple-300 mt-1">Herramientas de desarrollo y testing
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
