<div class="text-white">
    <!-- Título responsivo -->
    <h3 class="text-center text-lg md:text-xl font-semibold mb-3 md:mb-4">Tipo de Correspondencia</h3>
    
    <!-- Formulario de Agregar/Editar -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
            <input type="text" 
                   wire:model.defer="newTcor"
                   id="ncs"
                   placeholder="Ingrese tipo de correspondencia"
                   class="flex-1 p-2 md:p-3 text-sm md:text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            
            <div class="flex space-x-2 md:flex-shrink-0">
                @if($editingId)
                    <button wire:click="saveEdit"
                            class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-save mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Guardar</span>
                        <span class="md:hidden">✓</span>
                    </button>
                @else
                    <button wire:click="addTcor"
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

    <!-- Lista de Tipos de Correspondencia -->
    <div class="space-y-2 md:space-y-3">
        <h4 class="text-sm md:text-base font-medium text-gray-300 mb-2 md:mb-3">Tipos Registrados:</h4>
        @foreach($ttc as $items)
            <div class="flex justify-between items-center p-2 md:p-3 bg-gray-800 rounded-lg hover:bg-gray-750 transition-colors">
                <span class="text-white text-sm md:text-base">{{ $items->tcor }}</span>
                <div class="flex space-x-1 md:space-x-2">
                    <button wire:click="startEdit({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                            title="Editar">
                        <i class="fa-solid fa-pencil text-sm md:text-base"></i>
                    </button>
                    <button wire:click="deleteTcor({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                            title="Eliminar">
                        <i class="fa-solid fa-trash-can text-sm md:text-base"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
