<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-gray-200 leading-tight">
            usuarios
        </h2>
    </x-slot>
    <div class="py-0.5 font-roboto">
                @livewire('people')
    </div>
</x-app-layout>
