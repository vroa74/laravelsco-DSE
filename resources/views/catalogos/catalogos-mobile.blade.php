<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catálogos - Versión Móvil
        </h2>
    </x-slot>

    <div class="py-4 px-4">
        <!-- Componente Legislatura -->
        <div class="mb-6 p-4 bg-gray-900 rounded-lg border border-red-950">
            @livewire('m-leg')
        </div>

        <!-- Componente N. Cor. -->
        <div class="mb-6 p-4 bg-gray-900 rounded-lg border border-red-900">
            @livewire('m-nc')
        </div>

        <!-- Componente T. Cor. -->
        <div class="mb-6 p-4 bg-gray-900 rounded-lg border border-red-800">
            @livewire('m-tc')
        </div>

        <!-- Componente Clas. Cor. -->
        <div class="mb-6 p-4 bg-gray-900 rounded-lg border border-red-700">
            @livewire('m-cc')
        </div>
    </div>
</x-app-layout>
