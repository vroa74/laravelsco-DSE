<div class="text-white">
    <!-- Título responsivo -->
    <h3 class="text-center text-lg md:text-xl font-semibold mb-3 md:mb-4">Legislatura</h3>
    
    <!-- Selector de Legislatura Actual -->
    <div class="mb-4 md:mb-6">
        <label for="legislatura" class="block mb-2 text-sm md:text-base font-medium text-white">Seleccionar Legislatura Actual</label>
        <select id="legislatura"
                class="w-full p-2 md:p-3 text-sm md:text-base bg-gray-700 border border-gray-600 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                wire:change="setActual($event.target.value)">
            <option selected>Seleccione una opción</option>
            @foreach($legis as $item)
                <option value="{{ $item->id }}" @if($item->actual) selected @endif>{{ $item->legislatura }}</option>
            @endforeach
        </select>
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
            <input type="text" 
                   id="legislatura-input" 
                   name="legislatura" 
                   wire:model.defer="newLegislatura"
                   placeholder="Ingrese legislatura (ej: IV, V, VI)"
                   class="flex-1 p-2 md:p-3 text-sm md:text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            
            <div class="flex space-x-2 md:flex-shrink-0">
                @if($editingId)
                    <button wire:click="saveEdit"
                            class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-save mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Guardar</span>
                        <span class="md:hidden">✓</span>
                    </button>
                    <button wire:click="cancelEdit"
                            class="flex-1 md:flex-none bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-times mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Cancelar</span>
                        <span class="md:hidden">✗</span>
                    </button>
                @else
                    <button wire:click="addLegislatura"
                            class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-plus mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Agregar</span>
                        <span class="md:hidden">+</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Mensajes de Estado -->
    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-600 text-white text-sm md:text-base rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="mb-4 p-3 bg-red-600 text-white text-sm md:text-base rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Lista de Legislaturas -->
    <div class="space-y-2 md:space-y-3">
        <h4 class="text-sm md:text-base font-medium text-gray-300 mb-2 md:mb-3">Legislaturas Registradas:</h4>
        @foreach($legis as $items)
            <div class="flex justify-between items-center p-2 md:p-3 bg-gray-800 rounded-lg hover:bg-gray-750 transition-colors">
                <span class="@if($items->actual) font-bold text-green-400 @else text-white @endif text-sm md:text-base">
                    {{ $items->legislatura }}
                    @if($items->actual)
                        <span class="ml-2 text-xs md:text-sm bg-green-600 px-2 py-1 rounded-full">Actual</span>
                    @endif
                </span>
                <div class="flex space-x-1 md:space-x-2">
                    <button wire:click="startEdit({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                            title="Editar">
                        <i class="fa-solid fa-pencil text-sm md:text-base"></i>
                    </button>
                    <button onclick="confirmDeletion({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                            title="Eliminar">
                        <i class="fa-solid fa-trash-can text-sm md:text-base"></i>
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
