<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
            Ver Registro #{{ $co->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Información General</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Folio</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->id }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Legislatura</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->legislatura }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Captura</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->fcap ? date('d/m/Y', strtotime($co->fcap)) : 'No especificada' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Recepción</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->frec ? date('d/m/Y', strtotime($co->frec)) : 'No especificada' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Oficio</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->fofi ? date('d/m/Y', strtotime($co->fofi)) : 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Información del Remitente</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->rem_nombre }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->rem_cargo ?: 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dependencia/Organismo</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->rem_deporg ?: 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $co->rem_dir ?: 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Descripción</h3>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $co->des }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Seguimiento</h3>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $co->seguimiento ?: 'No especificado' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('rg.index') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Volver
                    </a>
                    <a href="{{ route('rg.edit', $co->id) }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 