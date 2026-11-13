<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Reportes Generales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto">
            <div class="panel-base overflow-hidden">
                <livewire:reportesgral.index />
            </div>
        </div>
    </div>
</x-app-layout>
