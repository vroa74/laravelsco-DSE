<div class="text-white">
    <!-- Título responsivo -->
    <h3 class="text-center text-sm md:text-base font-semibold mb-2 md:mb-3">Clasificación de Correspondencia</h3>

    <!-- Selector de Nivel de Correspondencia -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row items-center space-y-1 md:space-y-0 md:space-x-2">
            <label for="tcorSelect" class="text-xs md:text-sm font-medium text-white">Niv. Cor.</label>
            <select id="tcorSelect" wire:model.live="tcccid" wire:change="miFuncionPersonalizada($event.target.value)"
                class="flex-1 md:w-auto p-1.5 md:p-2 text-xs md:text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                <option value="">Seleccione una opción</option>
                @foreach ($tcc as $items)
                    <option value="{{ $items->id }}">{{ $items->tcor }}</option>
                @endforeach
            </select>
        </div>
        @error('tcccid')
            <div class="mt-1 text-xs text-center text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Información del TCOR Seleccionado -->
    <div class="mb-3 md:mb-4 text-center">
        @if ($tccc && $tccctxt)
            <p class="text-xs md:text-sm font-medium text-gray-300">TCOR Seleccionado: {{ $tccc }} -
                {{ $tccctxt }}</p>
        @elseif($tcccid)
            <p class="text-xs md:text-sm text-gray-400">(Cargando detalles...)</p>
        @endif
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="ccorInput" wire:model="newCcorText" placeholder="Texto Clasificación"
                class="flex-1 p-1.5 md:p-2 text-xs md:text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">

            <div class="flex space-x-1 md:flex-shrink-0">
                @if ($editingId)
                    <button wire:click="updateCcor"
                        class="flex-1 md:flex-none bg-purple-600 hover:bg-purple-700 text-white font-medium py-1.5 md:py-2 px-2 md:px-3 rounded-lg transition-colors text-xs md:text-sm">
                        <i class="fa-solid fa-save mr-1"></i>
                        <span class="hidden md:inline">Guardar</span>
                        <span class="md:hidden">✓</span>
                    </button>
                    <button wire:click="cancelEdit"
                        class="flex-1 md:flex-none bg-pink-600 hover:bg-pink-700 text-white font-medium py-1.5 md:py-2 px-2 md:px-3 rounded-lg transition-colors text-xs md:text-sm">
                        <i class="fa-solid fa-times mr-1"></i>
                        <span class="hidden md:inline">Cancelar</span>
                        <span class="md:hidden">✗</span>
                    </button>
                @else
                    <button wire:click="addCcor"
                        class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white font-medium py-1.5 md:py-2 px-2 md:px-3 rounded-lg transition-colors text-xs md:text-sm">
                        <i class="fa-solid fa-plus mr-1"></i>
                        <span class="hidden md:inline">Agregar</span>
                        <span class="md:hidden">+</span>
                    </button>
                @endif
            </div>
        </div>
        @error('newCcorText')
            <div class="mt-1 text-xs text-center text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Mensajes Flash -->
    <div wire:key="flash-message-{{ rand() }}" x-data="{ showSuccess: @json(session()->has('message')), showError: @json(session()->has('error')) }" x-init="if (showSuccess || showError) {
        setTimeout(() => { showSuccess = false;
            showError = false }, 2000);
    }">

        @if (session()->has('message'))
            <div x-show="showSuccess" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="mb-3 p-2 bg-green-600 text-white text-xs md:text-sm rounded-lg text-center">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div x-show="showError" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="mb-3 p-2 bg-red-600 text-white text-xs md:text-sm rounded-lg text-center">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Lista de Clasificaciones -->
    <div class="space-y-1 md:space-y-2">
        <h4 class="text-xs md:text-sm font-medium text-gray-300 mb-1 md:mb-2">Clasificaciones Registradas:</h4>
        @foreach ($ccc as $items)
            <div
                class="flex justify-between items-center p-1.5 md:p-2 bg-gray-800 rounded-lg hover:bg-gray-750 transition-colors">
                <span class="text-white text-xs md:text-sm">{{ $items->tcor }} -- {{ $items->ccor }}</span>
                <div class="flex space-x-1">
                    <button wire:click="startEdit({{ $items->id }})"
                        class="p-1.5 md:p-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                        title="Editar">
                        <i class="fa-solid fa-pencil text-xs md:text-sm"></i>
                    </button>
                    <button wire:click="deleteCcor({{ $items->id }})"
                        class="p-1.5 md:p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                        title="Eliminar">
                        <i class="fa-solid fa-trash-can text-xs md:text-sm"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    @script
        <script>
            Livewire.on('reset-select', () => {
                const selectElement = document.getElementById('tcorSelect');
                if (selectElement) {
                    selectElement.value = "";
                }
            });
        </script>
    @endscript
</div>
