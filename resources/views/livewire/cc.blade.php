<div class="text-primary">
    <!-- Título responsivo -->
    <h3 class="text-center text-sm md:text-base font-semibold mb-2 md:mb-3">Clasificación de Correspondencia</h3>

    <!-- Selector de Nivel de Correspondencia -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row items-center space-y-1 md:space-y-0 md:space-x-2">
            <label for="tcorSelect" class="text-xs md:text-sm font-medium text-primary">Niv. Cor.</label>
            <select id="tcorSelect" wire:model.live="tcccid" wire:change="miFuncionPersonalizada($event.target.value)"
                class="flex-1 md:w-auto p-1.5 md:p-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors text-primary input-base">
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
            <p class="text-xs md:text-sm font-medium text-primary">TCOR Seleccionado: {{ $tccc }} -
                {{ $tccctxt }}</p>
        @elseif($tcccid)
            <p class="text-xs md:text-sm text-primary">(Cargando detalles...)</p>
        @endif
    </div>

    <!-- Formulario de Agregar/Editar -->
    <div class="mb-3 md:mb-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="ccorInput" wire:model="newCcorText" placeholder="Texto Clasificación"
                class="flex-1 p-1.5 md:p-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors text-primary input-base">

            <div class="flex space-x-1 md:flex-shrink-0">
                @if ($editingId)
                    <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="updateCcor" />
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="cancelEdit" />
                @else
                    <x-icon-action variant="success" icon="fa-solid fa-plus" label="Agregar" size="md" wire:click="addCcor" />
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
        <h4 class="text-xs md:text-sm font-medium mb-1 md:mb-2 text-primary">Clasificaciones Registradas:</h4>
        @foreach ($ccc as $items)
            <div
                class="flex justify-between items-center p-1.5 md:p-2 rounded-lg hover:bg-gray-750 transition-colors surface-panel">
                <span class="text-white text-xs md:text-sm">{{ $items->tcor }} -- {{ $items->ccor }}</span>
                <div class="flex space-x-1">
                    <x-icon-action variant="warning" icon="fa-solid fa-pencil" label="Editar" wire:click="startEdit({{ $items->id }})" />
                    <x-icon-action variant="danger" icon="fa-solid fa-trash" label="Eliminar" wire:click="deleteCcor({{ $items->id }})" />
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
