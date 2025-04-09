<div>
    <h3>Clasificación de Correspondencia</h3>
    <div class="flex items-center justify-center pt-1 text-xs">
        <label for="tcorSelect" class="text-sm font-medium text-gray-900 dark:text-white">Niv. Cor.</label>
        <select id="tcorSelect" 
                wire:model.live="tcccid"
                wire:change="miFuncionPersonalizada($event.target.value)"
                class="p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Seleccione una opción</option>
            @foreach($tcc as $items)
                <option value="{{ $items->id }}">{{ $items->tcor }}</option>
            @endforeach
        </select>
    </div>
    @error('tcccid') <div class="text-xs text-center text-red-500">{{ $message }}</div> @enderror

    <div class="pt-2 text-center">
        @if($tccc && $tccctxt)
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">TCOR Seleccionado: {{ $tccc }} - {{ $tccctxt }}</p>
        @elseif($tcccid)
            <p class="text-sm text-gray-500 dark:text-gray-400">(Cargando detalles...)</p> 
        @endif
    </div>

    <div class="flex items-center justify-center pt-2 pb-2 ">
        <div class="flex items-center space-x-2">
            <input type="text"
                   id="ccorInput"
                   wire:model="newCcorText"
                   class="p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Texto Clasificación">
            
            @if($editingId)
                <button wire:click="updateCcor"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                               overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                               bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                     <span class="relative px-2 py-1 transition-all duration-75 ease-in bg-white rounded-md dark:bg-gray-900 group-hover:bg-opacity-0">
                        <i class="fa-solid fa-save"></i>
                    </span>
                </button>
                <button wire:click="cancelEdit"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                               overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                               bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span class="relative px-2 py-1 transition-all duration-75 ease-in bg-white rounded-md dark:bg-gray-900 group-hover:bg-opacity-0">
                        <i class="fa-solid fa-times"></i>
                    </span>
                </button>
            @else
                <button wire:click="addCcor"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                               overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                               bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400
                               group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4
                               focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                    <span class="relative px-2 py-1 transition-all duration-75 ease-in bg-white rounded-md dark:bg-gray-900 group-hover:bg-opacity-0">
                        <i class="fa-solid fa-notes-medical"></i>
                    </span>
                </button>
            @endif
            
        </div>
    </div>
    @error('newCcorText') <div class="mb-2 text-xs text-center text-red-500">{{ $message }}</div> @enderror

    {{-- Mensajes Flash con Alpine.js para ocultar --}}
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
                 class="pt-2 text-sm text-center text-green-600">
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
                 class="pt-2 text-sm text-center text-red-600">
                {{ session('error') }}
            </div>
        @endif
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
    <hr>
    <ol class="pt-2 text-xs list-none list-inside">
        @foreach($ccc as $items)
            <li class="flex items-center justify-between py-1 ">
                <span>- {{ $items->tcor }} -- {{ $items->ccor }}</span>
                <div>
                    <button wire:click="startEdit({{ $items->id }})"
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                   overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                   bg-gradient-to-br from-yellow-200 to-red-700 group-hover:from-orange-500
                                   group-hover:to-orange-600 hover:text-white dark:text-white focus:ring-4
                                   focus:outline-none focus:ring-orange-600 dark:focus:ring-orange-800">
                        <span class="relative px-2 py-1 transition-all duration-75 ease-in bg-white rounded-md dark:bg-gray-900 group-hover:bg-opacity-0">
                            <i class="fa-solid fa-pencil"></i>
                        </span>
                    </button>
                    <button wire:click="deleteCcor({{ $items->id }})"
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                   overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                   bg-gradient-to-br from-orange-400 to-red-800 group-hover:from-red-600
                                   group-hover:to-orange-800 hover:text-white dark:text-white focus:ring-4
                                   focus:outline-none focus:ring-red-200 dark:focus:ring-red-800">
                        <span class="relative px-2 py-1 transition-all duration-75 ease-in bg-white rounded-md dark:bg-gray-900 group-hover:bg-opacity-0">
                            <i class="fa-solid fa-trash-can"></i>
                        </span>
                    </button>
                </div>
            </li>
        @endforeach
    </ol>

   
    
</div>
