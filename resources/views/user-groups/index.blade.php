<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
                {{ __('Gestión de Grupos de Usuarios') }}
            </h2>
            <x-icon-action variant="success" icon="fa-solid fa-plus" :href="route('user-groups.create')"
                label="Crear grupo" />
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @livewire('user-groups.index')
        </div>
    </div>
</x-app-layout>
