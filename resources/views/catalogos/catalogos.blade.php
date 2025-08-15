<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="text-center py-2">
                <span id="header-desktop-text" class="hidden"> <i class="fa-solid fa-desktop"></i> </span>
                <span id="header-mobile-text" class="hidden"> <i class="fa-solid fa-mobile-screen"></i> </span>
                Catalogos  
            </div>
        </h2>
    </x-slot>

    <!-- Detección de dispositivo -->
    <div id="device-info" class="text-center py-2">
        <p id="desktop-text" class="hidden text-lg font-semibold text-blue-600">DESKTOP</p>
        <p id="mobile-text" class="hidden text-lg font-semibold text-green-600">MOBILE</p>
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
        // Función para detectar si es dispositivo móvil
        function detectDevice() {
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || 
                            window.innerWidth <= 768;
            
            console.log('Detectando dispositivo...', { isMobile, userAgent: navigator.userAgent, width: window.innerWidth });
            
            // Elementos del header
            const headerDesktopText = document.getElementById('header-desktop-text');
            const headerMobileText = document.getElementById('header-mobile-text');
            
            // Elementos del contenido
            const desktopText = document.getElementById('desktop-text');
            const mobileText = document.getElementById('mobile-text');
            const desktopGrid = document.getElementById('desktop-grid');
            const mobileGrid = document.getElementById('mobile-grid');
            
            if (isMobile) {
                console.log('Dispositivo móvil detectado - Mostrando layout móvil');
                
                // Mostrar icono móvil en header
                if (headerMobileText) headerMobileText.classList.remove('hidden');
                if (headerDesktopText) headerDesktopText.classList.add('hidden');
                
                // Mostrar texto y grid móvil
                if (mobileText) mobileText.classList.remove('hidden');
                if (desktopText) desktopText.classList.add('hidden');
                if (mobileGrid) mobileGrid.classList.remove('hidden');
                if (desktopGrid) desktopGrid.classList.add('hidden');
            } else {
                console.log('Dispositivo desktop detectado - Mostrando layout desktop');
                
                // Mostrar icono desktop en header
                if (headerDesktopText) headerDesktopText.classList.remove('hidden');
                if (headerMobileText) headerMobileText.classList.add('hidden');
                
                // Mostrar texto y grid desktop
                if (desktopText) desktopText.classList.remove('hidden');
                if (mobileText) mobileText.classList.add('hidden');
                if (desktopGrid) desktopGrid.classList.remove('hidden');
                if (mobileGrid) mobileGrid.classList.add('hidden');
            }
        }
        
        // Detectar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado, detectando dispositivo...');
            detectDevice();
        });
        
        // Detectar cuando cambie el tamaño de la ventana
        window.addEventListener('resize', function() {
            console.log('Ventana redimensionada, detectando dispositivo...');
            detectDevice();
        });
        
        // Detectar también al cargar la página (fallback)
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', detectDevice);
        } else {
            detectDevice();
        }
    </script>

</x-app-layout>
