<div>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
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

    <div class="mx-auto bg-gray-900 rounded-lg shadow-md max-w-2sm border-amber-200">
        <h2 class="mb-0 font-bold text-center text-white text-md">Formulario de Edición</h2>
        {{-- //! Formulario de Edición --}}
        <form wire:submit="save" class="m-4 text-white ">
            @csrf
            <div>
                <label
                    for="lleg"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Legislatura
                </label>
                {{-- //! hay que corregir que no queda selecionada la legislatura actual --}}
                <select
                        id="lleg"
                        wire:model="selectedLegislaturaId"
                        class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Seleccione...</option>
                    @foreach($legs as $item)
                        <option value="{{$item->id}}">{{$item->legislatura}}</option>
                    @endforeach
                </select>
            </div>
{{---------------------------------------------------------------------------------------------}}
            <div class="grid grid-cols-4 grid-rows-2 gap-4">
                <!-- Columna 1 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <!-- Etiqueta -->
                    <label
                        for="ffcap"
                        class="w-1/4 text-sm font-medium text-gray-900 dark:text-white">
                        Fecha de Captura
                    </label>
                    <!-- Campo de Entrada -->
                    <input
                        type="date"
                        id="ffcapt"
                        wire:model.live="fcap"
                        class="w-3/4 p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <!-- Columna 2 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label
                        for="ffrec"
                        wire:model.live="frec"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de recepcion</label>
                    <input
                        type="date"
                        id="ffrec"
                        wire:model.live="frec"
                        class="block w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label
                        for="nncor"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nivel de Correspondencia
                    </label>
                    <select
                            id="nncor"
                            wire:model.live="ncor"
                            class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecione el Nivel:</option>
                        @foreach($ncors as $item)
                            <option value="{{$item->ncor}}"> {{$item->ncor}} </option>
                        @endforeach
                    </select>
                    {{ $ncor }} 
                </div>
                <!-- Columna 4 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                        <label
                            for="tncor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipo de Correspondencia
                        </label>
                        <select id="tcorSelect"
                                class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model.live="tcccid"
                                x-data="{ selectedText: '' }"
                                x-on:change="selectedText = $event.target.options[$event.target.selectedIndex].text">
                            <option value="">Seleccione una opción</option>
                            @foreach($tcc as $items)
                                <option value="{{ $items->id }}" data-text="{{ $items->tcor }}">{{ $items->tcor }}</option>
                            @endforeach
                        </select>
                        
                        <input type="hidden" wire:model="tccctext" x-bind:value="selectedText">
                </div>
                <!-- Fila 2 - Columna 1 ---------------------------------------------------------------------------------------------------------->
                <div class="flex items-center w-full col-span-1 gap-2">
                    <label
                        for="cccor"
                        wire:model.live="ccor"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Clasificacion de Correspondencia
                    </label>
                    <select id="cccor" 
                            wire:model.live="ccor"
                            class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @if(!$isCccorEnabled) disabled @endif>
                        <option selected>Selecione la Clasificacion:</option>
                        @foreach($filteredCcor as $item)
                            <option value="{{$item->tcor}}"> {{$item->ccor}} </option>
                        @endforeach
                    </select>
                </div>
                <!-- Fila 2 - Columna 2 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                        <label
                            for="nnh"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. de hojas
                        </label>
                        <input
                            type="number"
                            id="nnh"
                            wire:model.live="nhoj"
                            class="block w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <!-- Fila 2 - Columna 3 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                        <label
                            for="nno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. de Oficio
                        </label>
                        <input
                            type="text"
                            id="nno"
                            wire:model.live="nofi"
                            class="block w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <!-- Fila 2 - Columna 4 -->
                <div class="flex items-center w-full col-span-1 gap-2">
                        <label
                            for="ffo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fecha del oficio
                        </label>
                        <input
                            type="date"
                            id="ffo"
                            wire:model.live="fofi"
                            class="block w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></div>
            </div>
{{------------------------------------------------------------------------------------------------------------------}}
            <div class="grid grid-cols-2 grid-rows-2 gap-4">
                <!-- Fila 1 - Columna 1 -->
                <div class="col-span-1">
                    <label
                                for="des"
                                class="block mb-8 text-sm font-medium text-gray-900 dark:text-white">
                        Descripcion: 
                        <button type="button" 
                        wire:click="openModalAgent('des')" 
                        class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                        title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                    </button>
                    </label>                     
                    <textarea
                        id="des"
                        rows="4"
                        spellcheck="true"
                        lang="es"
                        wire:model.live="des"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Escribe aquí...">{{ $des }}</textarea>
                </div>
                <div class="col-span-1 m-4">
                        <p class="py-1 mb-8 " >Remitente:   
                        <button type="button" 
                        wire:click="openModalAgent('Remitente')" 
                        class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                        title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                    </p>
                    <div class="flex items-center m-1 space-x-4 ">
                        <!-- Etiqueta -->
                        <label  for="remnom" 
                                class="text-sm font-medium text-gray-900 dark:text-white">
                            Nombre:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="rem_nom"
                            wire:model="rem_nombre"
                            readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <!-- Etiqueta -->
                        <label for="rencar" class="text-sm font-medium text-gray-900 dark:text-white">
                            Cargo:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="rem_cargo"
                            wire:model="rem_cargo"
                            readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <!-- Etiqueta -->
                        <label for="remdep" class="text-sm font-medium text-gray-900 dark:text-white">
                            Dep:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="rem_deporg"
                            wire:model="rem_deporg"
                            readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                            <label for="remdir" class="text-sm font-medium text-gray-900 dark:text-white">
                                Direccion:
                            </label>
                            <input
                                type="text"
                                id="remdir"
                                wire:model="rem_dir"
                                readonly
                                class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div class="col-span-1 ">
                    <label for="seg"
                                class="block mb-8  text-sm font-medium text-gray-900 dark:text-white">
                        Seguimiento:
                        <button type="button" 
                        wire:click="openModalAgent('seguimiento')" 
                        class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                        title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                    </label>
                    <textarea   id="seg"
                                rows="4"
                            spellcheck="true"
                            lang="es"
                            wire:model.live="seguimiento"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Escribe aquí...">{{ $seguimiento }}</textarea>
                        </textarea>
                </div>
                <div class="col-span-1 mb-8">
                    <label for="turnado" class="block mb-8 text-sm font-medium text-gray-900 dark:text-white">
                        Turnado:
                        <button type="button" 
                        wire:click="openModalAgent('Turnado:')" 
                        class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md hover:bg-orange-700 focus:ring focus:ring-orange-300 relative group"
                        title="Presiona para seleccionar">
                            <i class="fa-solid fa-users"></i>
                            <span class="absolute hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                Presiona para seleccionar
                            </span>
                        </button>
                    </label>

                    
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turnom" class="text-sm font-medium text-gray-900 dark:text-white">
                            Nombre;
                        </label>
                        <input  type="text" 
                                id="tur_nom" 
                                wire:model="tur_nom"
                                readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turcargo" class="text-sm font-medium text-gray-900 dark:text-white">
                            Cargo;
                        </label>
                        <input  type="text" 
                                id="tur_cargo" 
                                wire:model="tur_cargo"
                                readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turdeporg" class="text-sm font-medium text-gray-900 dark:text-white">
                            Depto:
                        </label>
                        <input  type="text" 
                                id="tur_deporg" 
                                wire:model="tur_deporg"
                                readonly
                            class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button
                        type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    @if($showModalAgent)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full h-1/2 mx-4 bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-white flex flex-col">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b border-white">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Lista de Ages - {{ $selectedColumn ? 'Columna ' . str_replace('columna', '', $selectedColumn) : '' }}
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Filtros -->
            <div class="p-4 border-b border-white">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input wire:model.live="searchNombre" type="text" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Buscar por nombre">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                        <input wire:model.live="searchCargo" type="text" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Buscar por cargo">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departamento</label>
                        <input wire:model.live="searchDeporg" type="text" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Buscar por departamento">
                    </div>
                </div>
            </div>

            <!-- Tabla de Ages -->
            <div class="flex-1 overflow-y-auto p-4">
                <table class="w-full text-sm text-left text-gray-900 dark:text-white">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Cargo</th>
                            <th class="px-6 py-3">Departamento</th>
                            <th class="px-6 py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modalAges as $age)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $age->id }}</td>
                            <td class="px-6 py-4">{{ $age->nombre }}</td>
                            <td class="px-6 py-4">{{ $age->cargo }}</td>
                            <td class="px-6 py-4">{{ $age->deporg }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="selectAgeFromModal({{ $age->id }})" 
                                    class="px-2 py-1 text-xs font-medium text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                                    Seleccionar
                                </button>
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
</div> 