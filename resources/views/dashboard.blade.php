<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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
