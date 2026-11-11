<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:usuarios.index />
            </div>
        </div>
    </div>
</x-app-layout>
