<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            {{ __('Editar Registro') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-10xl mx-auto">
            <div class="panel-base overflow-hidden">
                <livewire:reportesgral.edit :id="$id" />
            </div>
        </div>
    </div>
</x-app-layout>
