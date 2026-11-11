<div class="text-white">
    <!-- Título responsivo -->
    <h3 class="text-center text-sm md:text-base font-semibold mb-2 md:mb-3">Tipo de Correspondencia</h3>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" wire:model.defer="newTcor" id="ncs" placeholder="Ingrese tipo de correspondencia"
                class="flex-1 p-1.5 md:p-2 text-xs md:text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">

            <div class="flex space-x-1 md:flex-shrink-0">
                @if ($editingId)
                    <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="saveEdit" />
                @else
                    <x-icon-action variant="success" icon="fa-solid fa-plus" label="Agregar" size="md" wire:click="addTcor" />
                @endif
            </div>
        </div>
    </div>

    <!-- Mensajes de Estado -->
    @if (session()->has('success'))
        <div class="mb-3 p-2 bg-green-600 text-white text-xs md:text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-3 p-2 bg-red-600 text-white text-xs md:text-sm rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Lista de Tipos de Correspondencia -->
    <div class="space-y-1 md:space-y-2">
        <h4 class="text-xs md:text-sm font-medium text-gray-300 mb-1 md:mb-2">Tipos Registrados:</h4>
        @foreach ($ttc as $items)
            <div
                class="flex justify-between items-center p-1.5 md:p-2 bg-gray-800 rounded-lg hover:bg-gray-750 transition-colors">
                <span class="text-white text-xs md:text-sm">{{ $items->tcor }}</span>
                <div class="flex space-x-1">
                    <x-icon-action variant="warning" icon="fa-solid fa-pencil" label="Editar" wire:click="startEdit({{ $items->id }})" />
                    <x-icon-action variant="danger" icon="fa-solid fa-trash" label="Eliminar" wire:click="deleteTcor({{ $items->id }})" />
                </div>
            </div>
        @endforeach
    </div>
</div>
