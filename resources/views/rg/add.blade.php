<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            Agregar Nuevo Registro
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="panel-base overflow-hidden p-6">

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 dark:bg-green-900/30 dark:border-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 dark:bg-red-900/30 dark:border-red-600 dark:text-red-400">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('rg.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="legislatura" class="label-base">Legislatura</label>
                            <input type="text" name="legislatura" id="legislatura" value="{{ old('legislatura') }}"
                                   class="input-base" required>
                        </div>

                        <div>
                            <label for="fcap" class="label-base">Fecha de Captura</label>
                            <input type="date" name="fcap" id="fcap" value="{{ old('fcap') }}"
                                   class="input-base" required>
                        </div>

                        <div>
                            <label for="rem_nombre" class="label-base">Nombre del Remitente</label>
                            <input type="text" name="rem_nombre" id="rem_nombre" value="{{ old('rem_nombre') }}"
                                   class="input-base" required>
                        </div>

                        <div>
                            <label for="rem_cargo" class="label-base">Cargo del Remitente</label>
                            <input type="text" name="rem_cargo" id="rem_cargo" value="{{ old('rem_cargo') }}"
                                   class="input-base">
                        </div>

                        <div>
                            <label for="rem_deporg" class="label-base">Dependencia/Organismo</label>
                            <input type="text" name="rem_deporg" id="rem_deporg" value="{{ old('rem_deporg') }}"
                                   class="input-base">
                        </div>

                        <div class="md:col-span-2">
                            <label for="des" class="label-base">Descripción</label>
                            <textarea name="des" id="des" rows="4"
                                      class="input-base" required>{{ old('des') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2">
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md"
                            :href="route('rg.index')" />
                        <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar registro"
                            size="md" type="submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
