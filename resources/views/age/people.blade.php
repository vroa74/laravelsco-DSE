<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
            usuarios
        </h2>
    </x-slot>
    <div class="px-2 py-2 font-roboto sm:px-6 lg:px-8">
                @livewire('people')
    </div>
</x-app-layout>
