<div class="text-white">
    <h3 class="text-center text-lg font-semibold mb-3">N. Cor.</h3>
    
    <!-- Formulario de Agregar/Editar -->
    <div class="mb-4">
        <div class="flex flex-col space-y-3">
            <input type="text" 
                   id="ncor-input" 
                   name="ncor" 
                   wire:model.defer="newNcor"
                   placeholder="Ingrese N. Cor."
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
                    <button wire:click="addNcor"
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

    <!-- Lista de N. Cor. -->
    <div class="space-y-2">
        <h4 class="text-sm font-medium text-gray-300 mb-2">N. Cor. Registrados:</h4>
        @foreach($ncors as $item)
            <div class="flex justify-between items-center p-3 bg-gray-800 rounded-lg">
                <span class="text-white text-sm">{{ $item->ncor }}</span>
                <div class="flex space-x-2">
                    <button wire:click="startEdit({{ $item->id }})"
                            class="p-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-pencil text-sm"></i>
                    </button>
                    <button onclick="confirmDeletion({{ $item->id }})"
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
            if (confirm('¿Está seguro de que desea eliminar este N. Cor.?')) {
                @this.deleteNcor(id);
            }
        }
    </script>
</div>
