<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Grupos de Usuarios') }}
            </h2>
            <a href="{{ route('user-groups.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-1.5 px-3 rounded text-xs">
                Crear Grupo
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('user-groups.index')
        </div>
    </div>
</x-app-layout>
