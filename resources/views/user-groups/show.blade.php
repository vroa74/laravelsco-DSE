<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del Grupo') }}: {{ $userGroup->name }}
        </h2>
            <div class="flex space-x-2">
                <a href="{{ route('user-groups.edit', $userGroup) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-1.5 px-3 rounded text-xs">
                    Editar
                </a>
                <a href="{{ route('user-groups.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-medium py-1.5 px-3 rounded text-xs">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Información del grupo -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900 dark:text-gray-100">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">
                            Información del Grupo
                        </h3>

                        <div class="space-y-3">
                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300">Nombre:</label>
                                <p class="mt-1 text-xs text-gray-900 dark:text-white">{{ $userGroup->name }}</p>
                                    </div>

                            @if ($userGroup->description)
                                    <div>
                                    <label
                                        class="block text-xs font-medium text-gray-700 dark:text-gray-300">Descripción:</label>
                                    <p class="mt-1 text-xs text-gray-900 dark:text-white">{{ $userGroup->description }}
                                    </p>
                                    </div>
                            @endif

                                    <div>
                                <label
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300">Estado:</label>
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $userGroup->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                    {{ $userGroup->active ? 'Activo' : 'Inactivo' }}
                                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Creado
                                    por:</label>
                                <p class="mt-1 text-xs text-gray-900 dark:text-white">
                                    {{ $userGroup->creator->name ?? 'N/A' }}</p>
                                    </div>

                                    <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Fecha de
                                    creación:</label>
                                <p class="mt-1 text-xs text-gray-900 dark:text-white">
                                    {{ $userGroup->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            </div>
                        </div>
                    </div>

                <!-- Miembros del grupo -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                Miembros del Grupo
                            </h3>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                {{ $userGroup->members_count }} miembros
                            </span>
                        </div>

                        @if ($userGroup->members->count() > 0)
                            <div class="space-y-2">
                                @foreach ($userGroup->members as $member)
                                    <div
                                        class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <div class="flex-shrink-0">
                                                @if ($member->profile_photo_path)
                                                    <img class="h-6 w-6 rounded-full"
                                                        src="{{ asset('storage/' . $member->profile_photo_path) }}"
                                                        alt="{{ $member->name }}">
                                                @else
                                                    <div
                                                        class="h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center">
                                                        <span class="text-gray-600 text-xs font-medium">
                                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-xs font-medium text-gray-900 dark:text-white">
                                                    {{ $member->name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $member->email }}</div>
                                                    </div>
                                                    </div>
                                                    </div>
                                        @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <h3 class="mt-2 text-xs font-medium text-gray-900 dark:text-white">No hay miembros</h3>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Este grupo no tiene miembros
                                    asignados.</p>
                            </div>
                        @endif
                    </div>
                    </div>

                <!-- Estadísticas de Archivos -->
                @if(isset($filesStats))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                Archivos Asociados
                            </h3>
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>

                        <div class="space-y-3">
                            <div class="grid grid-cols-3 gap-2">
                                <div class="bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-2 text-center">
                                    <p class="text-xs font-semibold text-green-800 dark:text-green-200">Activos</p>
                                    <p class="text-lg font-bold text-green-900 dark:text-green-100">{{ $filesStats['active'] }}</p>
                                </div>
                                <div class="bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-2 text-center">
                                    <p class="text-xs font-semibold text-red-800 dark:text-red-200">Expirados</p>
                                    <p class="text-lg font-bold text-red-900 dark:text-red-100">{{ $filesStats['expired'] }}</p>
                                </div>
                                <div class="bg-blue-100 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-2 text-center">
                                    <p class="text-xs font-semibold text-blue-800 dark:text-blue-200">Total</p>
                                    <p class="text-lg font-bold text-blue-900 dark:text-blue-100">{{ $filesStats['total'] }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3">
                                <div class="flex items-start">
                                    <svg class="h-4 w-4 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-yellow-800 dark:text-yellow-200">
                                            Eliminación Automática
                                        </p>
                                        <p class="text-xs text-yellow-700 dark:text-yellow-300 mt-1">
                                            Los archivos se eliminan automáticamente después de 10 días naturales.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if(isset($documentsWithFiles) && $documentsWithFiles->count() > 0)
                            <div>
                                <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Documentos con Archivos Activos ({{ $documentsWithFiles->count() }})
                                </h4>
                                <div class="space-y-1 max-h-32 overflow-y-auto">
                                    @foreach($documentsWithFiles as $document)
                                        <div class="flex justify-between items-center p-1.5 bg-gray-50 dark:bg-gray-700 rounded text-xs">
                                            <span class="text-gray-900 dark:text-white truncate">
                                                {{ $document->des ?? 'Sin descripción' }}
                                            </span>
                                            <span class="text-blue-600 dark:text-blue-400 font-medium">
                                                {{ $document->files->count() }} archivos
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
