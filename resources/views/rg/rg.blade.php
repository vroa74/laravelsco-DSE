<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            Reportes Generales.
        </h2>
    </x-slot>

    <div class="px-2 py-2 font-roboto sm:px-6 lg:px-8">
        <div class="panel-base overflow-hidden">
            @livewire('reportesgral.index')
        </div>
    </div>
</x-app-layout>
