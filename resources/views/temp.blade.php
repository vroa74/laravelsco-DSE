<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">--}}


{{----------------------------------------------------------------------------------------------------------------------------------------------}}
        @livewire('temp')
                <!-- Modal toggle -->
                <button data-modal-target="static-modal1"
                        data-modal-toggle="static-modal1"
                        class="block text-white bg-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-1 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                    Insertar Usuario
                </button>

                <!-- Main modal -->
                <div id="static-modal1"
                     data-modal-backdrop="static"
                     tabindex="-1"
                     aria-hidden="true"
                     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
                    <div class="relative w-full max-w-7xl p-4 h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-3 border-b rounded-t dark:border-gray-600">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    Nuevo Usuario.
                                </h4>
                                <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="static-modal1">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6 ">
                                <form wire:submit.prevent="saveEntry" class="space-y-4">
                                    <div class="grid grid-cols-2 gap-4  ">
                                        <div class="p-4 bg-gray-800 rounded shadow">
                                            <div>
                                                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                                                <input type="text" id="titulo" wire:model="titulo" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="apaterno" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido Paterno</label>
                                                <input type="text" id="apaterno" wire:model="apaterno" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="cargo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                                                <input type="text" id="cargo" wire:model="cargo" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                                                <input type="text" id="telefono" wire:model="telefono" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>

                                        </div>
{{-----------------------------------------------------------------------------------------------------------------------------------                                        --}}
                                        <div class="p-4  bg-gray-800 rounded shadow">
                                            <div>
                                                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                                <input type="text" id="nombre" wire:model="nombre" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="amaterno" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido Materno</label>
                                                <input type="text" id="amaterno" wire:model="amaterno" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="deporg" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departamento</label>
                                                <input type="text" id="deporg" wire:model="deporg" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                                <input type="email" id="email" wire:model="email" class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 gap-0  ">
{{-----------------------------------------------------------------------------------------------------------------------------------                                        --}}
                                        <div class="p-4  bg-gray-800 rounded shadow">
                                            <div>
                                                <label for="dir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                                                <textarea
                                                    id="dir"
                                                    wire:model="dir"
                                                    class="block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                                                    spellcheck="true"
                                                    placeholder="Escribe aquí...">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="text" id="modifico" wire:model="modifico" class="hidden block w-full mt-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                    </div>
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Save
                                </button>
                                <button data-modal-hide="static-modal1" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>





{{--            </div>--}}
{{--        </div>--}}
    </div>
</x-app-layout>
