<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
            {{ __('API Tokens') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-10 lg:px-8">
            @livewire('api.api-token-manager')
        </div>
    </div>
</x-app-layout>
