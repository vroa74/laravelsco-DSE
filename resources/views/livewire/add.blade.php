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
        <h2 class="mb-0 font-bold text-center text-white text-md">Formulario de Registro</h2>
        {{-- //! Formulario de Registro --}}
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
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Descripcion
                    </label>
                    <textarea
                        id="des"
                        rows="4"
                        spellcheck="true"
                        lang="es"
                        wire:model.live="des"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Escribe aquí..."></textarea>
                        <button type="button" wire:click="openAgeModal('DES')"
                        class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Buscar Usuario
                        </button>

                </div>
                <div class="col-span-1 m-4">
                    <p class="py-1" >Remitente</p>
                    <div class="flex items-center m-1 space-x-4 ">
                        <!-- Etiqueta -->
                        <label for="remnom" class="text-sm font-medium text-gray-900 dark:text-white">
                            Nombre:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="remnom"
                            wire:model="rem_nombre"
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
                            id="rencar"
                            wire:model="rem_cargo"
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
                            id="remdep"
                            wire:model="rem_deporg"
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
                                class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    {{-- Botón para abrir modal y llenar Remitente --}}
                    <button type="button" wire:click="openAgeModal('REM')"
                            class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Buscar Usuario
                    </button>
                    
                </div>
                <div class="col-span-1 ">
                    <label for="seg"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Seguimiento
                    </label>
                    <textarea id="seg"
                            rows="4"
                            spellcheck="true"
                            lang="es"
                            wire:model.live="seguimiento"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Escribe aquí...">
                        </textarea>
                        <button type="button" wire:click="openAgeModal('SEG')"
                        class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Buscar Usuario
                        </button>
            </div>
                <div class="col-span-1 ">
                    <p>Turnado</p>
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turnom" class="text-sm font-medium text-gray-900 dark:text-white">
                            Nombre;
                        </label>
                        <input  type="text" id="turnom" wire:model="tur_nom"
                                class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turcargo" class="text-sm font-medium text-gray-900 dark:text-white">
                            Cargo;
                        </label>
                        <input  type="text" id="turcargo" wire:model="tur_cargo"
                                class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center m-1 space-x-4 ">
                        <label for="turdeporg" class="text-sm font-medium text-gray-900 dark:text-white">
                            Depto:
                        </label>
                        <input  type="text" id="turdeporg" wire:model="tur_deporg"
                                class="w-full p-1 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    {{-- Botón para abrir modal y llenar Turnado --}}
                    <button type="button" wire:click="openAgeModal('TUR')"
                            class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Buscar Usuario
                    </button>
                </div>
            </div>
            {{-- {{$users}} --}}
            {{-- {{$users->email}} {{$users->name}} {{$users->id}} --}}
            <div class="mt-6">
                <button
                        type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300">
                    Guardar
                </button>
            </div>
        </form>
    </div>
    <!-- Modal toggle -->
    <!-- Modal de descripcion -->
    <div
        id="modal_des"
        tabindex="-1"
        aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full h-full max-h-full overflow-x-hidden overflow-y-auto bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-4xl bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between px-4 py-3 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Usuarios
                </h3>
                <button
                    type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal_des">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-4 space-y-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ages as $age)
                        <tr class="border-b dark:border-gray-700">
                            <td>{{ $age->id }}</td>
                            <td>{{ $age->name }}</td>
                            <td>{{ $age->age }}</td>
                            <td>
                                <button class="text-blue-600 dark:text-blue-400">Editar</button>
                                <button class="text-red-600 dark:text-red-400">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center px-4 py-3 border-t dark:border-gray-700">
                <button
                    type="button"
                    data-modal-hide="modal_des"
                    class="px-4 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
    {{-- =============================== --}}
    {{--      MODAL ESTÁTICO DE AGES     --}}
    {{-- =============================== --}}
    @if($isAgeModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75">
            <div class="w-full max-w-5xl p-6 mx-4 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Seleccionar de Agenda - {{ $accion }}</h3>
                    <button wire:click="closeAgeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                {{-- Input de Filtro --}}
                <div class="my-4">
                    <label for="ageFilterInput" class="sr-only">Filtrar Agenda</label>
                    <input type="text" id="ageFilterInput" 
                            wire:model.live.debounce.300ms="modalAgeFilter"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Filtrar por nombre, cargo, dependencia...">
                </div>
                {{-- Tabla de Resultados --}}
                <div class="overflow-auto" style="max-height: 60vh;"> {{-- Limita la altura y permite scroll --}}
                    <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"> {{-- Cabecera fija --}}
                            <tr>
                                <th scope="col" class="px-4 py-2">Nombre</th>
                                <th scope="col" class="px-4 py-2">Cargo</th>
                                <th scope="col" class="px-4 py-2">Dependencia</th>
                                <th scope="col" class="px-4 py-2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($modalAges as $age)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $age->titulo }} {{ $age->nombre }} {{ $age->apaterno }} {{ $age->amaterno }}
                                    </td>
                                    <td class="px-4 py-2">{{ $age->cargo }}</td>
                                    <td class="px-4 py-2">{{ $age->deporg }}</td>
                                    <td class="px-4 py-2">
                                        <button wire:click="selectAgeFromModal({{ $age->id }})" 
                                                class="px-2 py-1 text-xs font-medium text-center text-white bg-blue-700 rounded hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No se encontraron registros con ese filtro.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>                
                {{-- Botón de Cerrar inferior (opcional) --}}
                <div class="flex justify-end pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                    <button wire:click="closeAgeModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-800">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
