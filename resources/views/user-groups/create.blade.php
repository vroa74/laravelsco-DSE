<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
                {{ __('Crear Grupo de Usuarios') }}
            </h2>
            <x-icon-action variant="neutral" icon="fa-solid fa-arrow-left" :href="route('user-groups.index')"
                label="Volver al listado" />
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl">
            <div class="panel-base overflow-hidden">
                <div class="p-5 text-primary">
                    <form action="{{ route('user-groups.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <!-- Nombre del grupo -->
                            <div>
                                <label for="name" class="label-base">
                                    Nombre del Grupo <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    placeholder="Ej: Administradores, Supervisores, etc."
                                    class="input-base">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="description" class="label-base">
                                    Descripción
                                </label>
                                <textarea name="description" id="description" rows="3" placeholder="Describe el propósito de este grupo..."
                                    class="input-base">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado activo -->
                            <div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="active" id="active" value="1"
                                        {{ old('active', true) ? 'checked' : '' }}
                                        class="h-3.5 w-3.5 text-indigo-600 focus:ring-indigo-500 border-primary rounded input-base">
                                    <label for="active" class="ml-2 block text-xs text-primary">
                                        Grupo activo
                                    </label>
                                </div>
                                <p class="mt-1 text-xs text-muted">
                                    Los grupos inactivos no aparecerán en las opciones de turnado.
                                </p>
                                @error('active')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="mt-6 flex items-center justify-end gap-2">
                            <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md"
                                :href="route('user-groups.index')" />
                            <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Crear grupo"
                                size="md" type="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
