<div class="text-white">
    <!-- Título responsivo -->
    <h3 class="text-center text-lg md:text-xl font-semibold mb-3 md:mb-4">Clasificación de Correspondencia</h3>
    
    <!-- Selector de Nivel de Correspondencia -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-3">
            <label for="tcorSelect" class="text-sm md:text-base font-medium text-white">Niv. Cor.</label>
            <select id="tcorSelect" 
                    wire:model.live="tcccid"
                    wire:change="miFuncionPersonalizada($event.target.value)"
                    class="flex-1 md:w-auto p-2 md:p-3 text-sm md:text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                <option value="">Seleccione una opción</option>
                @foreach($tcc as $items)
                    <option value="{{ $items->id }}">{{ $items->tcor }}</option>
                @endforeach
            </select>
        </div>
        @error('tcccid') 
            <div class="mt-2 text-sm text-center text-red-500">{{ $message }}</div> 
        @enderror
    </div>

    <!-- Información del TCOR Seleccionado -->
    <div class="mb-4 md:mb-6 text-center">
        @if($tccc && $tccctxt)
            <p class="text-sm md:text-base font-medium text-gray-300">TCOR Seleccionado: {{ $tccc }} - {{ $tccctxt }}</p>
        @elseif($tcccid)
            <p class="text-sm md:text-base text-gray-400">(Cargando detalles...)</p> 
        @endif
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
            <input type="text"
                   id="ccorInput"
                   wire:model="newCcorText"
                   placeholder="Texto Clasificación"
                   class="flex-1 p-2 md:p-3 text-sm md:text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            
            <div class="flex space-x-2 md:flex-shrink-0">
                @if($editingId)
                    <button wire:click="updateCcor"
                            class="flex-1 md:flex-none bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-save mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Guardar</span>
                        <span class="md:hidden">✓</span>
                    </button>
                    <button wire:click="cancelEdit"
                            class="flex-1 md:flex-none bg-pink-600 hover:bg-pink-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-times mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Cancelar</span>
                        <span class="md:hidden">✗</span>
                    </button>
                @else
                    <button wire:click="addCcor"
                            class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 md:py-3 px-3 md:px-4 rounded-lg transition-colors text-sm md:text-base">
                        <i class="fa-solid fa-plus mr-1 md:mr-2"></i>
                        <span class="hidden md:inline">Agregar</span>
                        <span class="md:hidden">+</span>
                    </button>
                @endif
            </div>
        </div>
        @error('newCcorText') 
            <div class="mt-2 text-sm text-center text-red-500">{{ $message }}</div> 
        @enderror
    </div>

    <!-- Mensajes Flash -->
    <div wire:key="flash-message-{{ rand() }}"
         x-data="{ showSuccess: @json(session()->has('message')), showError: @json(session()->has('error')) }" 
         x-init="
            if (showSuccess || showError) {
                setTimeout(() => { showSuccess = false; showError = false }, 2000);
            }
         ">
        
        @if (session()->has('message'))
            <div x-show="showSuccess" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-90"
                 class="mb-4 p-3 bg-green-600 text-white text-sm md:text-base rounded-lg text-center">
                {{ session('message') }}
            </div>
        @endif
        
        @if (session()->has('error'))
            <div x-show="showError" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-90"
                 class="mb-4 p-3 bg-red-600 text-white text-sm md:text-base rounded-lg text-center">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Lista de Clasificaciones -->
    <div class="space-y-2 md:space-y-3">
        <h4 class="text-sm md:text-base font-medium text-gray-300 mb-2 md:mb-3">Clasificaciones Registradas:</h4>
        @foreach($ccc as $items)
            <div class="flex justify-between items-center p-2 md:p-3 bg-gray-800 rounded-lg hover:bg-gray-750 transition-colors">
                <span class="text-white text-sm md:text-base">{{ $items->tcor }} -- {{ $items->ccor }}</span>
                <div class="flex space-x-1 md:space-x-2">
                    <button wire:click="startEdit({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                            title="Editar">
                        <i class="fa-solid fa-pencil text-sm md:text-base"></i>
                    </button>
                    <button wire:click="deleteCcor({{ $items->id }})"
                            class="p-2 md:p-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                            title="Eliminar">
                        <i class="fa-solid fa-trash-can text-sm md:text-base"></i>
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
