<div>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mx-auto rounded-lg shadow-md max-w-2sm border-amber-200 surface-panel">
        <h2 class="mb-0 font-bold text-center text-md text-primary">Formulario de Edición</h2>
        {{-- //! Formulario de Edición --}}
        <form wire:submit="update" class="m-4 text-primary">
            @csrf
            <div>
                <label for="lleg" class="block mb-2 text-sm font-medium text-primary">
                    Legislatura
                </label>
                {{-- //! hay que corregir que no queda selecionada la legislatura actual --}}
                <select id="lleg" wire:model="selectedLegislaturaId"
                    class="block w-full p-1 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    <option value="">Seleccione...</option>
                    @foreach ($legs as $item)
                        <option value="{{ $item->id }}">{{ $item->legislatura }}</option>
                    @endforeach
                </select>
            </div>
            {{-- ----------------------------------------------------------------------------------------- --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <!-- Columna 1 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <!-- Etiqueta -->
                    <label for="ffcap" class="w-1/4 text-sm font-medium text-primary">
                        Fecha de Captura
                    </label>
                    <!-- Campo de Entrada -->
                    <input type="date" id="ffcapt" wire:model="fcap"
                        class="w-3/4 p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                </div>
                <!-- Columna 2 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="ffrec" wire:model.live="frec"
                        class="block mb-2 text-sm font-medium text-primary">Fecha de recepcion</label>
                    <input type="date" id="ffrec" wire:model="frec"
                        class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                </div>
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="nncor" class="block mb-2 text-sm font-medium text-primary">
                        Nivel de Correspondencia
                    </label>
                    <select id="nncor" wire:model="ncor"
                        class="block w-full p-1 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                        <option selected>Selecione el Nivel:</option>
                        @foreach ($ncors as $item)
                            <option value="{{ $item->ncor }}"> {{ $item->ncor }} </option>
                        @endforeach
                    </select>
                    {{ $ncor }}
                </div>
                <!-- Columna 4 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="tncor" class="block mb-2 text-sm font-medium text-primary">
                        Tipo de Correspondencia
                    </label>
                    <select id="tcorSelect"
                        class="block w-full p-1 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                        wire:model.live="tcccid" x-data="{ selectedText: '' }"
                        x-on:change="selectedText = $event.target.options[$event.target.selectedIndex].text">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tcc as $items)
                            <option value="{{ $items->id }}" data-text="{{ $items->tcor }}">{{ $items->tcor }}
                            </option>
                        @endforeach
                    </select>

                    <input type="hidden" wire:model="tccctext" x-bind:value="selectedText">
                </div>
                <!-- Fila 2 - Columna 1 ---------------------------------------------------------------------------------------------------------->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="cccor" wire:model.live="ccor"
                        class="block mb-2 text-sm font-medium text-primary">
                        Clasificacion de Correspondencia
                    </label>
                    <select id="cccor" wire:model="ccor"
                        class="block w-full p-1 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                        @if (!$isCccorEnabled) disabled @endif>
                        <option selected>Selecione la Clasificacion:</option>
                        @foreach ($filteredCcor as $item)
                            <option value="{{ $item->tcor }}"> {{ $item->ccor }} </option>
                        @endforeach
                    </select>
                </div>
                <!-- Fila 2 - Columna 2 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="nnh" class="block mb-2 text-sm font-medium text-primary">
                        No. de hojas
                    </label>
                    <input type="number" id="nnh" wire:model="nhoj"
                        class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                </div>
                <!-- Fila 2 - Columna 3 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="nno" class="block mb-2 text-sm font-medium text-primary">
                        No. de Oficio
                    </label>
                    <input type="text" id="nno" wire:model="nofi"
                        class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                </div>
                <!-- Fila 2 - Columna 4 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label for="ffo" class="block mb-2 text-sm font-medium text-primary">
                        Fecha del oficio
                    </label>
                    <input type="date" id="ffo" wire:model="fofi"
                        class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                </div>
            </div>
            {{-- -------------------------------------------------------------------------------------------------------------- --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!-- Fila 1 - Columna 1 -->
                <div class="col-span-1">
                    <label for="des" class="block mb-8 text-sm font-medium text-primary">
                        Descripcion:
                        <button type="button" wire:click="openModalAgent('des')"
                            class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                            title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                        <button type="button" wire:click="openModalUsers('des')"
                            class="px-2 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300 relative group ml-1"
                            title="Presiona para seleccionar usuario">
                            <i class="fa-solid fa-user"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar usuario
                            </span>
                        </button>
                    </label>
                    <textarea id="des" rows="4" spellcheck="true" lang="es" wire:model="des"
                        class="block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                        placeholder="Escribe aquí...">{{ $des }}</textarea>
                </div>
                <div class="col-span-1 m-4">
                    <p class="py-1 mb-8">Remitente:

                        <button type="button" wire:click="openModalAgent('Remitente')"
                            class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                            title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                    </p>
                    <div class="flex items-center m-1 space-x-4">
                        <!-- Etiqueta -->
                        <label for="remnom" class="text-sm font-medium text-primary">
                            Nombre:
                        </label>
                        <!-- Campo de Entrada -->
                        <input type="text" id="rem_nom" wire:model="rem_nombre" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <div class="flex items-center m-1 space-x-4">
                        <!-- Etiqueta -->
                        <label for="rencar" class="text-sm font-medium text-primary">
                            Cargo:
                        </label>
                        <!-- Campo de Entrada -->
                        <input type="text" id="rem_cargo" wire:model="rem_cargo" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <div class="flex items-center m-1 space-x-4">
                        <!-- Etiqueta -->
                        <label for="remdep" class="text-sm font-medium text-primary">
                            Dep:
                        </label>
                        <!-- Campo de Entrada -->
                        <input type="text" id="rem_deporg" wire:model="rem_deporg" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <div class="flex items-center m-1 space-x-4">
                        <label for="remdir" class="text-sm font-medium text-primary">
                            Direccion:
                        </label>
                        <input type="text" id="remdir" wire:model="rem_dir" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                </div>
                <div class="col-span-1">
                    <label for="seg" class="block mb-8 text-sm font-medium text-primary">
                        Seguimiento:
                        <button type="button" wire:click="openModalAgent('seguimiento')"
                            class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                            title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                        <button type="button" wire:click="openModalUsers('seguimiento')"
                            class="px-2 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300 relative group ml-1"
                            title="Presiona para seleccionar usuario">
                            <i class="fa-solid fa-user"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar usuario
                            </span>
                        </button>
                    </label>
                    <textarea id="seg" rows="4" spellcheck="true" lang="es" wire:model="seguimiento"
                        class="block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                        placeholder="Escribe aquí...">{{ $seguimiento }}</textarea>
                </div>
                <div class="col-span-1 mb-8">
                    <label for="turnado" class="block mb-8 text-sm font-medium text-primary">
                        Turnado:
                        <button type="button" wire:click="openModalUsers('Turnado')"
                            class="px-2 py-1 text-xs text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300 relative group"
                            title="Presiona para seleccionar usuario">
                            <i class="fa-solid fa-user"></i>
                            <span
                                class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar usuario
                            </span>
                        </button>
                    </label>


                    <div class="flex items-center m-1 space-x-4">
                        <label for="turnom" class="text-sm font-medium text-primary">
                            Nombre;
                        </label>
                        <input type="text" id="tur_nom" wire:model="tur_nom" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <div class="flex items-center m-1 space-x-4">
                        <label for="turcargo" class="text-sm font-medium text-primary">
                            Cargo;
                        </label>
                        <input type="text" id="tur_cargo" wire:model="tur_cargo" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <div class="flex items-center m-1 space-x-4">
                        <label for="turdeporg" class="text-sm font-medium text-primary">
                            Depto:
                        </label>
                        <input type="text" id="tur_deporg" wire:model="tur_deporg" readonly
                            class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                    </div>
                    <!-- Campo oculto para mostrar el rem_id seleccionado (para debugging) -->
                    @if ($rem_id)
                        <div class="flex items-center m-1 space-x-4">
                            <label for="rem_id_debug" class="text-sm font-medium text-primary">
                                ID Usuario:
                            </label>
                            <input type="text" id="rem_id_debug" value="{{ $rem_id }}" readonly
                                class="w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sección de Archivos --}}
            <div class="mt-6 p-4 rounded-lg surface-panel">
                <h3 class="mb-4 text-lg font-semibold text-primary">Archivos Adjuntos</h3>

                {{-- Archivos Existentes --}}
                @if (!empty($existingFiles))
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-primary">Archivos existentes:</h4>
                        <div class="space-y-2">
                            @foreach ($existingFiles as $file)
                                <div class="flex items-center justify-between p-3 rounded surface-panel">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <span class="text-sm text-gray-300">{{ $file->original_name }}</span>
                                            <p class="text-xs text-primary">{{ $file->formatted_file_size }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-icon-action variant="view" icon="fa-regular fa-eye" label="Ver archivo"
                                            :href="$file->url" target="_blank" />

                                        <x-icon-action variant="danger" icon="fa-solid fa-trash" label="Eliminar archivo"
                                            wire:click="deleteExistingFile({{ $file->id }})" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Archivos Nuevos --}}
                @if (!empty($files))
                    <div class="mb-4">
                        <h4 class="mb-2 text-sm font-medium text-primary">Archivos nuevos seleccionados:</h4>
                        <div class="space-y-2">
                            @foreach ($files as $index => $file)
                                <div class="flex items-center justify-between p-2 rounded surface-panel">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="text-sm text-gray-300">{{ $file->getClientOriginalName() }}</span>
                                    </div>
                                    <button type="button" wire:click="removeFile({{ $index }})"
                                        class="text-red-400 hover:text-red-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Input para nuevos archivos --}}
                <div class="space-y-4">
                    <div>
                        <label for="file-{{ count($files) }}" class="block text-sm font-medium mb-2 text-primary">
                            Agregar nuevo archivo PDF
                        </label>
                        <input type="file" id="file-{{ count($files) }}" wire:model="files" accept=".pdf"
                            class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-600 rounded-lg cursor-pointer text-primary input-base">
                        @error('files')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-sm text-primary">
                    <p>• Solo se permiten archivos PDF</p>
                    <p>• Tamaño máximo: 15MB por archivo</p>
                </div>
            </div>

            {{-- {{$users}} --}}
            {{-- {{$users->email}} {{$users->name}} {{$users->id}} --}}
            <div class="mt-6 flex items-center justify-end gap-2">
                <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md"
                    wire:click="cancel" />
                <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Actualizar registro"
                    size="md" type="submit" />
            </div>

            <!-- Nueva tabla -->
            {{-- <div class="mt-4">
                <table class="w-full border-collapse border border-gray-300">
                    <tr>
                        <!-- Primera columna - Textarea -->
                        <td class="w-1/4 border border-gray-300 p-2">
                            <button type="button" wire:click="openModalAgent('columna1')" class="w-full px-4 py-2 mb-2 text-white bg-pink-600 rounded-md hover:bg-pink-700 focus:ring focus:ring-pink-300">
                                t1
                            </button>
                            <textarea
                                id="textarea_1"
                                name="textarea_1"
                                rows="4"
                                wire:model="textarea_1"
                                class="block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                                placeholder="Escribe aquí..."></textarea>
                        </td>
                        <!-- Segunda columna - Textarea -->
                        <td class="w-1/4 border border-gray-300 p-2">
                            <button type="button" wire:click="openModalAgent('columna2')" class="w-full px-4 py-2 mb-2 text-white bg-pink-600 rounded-md hover:bg-pink-700 focus:ring focus:ring-pink-300">
                                t2
                            </button>
                            <textarea
                                id="textarea_2"
                                name="textarea_2"
                                rows="4"
                                wire:model="textarea_2"
                                class="block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base"
                                placeholder="Escribe aquí..."></textarea>
                        </td>
                        <!-- Tercera columna - 4 inputs -->
                        <td class="w-1/4 border border-gray-300 p-2">
                            <button type="button" wire:click="openModalAgent('columna3')" class="w-full px-4 py-2 mb-2 text-white bg-pink-600 rounded-md hover:bg-pink-700 focus:ring focus:ring-pink-300">
                                input1
                            </button>
                            <div class="space-y-2">
                                <input type="text" id="input_3_1" name="input_3_1" wire:model="input_3_1" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 1">
                                <input type="text" id="input_3_2" name="input_3_2" wire:model="input_3_2" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 2">
                                <input type="text" id="input_3_3" name="input_3_3" wire:model="input_3_3" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 3">
                                <input type="text" id="input_3_4" name="input_3_4" wire:model="input_3_4" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 4">
                            </div>
                        </td>
                        <!-- Cuarta columna - 4 inputs -->
                        <td class="w-1/4 border border-gray-300 p-2">
                            <button type="button" wire:click="openModalAgent('columna4')" class="w-full px-4 py-2 mb-2 text-white bg-pink-600 rounded-md hover:bg-pink-700 focus:ring focus:ring-pink-300">
                                input 2
                            </button>
                            <div class="space-y-2">
                                <input type="text" id="input_4_1" name="input_4_1" wire:model="input_4_1" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 1">
                                <input type="text" id="input_4_2" name="input_4_2" wire:model="input_4_2" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 2">
                                <input type="text" id="input_4_3" name="input_4_3" wire:model="input_4_3" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 3">
                                <input type="text" id="input_4_4" name="input_4_4" wire:model="input_4_4" class="block w-full p-1 text-xs border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base" placeholder="Campo 4">
                            </div>
                        </td>
                    </tr>
                </table>
            </div> --}}

            {{-- <div class="mt-4">
                <button
                        type="button"
                        wire:click="openModalAgent"
                        class="w-full px-4 py-2 text-white bg-pink-600 rounded-md hover:bg-pink-700 focus:ring focus:ring-pink-300">
                    Abrir Modal de Ages
                </button>
            </div> --}}
        </form>
    </div>
    <!-- Modal toggle -->
    <!-- Modal de descripcion -->
    <div id="modal_des" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full h-full max-h-full overflow-x-hidden overflow-y-auto bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-4xl rounded-lg shadow modal-elevated">
            <!-- Modal header -->
            <div class="flex items-center justify-between px-4 py-3 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-primary">
                    Usuarios
                </h3>
                <button type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal_des">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-4 space-y-4">
                <table class="w-full text-sm text-left text-primary">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center px-4 py-3 border-t dark:border-gray-700">
                <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" data-modal-hide="modal_des" />
            </div>
        </div>
    </div>
    {{-- =============================== --}}
    {{--      MODAL ESTÁTICO DE AGES     --}}
    {{-- =============================== --}}
    <!-- Modal para selección de agentes -->
    <div x-data="{ show: @entangle('isAgeModalOpen') }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="show"
                class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-elevated">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 surface-panel">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-primary">
                                Seleccionar Agente
                            </h3>
                            <div class="mt-2">
                                <input type="text" wire:model.live="modalAgeFilter" placeholder="Buscar agente..."
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-primary input-base">
                            </div>
                            <div class="mt-4 max-h-96 overflow-y-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                                Nombre</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                                Cargo</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                                Dependencia</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                                Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($modalAges as $age)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                                                    {{ $age->nombre }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                                                    {{ $age->cargo }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                                                    {{ $age->deporg }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                                                    <x-icon-action variant="success" icon="fa-solid fa-check" label="Seleccionar" wire:click="selectAgeFromModal({{ $age->des }})" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse surface-panel">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeAgeModal" />
                </div>
            </div>
        </div>
    </div>

    @if ($showModalAgent)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div
                class="w-full h-1/2 mx-4 rounded-2xl shadow-lg border border-white flex flex-col surface-panel">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-white">
                    <h3 class="text-lg font-semibold text-primary">
                        Lista de Ages -
                        {{ $selectedColumn ? 'Columna ' . str_replace('columna', '', $selectedColumn) : '' }}
                    </h3>
                    <button wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filtros -->
                <div class="p-4 border-b border-white">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-primary">Nombre</label>
                            <input wire:model.live.debounce.300ms="searchNombre" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por nombre">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary">Cargo</label>
                            <input wire:model.live.debounce.300ms="searchCargo" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por cargo">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-primary">Departamento</label>
                            <input wire:model.live.debounce.300ms="searchDeporg" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por departamento">
                        </div>
                    </div>
                </div>

                <!-- Tabla de Ages -->
                <div class="flex-1 overflow-y-auto p-4">
                    <table class="w-full text-sm text-left text-primary">
                        <thead class="text-xs uppercase text-primary">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Cargo</th>
                                <th class="px-6 py-3">Departamento</th>
                                <th class="px-6 py-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalAges as $age)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $age->id }}</td>
                                    <td class="px-6 py-4">{{ $age->nombre }}</td>
                                    <td class="px-6 py-4">{{ $age->cargo }}</td>
                                    <td class="px-6 py-4">{{ $age->deporg }}</td>
                                    <td class="px-6 py-4">
                                        <x-icon-action variant="success" icon="fa-solid fa-check" label="Seleccionar" wire:click="selectAgeFromModal({{ $age->id }})" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="p-4 border-t border-white">
                    {{ $modalAges->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Usuarios para Turnado y Remitente -->
    @if ($showModalUsers)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div
                class="w-full h-1/2 mx-4 rounded-2xl shadow-lg border border-white flex flex-col surface-panel">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-white">
                    <h3 class="text-lg font-semibold text-primary">
                        Lista de Usuarios - {{ $selectedUserColumn ? $selectedUserColumn : '' }}
                    </h3>
                    <button wire:click="closeModalUsers"
                        class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filtros -->
                <div class="p-4 border-b border-white">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-primary">Nombre</label>
                            <input wire:model.live.debounce.300ms="searchUserName" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por nombre">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary">Cargo</label>
                            <input wire:model.live.debounce.300ms="searchUserPosition" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por cargo">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary">Dirección</label>
                            <input wire:model.live.debounce.300ms="searchUserDirection" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 text-primary input-base"
                                placeholder="Buscar por dirección">
                        </div>
                    </div>
                </div>

                <!-- Tabla de Usuarios -->
                <div class="flex-1 overflow-y-auto p-4">
                    <table class="w-full text-sm text-left text-primary">
                        <thead class="text-xs uppercase text-primary">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Cargo</th>
                                <th class="px-6 py-3">Dirección</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalUsers as $user)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->position }}</td>
                                    <td class="px-6 py-4">{{ $user->direction }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <x-icon-action variant="success" icon="fa-solid fa-check" label="Seleccionar" wire:click="selectUserFromModal({{ $user->id }})" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="p-4 border-t border-white">
                    {{ $modalUsers->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
