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
                    <button wire:click="saveEdit"
                        class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white font-medium py-1.5 md:py-2 px-2 md:px-3 rounded-lg transition-colors text-xs md:text-sm">
                        <i class="fa-solid fa-save mr-1"></i>
                        <span class="hidden md:inline">Guardar</span>
                        <span class="md:hidden">✓</span>
                    </button>
                @else
                    <button wire:click="addTcor"
                        class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white font-medium py-1.5 md:py-2 px-2 md:px-3 rounded-lg transition-colors text-xs md:text-sm">
                        <i class="fa-solid fa-plus mr-1"></i>
                        <span class="hidden md:inline">Agregar</span>
                        <span class="md:hidden">+</span>
                    </button>
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
                    <button wire:click="startEdit({{ $items->id }})"
                        class="p-1.5 md:p-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                        title="Editar">
                        <i class="fa-solid fa-pencil text-xs md:text-sm"></i>
                    </button>
                    <button wire:click="deleteTcor({{ $items->id }})"
                        class="p-1.5 md:p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                        title="Eliminar">
                        <i class="fa-solid fa-trash-can text-xs md:text-sm"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
