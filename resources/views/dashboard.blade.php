<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="mx-auto max-w-7xl">
            <div class="panel-base overflow-hidden">
                <x-welcome />
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-primary leading-tight">

        </h2>
    </x-slot>


</x-app-layout>
