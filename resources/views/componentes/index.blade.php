<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            {{ __('Componentes Instalados') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Composer Components -->
            <div class="panel-base overflow-hidden mb-6">
                <div class="p-6 text-primary">
                    <div class="flex items-center mb-4">
                        <div class="w-4 h-4 bg-amber-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-semibold text-primary">Componentes Composer</h3>
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
                                class="bg-transparent border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0 break-words">
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
            <div class="panel-base overflow-hidden">
                <div class="p-6 text-primary">
                    <div class="flex items-center mb-4">
                        <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-semibold text-primary">Componentes Node.js</h3>
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
                                class="bg-transparent border border-green-200 dark:border-green-800 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0 break-words">
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

            @php
                $bladeComponents = [
                    'x-action-message' => 'Mensaje de confirmación de acciones',
                    'x-action-section' => 'Sección de acciones del perfil',
                    'x-app-layout' => 'Diseño principal autenticado',
                    'x-application-logo' => 'Logotipo de la aplicación',
                    'x-application-mark' => 'Marca de la aplicación para navegación',
                    'x-authentication-card' => 'Contenedor de pantallas de autenticación',
                    'x-authentication-card-logo' => 'Logotipo en pantallas de autenticación',
                    'x-banner' => 'Avisos de sesión',
                    'x-button' => 'Botón principal',
                    'x-checkbox' => 'Casilla de verificación',
                    'x-confirmation-modal' => 'Modal de confirmación',
                    'x-confirms-password' => 'Confirmación de contraseña',
                    'x-danger-button' => 'Botón de acción peligrosa',
                    'x-dialog-modal' => 'Modal de diálogo',
                    'x-dropdown' => 'Menú desplegable',
                    'x-dropdown-link' => 'Enlace de menú desplegable',
                    'x-form-section' => 'Sección de formulario',
                    'x-guest-layout' => 'Diseño para visitantes',
                    'x-icon-action' => 'Botón o enlace de acción solo con icono y tooltip accesible',
                    'x-input' => 'Campo de entrada',
                    'x-input-error' => 'Error de validación de campo',
                    'x-label' => 'Etiqueta de formulario',
                    'x-modal' => 'Contenedor modal',
                    'x-nav-link' => 'Enlace de navegación',
                    'x-password-toggle-button' => 'Botón para mostrar u ocultar contraseña',
                    'x-responsive-nav-link' => 'Enlace de navegación adaptable',
                    'x-secondary-button' => 'Botón secundario',
                    'x-section-border' => 'Separador de sección',
                    'x-section-title' => 'Título y descripción de sección',
                    'x-switchable-team' => 'Selector de equipo',
                    'x-validation-errors' => 'Resumen de errores de validación',
                    'x-welcome' => 'Componente de bienvenida',
                ];

                $livewireComponents = [
                    'App\\Livewire\\Cc',
                    'App\\Livewire\\Catalogo\\Cc',
                    'App\\Livewire\\Catalogo\\Nc',
                    'App\\Livewire\\Catalogo\\Tc',
                    'App\\Livewire\\FileManager',
                    'App\\Livewire\\Leg',
                    'App\\Livewire\\NavigationMenu',
                    'App\\Livewire\\Nc',
                    'App\\Livewire\\People',
                    'App\\Livewire\\Profile\\UpdateProfileInformationForm',
                    'App\\Livewire\\Reportesgral\\Create',
                    'App\\Livewire\\Reportesgral\\Edit',
                    'App\\Livewire\\Reportesgral\\Index',
                    'App\\Livewire\\Reportesgral\\Show',
                    'App\\Livewire\\Tc',
                    'App\\Livewire\\Temp',
                    'App\\Livewire\\UserGroups\\Index',
                    'App\\Livewire\\Usuarios\\Create',
                    'App\\Livewire\\Usuarios\\Edit',
                    'App\\Livewire\\Usuarios\\Index',
                    'App\\Livewire\\Usuarios\\Show',
                ];

                $frontendIntegrations = [
                    ['nombre' => 'Alpine.js', 'uso' => 'Interacciones reactivas; importado desde resources/js/app.js.'],
                    ['nombre' => 'Axios', 'uso' => 'Solicitudes HTTP; importado desde resources/js/bootstrap.js.'],
                    ['nombre' => 'Flowbite', 'uso' => 'Componentes y plugin de Tailwind; CSS npm y JavaScript CDN.'],
                    ['nombre' => 'Font Awesome 6.0.0', 'uso' => 'Iconos; hoja de estilos CDN en layouts/app.blade.php y layouts/guest.blade.php.'],
                    ['nombre' => 'SweetAlert2 11', 'uso' => 'Alertas; JavaScript CDN en los diseños de aplicación y visitante.'],
                    ['nombre' => 'Tailwind CSS', 'uso' => 'Estilos utilitarios; plugins Forms, Typography y Flowbite.'],
                    ['nombre' => 'Vite', 'uso' => 'Compila resources/css/app.css y resources/js/app.js.'],
                    ['nombre' => 'Vue.js', 'uso' => 'Dependencia instalada junto con @vitejs/plugin-vue; no se importa en app.js.'],
                    ['nombre' => 'Roboto', 'uso' => 'Fuente principal; Google Fonts y @fontsource/roboto.'],
                    ['nombre' => 'Arimo', 'uso' => 'Fuente empaquetada con @fontsource/arimo.'],
                    ['nombre' => 'Figtree', 'uso' => 'Google Fonts Bunny; cargada en las vistas de bienvenida y visitante.'],
                ];

                $fontAwesomeIcons = [
                    'fa-download', 'fa-eye', 'fa-eye-slash', 'fa-file-pdf', 'fa-plus', 'fa-trash', 'fa-user', 'fa-users',
                    'fa-regular fa-eye', 'fa-regular fa-house', 'fa-regular fa-rectangle-list', 'fa-regular fa-square-plus',
                    'fa-solid fa-arrow-left', 'fa-solid fa-bars', 'fa-solid fa-check', 'fa-solid fa-download',
                    'fa-solid fa-eraser', 'fa-solid fa-eye', 'fa-solid fa-file-csv', 'fa-solid fa-file-export',
                    'fa-solid fa-file-pdf', 'fa-solid fa-filter', 'fa-solid fa-floppy-disk', 'fa-solid fa-house',
                    'fa-solid fa-igloo', 'fa-solid fa-image', 'fa-solid fa-key', 'fa-solid fa-list',
                    'fa-solid fa-paper-plane', 'fa-solid fa-pen-to-square', 'fa-solid fa-pencil', 'fa-solid fa-plus',
                    'fa-solid fa-right-from-bracket', 'fa-solid fa-right-to-bracket', 'fa-solid fa-save',
                    'fa-solid fa-shield-halved', 'fa-solid fa-sliders', 'fa-solid fa-times', 'fa-solid fa-trash',
                    'fa-solid fa-trash-can', 'fa-solid fa-upload', 'fa-solid fa-user', 'fa-solid fa-user-pen',
                    'fa-solid fa-user-plus', 'fa-solid fa-users', 'fa-solid fa-xmark',
                ];

                $inlineSvgViews = [
                    'auth/login.blade.php',
                    'comp.blade.php',
                    'components/application-mark.blade.php',
                    'components/authentication-card-logo.blade.php',
                    'components/banner.blade.php',
                    'components/confirmation-modal.blade.php',
                    'components/password-toggle-button.blade.php',
                    'components/switchable-team.blade.php',
                    'components/welcome.blade.php',
                    'layouts/_navbar.blade.php',
                    'layouts/navbar.blade.php',
                    'livewire/navigation-menu.blade.php',
                    'livewire/people.blade.php',
                    'livewire/reportesgral/create.blade.php',
                    'livewire/reportesgral/edit.blade.php',
                    'livewire/reportesgral/index.blade.php',
                    'livewire/rg/index.blade.php',
                    'livewire/user-groups/index.blade.php',
                    'livewire/usuarios/index.blade.php',
                    'navigation-menu.blade.php',
                    'profile/logout-other-browser-sessions-form.blade.php',
                    'temp.blade.php',
                    'user-groups/show.blade.php',
                    'welcome.blade.php',
                ];
            @endphp

            <div class="panel-base overflow-hidden mt-6">
                <div class="p-6 text-primary">
                    <h3 class="text-lg font-semibold mb-4">Componentes Blade propios y Jetstream</h3>
                    <p class="text-sm text-secondary mb-4">
                        {{ count($bladeComponents) }} componentes disponibles en resources/views/components y los diseños de la aplicación.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($bladeComponents as $component => $description)
                            <div class="rounded border border-gray-200 dark:border-gray-700 p-3">
                                <code class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">{{ $component }}</code>
                                <p class="text-xs text-secondary mt-1">{{ $description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel-base overflow-hidden mt-6">
                <div class="p-6 text-primary">
                    <h3 class="text-lg font-semibold mb-4">Componentes Livewire</h3>
                    <p class="text-sm text-secondary mb-4">
                        {{ count($livewireComponents) }} clases encontradas en app/Livewire.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($livewireComponents as $component)
                            <code class="rounded border border-gray-200 dark:border-gray-700 p-3 text-xs text-indigo-700 dark:text-indigo-300">{{ $component }}</code>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel-base overflow-hidden mt-6">
                <div class="p-6 text-primary">
                    <h3 class="text-lg font-semibold mb-4">Plugins e integraciones de interfaz</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($frontendIntegrations as $integration)
                            <div class="rounded border border-gray-200 dark:border-gray-700 p-3">
                                <h4 class="text-sm font-semibold">{{ $integration['nombre'] }}</h4>
                                <p class="text-xs text-secondary mt-1">{{ $integration['uso'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel-base overflow-hidden mt-6">
                <div class="p-6 text-primary">
                    <h3 class="text-lg font-semibold mb-2">Iconos Font Awesome encontrados</h3>
                    <p class="text-sm text-secondary mb-4">
                        {{ count($fontAwesomeIcons) }} clases o combinaciones encontradas en las vistas Blade.
                        Las clases sin prefijo de estilo se muestran tal como están escritas en el código.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($fontAwesomeIcons as $icon)
                            <code class="rounded bg-transparent px-3 py-2 text-xs">{{ $icon }}</code>
                        @endforeach
                    </div>
                    <h4 class="font-semibold mt-6 mb-2">Iconos y gráficos SVG en línea</h4>
                    <p class="text-sm text-secondary mb-3">
                        No dependen de un plugin de iconos; están dibujados directamente en estas vistas:
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                        @foreach ($inlineSvgViews as $view)
                            <code class="rounded border border-gray-200 dark:border-gray-700 px-3 py-2 text-xs">{{ $view }}</code>
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
                            <p class="text-2xl font-bold text-green-800 dark:text-green-200">{{ count($nodePackages) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="mt-6 bg-transparent rounded-lg p-4">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-primary mb-2">Total de paquetes directos</h4>
                    <p class="text-3xl font-bold text-primary">
                        {{ count($composerPackages) + count($nodePackages) }}
                    </p>
                    <p class="text-sm text-secondary mt-1">
                        {{ count($composerPackages) }} Composer + {{ count($nodePackages) }} Node.js
                    </p>
                </div>
            </div>

            <!-- Detalles por categoría -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">Producción</h4>
                    <p class="text-lg font-bold text-blue-800 dark:text-blue-200">11 Composer + 6 Node.js</p>
                    <p class="text-xs text-blue-600 dark:text-blue-300 mt-1">Componentes esenciales para el
                        funcionamiento</p>
                </div>

                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-purple-900 dark:text-purple-100 mb-2">Desarrollo</h4>
                    <p class="text-lg font-bold text-purple-800 dark:text-purple-200">9 Composer + 9 Node.js</p>
                    <p class="text-xs text-purple-600 dark:text-purple-300 mt-1">Herramientas de desarrollo y testing
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
