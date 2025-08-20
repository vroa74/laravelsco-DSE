<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enlaces rápidos -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('catalogos') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg shadow-md transition duration-200">
                    <div class="flex items-center">
                        <i class="fas fa-book text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Catálogos</h3>
                            <p class="text-sm opacity-90">Gestión de catálogos</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('reportgral') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg shadow-md transition duration-200">
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Reportes Generales</h3>
                            <p class="text-sm opacity-90">Sistema de reportes</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('usuarios') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg shadow-md transition duration-200">
                    <div class="flex items-center">
                        <i class="fas fa-users text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Usuarios</h3>
                            <p class="text-sm opacity-90">Gestión de usuarios</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('user-groups.index') }}" 
                   class="bg-orange-600 hover:bg-orange-700 text-white p-4 rounded-lg shadow-md transition duration-200">
                    <div class="flex items-center">
                        <i class="fas fa-user-friends text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Grupos de Usuarios</h3>
                            <p class="text-sm opacity-90">Gestión de grupos</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        </h2>
    </x-slot>


</x-app-layout>
