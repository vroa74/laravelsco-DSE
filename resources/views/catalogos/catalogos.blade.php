<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="text-center py-2">
                <span id="header-desktop-text" class="hidden"> 🖥️ </span>
                <span id="header-mobile-text" class="hidden"> 📱 </span>
                 Catalogos  
            </div>
        </h2>
    </x-slot>

    <!-- Detección de dispositivo -->
    <div id="device-info" class="text-center py-2">
        <p id="desktop-text" class="hidden text-lg font-semibold text-blue-600"></p>
        <p id="mobile-text" class="hidden text-lg font-semibold text-green-600"></p>
    </div>

    <!-- Versión DESKTOP - Grid horizontal 4 columnas -->
    <div id="desktop-grid" class="hidden grid grid-cols-4 pt-4 gap-1 w-full h-full px-4 text-white">
        <div class="border-2 border-blue-950 rounded-lg p-1 items-center flex flex-col text-center space-y-1">
            @livewire('leg')    
        </div>
        <div class="border-2 border-blue-900 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
            @livewire('nc')
        </div>
        <div class="border-2 border-blue-800 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
            @livewire('tc')
        </div>
        <div class="border-2 border-blue-700 rounded-lg p-1 text-center items-center flex flex-col space-y-1">
            @livewire('cc')
        </div>
    </div>

    <!-- Versión MOBILE - Grid vertical 1 columna -->
    <div id="mobile-grid" class="hidden grid grid-cols-1 pt-4 gap-3 w-full h-full px-4 text-white">
        <div class="border-2 border-red-950 rounded-lg p-3 items-center flex flex-col text-center space-y-2">
            @livewire('leg')    
        </div>
        <div class="border-2 border-red-900 rounded-lg p-3 text-center flex flex-col items-center space-y-2">
            @livewire('nc')
        </div>
        <div class="border-2 border-red-800 rounded-lg p-3 text-center flex flex-col items-center space-y-2">
            @livewire('tc')
        </div>
        <div class="border-2 border-red-700 rounded-lg p-3 text-center items-center flex flex-col space-y-2">
            @livewire('cc')
        </div>
    </div>

    <script>
        // Función simple y directa para detectar dispositivo
        function detectDevice() {
            // Detectar si es móvil
            const isMobile = window.innerWidth <= 768 || 
                            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            
            if (isMobile) {
                // Mostrar icono móvil en header
                document.getElementById('header-mobile-text').classList.remove('hidden');
                document.getElementById('header-desktop-text').classList.add('hidden');
                
                // Mostrar contenido móvil
                document.getElementById('mobile-text').classList.remove('hidden');
                document.getElementById('desktop-text').classList.add('hidden');
                document.getElementById('mobile-grid').classList.remove('hidden');
                document.getElementById('desktop-grid').classList.add('hidden');
            } else {
                // Mostrar icono desktop en header
                document.getElementById('header-desktop-text').classList.remove('hidden');
                document.getElementById('header-mobile-text').classList.add('hidden');
                
                // Mostrar contenido desktop
                document.getElementById('desktop-text').classList.remove('hidden');
                document.getElementById('mobile-text').classList.add('hidden');
                document.getElementById('desktop-grid').classList.remove('hidden');
                document.getElementById('mobile-grid').classList.add('hidden');
            }
        }
        
        // Ejecutar cuando el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', detectDevice);
        } else {
            detectDevice();
        }
        
        // Ejecutar también al cargar la ventana
        window.addEventListener('load', detectDevice);
        
        // Ejecutar cuando cambie el tamaño
        window.addEventListener('resize', detectDevice);
    </script>

</x-app-layout>
