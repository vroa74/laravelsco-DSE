<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Gestión de Personal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="panel-base overflow-hidden">
                <livewire:usuarios.index />
            </div>
        </div>
    </div>
</x-app-layout>
