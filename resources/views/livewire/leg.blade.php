<div class="text-primary">
    <!-- Título responsivo -->
    <h3 class="text-center text-sm md:text-base font-semibold mb-2 md:mb-3">Legislatura</h3>

    <!-- Selector de Legislatura Actual -->
    <div class="mb-3 md:mb-4">
        <label for="legislatura" class="block mb-1 text-xs md:text-sm font-medium text-primary">Seleccionar Legislatura
            Actual</label>
        <select id="legislatura"
            class="w-full p-1.5 md:p-2 text-xs md:text-sm border border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors text-primary input-base"
            wire:change="setActual($event.target.value)">
            <option selected>Seleccione una opción</option>
            @foreach ($legis as $item)
                <option value="{{ $item->id }}" @if ($item->actual) selected @endif>
                    {{ $item->legislatura }}</option>
            @endforeach
        </select>
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="legislatura-input" name="legislatura" wire:model.defer="newLegislatura"
                placeholder="Ingrese legislatura (ej: IV, V, VI)"
                class="flex-1 p-1.5 md:p-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors text-primary input-base">

            <div class="flex space-x-1 md:flex-shrink-0">
                @if ($editingId)
                    <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="saveEdit" />
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="cancelEdit" />
                @else
                    <x-icon-action variant="success" icon="fa-solid fa-plus" label="Agregar" size="md" wire:click="addLegislatura" />
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

    <!-- Lista de Legislaturas -->
    <div class="space-y-1 md:space-y-2">
        <h4 class="text-xs md:text-sm font-medium mb-1 md:mb-2 text-primary">Legislaturas Registradas:</h4>
        @foreach ($legis as $items)
            <div
                class="flex justify-between items-center p-1.5 md:p-2 rounded-lg hover:bg-gray-750 transition-colors surface-panel">
                <span
                    class="@if ($items->actual) font-bold text-green-400 @else text-white @endif text-xs md:text-sm">
                    {{ $items->legislatura }}
                    @if ($items->actual)
                        <span class="ml-1 text-xs bg-green-600 px-1.5 py-0.5 rounded-full">Actual</span>
                    @endif
                </span>
                <div class="flex space-x-1">
                    <x-icon-action variant="warning" icon="fa-solid fa-pencil" label="Editar" wire:click="startEdit({{ $items->id }})" />
                    <x-icon-action variant="danger" icon="fa-solid fa-trash" label="Eliminar" onclick="confirmDeletion({{ $items->id }})" />
                </div>
            </div>
        @endforeach
    </div>

    <!-- Script para confirmación de eliminación -->
    <script>
        function confirmDeletion(id) {
            if (confirm('¿Está seguro de que desea eliminar esta legislatura?')) {
                @this.deleteLegislatura(id);
            }
        }
    </script>
</div>
