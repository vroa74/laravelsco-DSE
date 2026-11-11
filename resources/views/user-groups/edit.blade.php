<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight sm:text-lg">
                {{ __('Editar Grupo de Usuarios') }}
            </h2>
            <x-icon-action variant="neutral" icon="fa-solid fa-arrow-left" :href="route('user-groups.index')"
                label="Volver al listado" />
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('user-groups.update', $userGroup) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <!-- Nombre del grupo -->
                            <div>
                                <label for="name"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300">
                                    Nombre del Grupo <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $userGroup->name) }}" required
                                    placeholder="Ej: Administradores, Supervisores, etc."
                                    class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="description"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300">
                                    Descripción
                                </label>
                                <textarea name="description" id="description" rows="3" placeholder="Describe el propósito de este grupo..."
                                    class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $userGroup->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Información actual -->
                            <div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                    <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Información
                                        del Grupo:</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-xs">
                                        <div>
                                            <span class="font-medium text-gray-700 dark:text-gray-300">Miembros:</span>
                                            <span
                                                class="ml-2 text-gray-900 dark:text-white">{{ $userGroup->members_count }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700 dark:text-gray-300">Creado
                                                por:</span>
                                            <span
                                                class="ml-2 text-gray-900 dark:text-white">{{ $userGroup->creator->name ?? 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700 dark:text-gray-300">Fecha:</span>
                                            <span
                                                class="ml-2 text-gray-900 dark:text-white">{{ $userGroup->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Estado activo -->
                            <div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="active" id="active" value="1"
                                        {{ old('active', $userGroup->active) ? 'checked' : '' }}
                                        class="h-3.5 w-3.5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="active" class="ml-2 block text-xs text-gray-900 dark:text-gray-100">
                                        Grupo activo
                                    </label>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Los grupos inactivos no aparecerán en las opciones de turnado.
                                </p>
                                @error('active')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="mt-6 flex items-center justify-end gap-2">
                            <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md"
                                :href="route('user-groups.index')" />
                            <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Actualizar grupo"
                                size="md" type="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
