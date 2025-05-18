<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
             Editar
{{--            {{ __('Dashboard') }}--}}
        </h2>
    </x-slot>

    @livewire('edit')

</x-app-layout>
