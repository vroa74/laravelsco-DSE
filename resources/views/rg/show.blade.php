<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-primary leading-tight sm:text-lg">
            Ver Registro #{{ $co->id }}
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Información General</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="label-base">Folio</label>
                                <p class="text-sm text-primary">{{ $co->id }}</p>
                            </div>

                            <div>
                                <label class="label-base">Legislatura</label>
                                <p class="text-sm text-primary">{{ $co->legislatura }}</p>
                            </div>

                            <div>
                                <label class="label-base">Fecha de Captura</label>
                                <p class="text-sm text-primary">{{ $co->fcap ? date('d/m/Y', strtotime($co->fcap)) : 'No especificada' }}</p>
                            </div>

                            <div>
                                <label class="label-base">Fecha de Recepción</label>
                                <p class="text-sm text-primary">{{ $co->frec ? date('d/m/Y', strtotime($co->frec)) : 'No especificada' }}</p>
                            </div>

                            <div>
                                <label class="label-base">Fecha de Oficio</label>
                                <p class="text-sm text-primary">{{ $co->fofi ? date('d/m/Y', strtotime($co->fofi)) : 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Información del Remitente</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="label-base">Nombre</label>
                                <p class="text-sm text-primary">{{ $co->rem_nombre }}</p>
                            </div>

                            <div>
                                <label class="label-base">Cargo</label>
                                <p class="text-sm text-primary">{{ $co->rem_cargo ?: 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="label-base">Dependencia/Organismo</label>
                                <p class="text-sm text-primary">{{ $co->rem_deporg ?: 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="label-base">Dirección</label>
                                <p class="text-sm text-primary">{{ $co->rem_dir ?: 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 text-primary">Descripción</h3>
                        <p class="text-sm text-primary">{{ $co->des }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 text-primary">Seguimiento</h3>
                        <p class="text-sm text-primary">{{ $co->seguimiento ?: 'No especificado' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2">
                    <x-icon-action variant="neutral" icon="fa-solid fa-arrow-left" label="Volver al listado"
                        size="md" :href="route('rg.index')" />
                    <x-icon-action variant="warning" icon="fa-solid fa-pencil" label="Editar registro"
                        size="md" :href="route('rg.edit', $co->id)" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
