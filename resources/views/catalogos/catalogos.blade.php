<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
            <span class="block py-1 text-center">Catálogos</span>
        </h2>
    </x-slot>

    <!-- Catálogos en una sola cuadrícula responsiva -->
    <div class="grid grid-cols-1 gap-2 px-2 pt-2 text-white sm:grid-cols-2 sm:px-4 xl:grid-cols-4">
        <div class="flex flex-col items-center space-y-1 rounded-lg border-2 border-blue-950 p-2 text-center">
            @livewire('leg')
        </div>
        <div class="flex flex-col items-center space-y-1 rounded-lg border-2 border-blue-900 p-2 text-center">
            @livewire('nc')
        </div>
        <div class="flex flex-col items-center space-y-1 rounded-lg border-2 border-blue-800 p-2 text-center">
            @livewire('tc')
        </div>
        <div class="flex flex-col items-center space-y-1 rounded-lg border-2 border-blue-700 p-2 text-center">
            @livewire('cc')
        </div>
    </div>

</x-app-layout>
