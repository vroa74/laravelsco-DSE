<div class="text-white">
    <h3 class="text-center text-lg font-semibold mb-3">Legislatura</h3>
    
    <!-- Selector de Legislatura Actual -->
    <div class="mb-4">
        <label for="legislatura" class="block mb-2 text-sm font-medium text-white">Seleccionar Legislatura Actual</label>
        <select id="legislatura"
                class="w-full p-3 text-sm bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500"
                wire:change="setActual($event.target.value)">
            <option selected>Seleccione una opción</option>
            @foreach($legis as $item)
                <option value="{{ $item->id }}" @if($item->actual) selected @endif>{{ $item->legislatura }}</option>
            @endforeach
        </select>
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-4">
        <div class="flex flex-col space-y-3">
            <input type="text" 
                   id="legislatura-input" 
                   name="legislatura" 
                   wire:model.defer="newLegislatura"
                   placeholder="Ingrese legislatura (ej: IV, V, VI)"
                   class="w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            
            <div class="flex space-x-2">
                @if($editingId)
                    <button wire:click="saveEdit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        <i class="fa-solid fa-save mr-2"></i>Guardar
                    </button>
                    <button wire:click="cancelEdit"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        <i class="fa-solid fa-times mr-2"></i>Cancelar
                    </button>
                @else
                    <button wire:click="addLegislatura"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        <i class="fa-solid fa-plus mr-2"></i>Agregar
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Mensajes de Estado -->
    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-600 text-white text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="mb-4 p-3 bg-red-600 text-white text-sm rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Lista de Legislaturas -->
    <div class="space-y-2">
        <h4 class="text-sm font-medium text-gray-300 mb-2">Legislaturas Registradas:</h4>
        @foreach($legis as $items)
            <div class="flex justify-between items-center p-3 bg-gray-800 rounded-lg">
                <span class="@if($items->actual) font-bold text-green-400 @else text-white @endif text-sm">
                    {{ $items->legislatura }}
                    @if($items->actual)
                        <span class="ml-2 text-xs bg-green-600 px-2 py-1 rounded-full">Actual</span>
                    @endif
                </span>
                <div class="flex space-x-2">
                    <button wire:click="startEdit({{ $items->id }})"
                            class="p-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-pencil text-sm"></i>
                    </button>
                    <button onclick="confirmDeletion({{ $items->id }})"
                            class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-trash-can text-sm"></i>
                    </button>
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
