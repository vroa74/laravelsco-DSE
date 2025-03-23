<div>

    <div class="max-w-2sm mx-auto mx-1  bg-gray-900  border-amber-200 rounded-lg shadow-md">
        <h2 class="text-md text-center text-white font-bold mb-0">Formulario de Registro</h2>
        <form  method="POST" class=" text-white m-4">
            @csrf
{{-------------------------------------------------------------------------------------------------------}}
            <div>
                <label
                    for="lleg"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nivel de Correspondencia
                </label>
                <select
                        id="lleg"
                        wire:model.live="legislatura"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($legs as $item)
                        <option value="{{$item->legislatura}}"  @if($item->actual) selected @endif>
                            {{$item->legislatura}}
                        </option>
                    @endforeach
                </select>
            </div>
           {{---------------------------------------------------------------------------------------------}}
            <div class="grid grid-rows-2 grid-cols-4 gap-4">
                <!-- Columna 1 -->
                <div class="col-span-1 flex items-center gap-2 w-full">
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
                        class="w-3/4 p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <!-- Columna 2 -->
                <div class="col-span-1 flex items-center gap-2 w-full">
                    <label
                        for="ffrec"
                        wire:model.live="frec"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de recepcion</label>
                    <input
                        type="date"
                        id="ffrec"
                        class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="col-span-1 flex items-center gap-2 w-full">
                    <label
                        for="nncor"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nivel de Correspondencia
                    </label>
                    <select
                             id="nncor"
                             wire:model.live="ncor"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        @foreach($ncors as $item)
                            <option value="{{$item->ncor}}"> {{$item->ncor}} </option>
                        @endforeach
                    </select>
                </div>
                <!-- Columna 4 -->
                <div class="col-span-1 flex items-center gap-2 w-full">
                        <label
                            for="tncor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipo de Correspondencia
                        </label>
                        <select id="tncor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:change="selectCorrespondence($event.target.value, $event.target.options[$event.target.selectedIndex].text)">
                            <option selected>Elija el Tipo de Correspondencia</option>
                            @foreach($tcors as $item)
                                <option value="{{ $item['id'] }}">{{ $item['tcor'] }}</option>
                            @endforeach
                        </select>
                        <!-- Mostrar los valores seleccionados -->
                        @if($selectedId && $selectedTcor)
                            <p class="mt-4 text-sm text-gray-700">
                                Seleccionaste: <strong>{{ $selectedTcor }}</strong> (ID: <strong>{{ $selectedId }}</strong>)
                            </p>
                        @endif
{{--                    <p>{{ $ftcorid }}  - {{$ftcor}}  :: {{$tcor}} </p>--}}
                </div>
                <!-- Fila 2 - Columna 1 ---------------------------------------------------------------------------------------------------------->
                <div class="col-span-1 flex items-center gap-2 w-full">
                    <label
                        for="cccor"
                        wire:model.live="ccor"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Clasificacion de Correspondencia
                    </label>
                    <select id="cccor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        @foreach($tcors as $item)
                            <option value="{{$item->tcor}}"> {{$item->tcor}} </option>
                        @endforeach
                    </select>
                </div>
                <!-- Fila 2 - Columna 2 -->

                <div class="col-span-1 flex items-center gap-2 w-full">
                        <label
                            for="nnh"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. de hojas
                        </label>
                        <input
                            type="number"
                            id="nnh"
                            wire:model.live="nhoj"
                            class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <!-- Fila 2 - Columna 3 -->
                <div class="col-span-1 flex items-center gap-2 w-full">
                        <label
                            for="nno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. de Oficio
                        </label>
                        <input
                            type="text"
                            id="nno"
                            wire:model.live="nofi"
                            class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <!-- Fila 2 - Columna 4 -->
                <div class="col-span-1 flex items-center gap-2 w-full">
                        <label
                            for="ffo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fecha del oficio
                        </label>
                        <input
                            type="date"
                            id="ffo"
                            wire:model.live="fofi"
                            class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></div>
            </div>
{{------------------------------------------------------------------------------------------------------------------}}
            <div class="grid grid-rows-2 grid-cols-2 gap-4">
                <!-- Fila 1 - Columna 1 -->
                <div class="col-span-1 m-4">
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
                        placeholder="Escribe tus pensamientos aquí..."></textarea>
                    <button
                             data-modal-target="modal_des"
                             data-modal-toggle="modal_des"
                             class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                                     font-medium rounded-lg text-xs px-2 py-1 m-0.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                                     dark:focus:ring-blue-800"
                             type="button">
                        Ins. Nombre
                    </button>

                </div>
                <div class="col-span-1 m-4">
                    <p class="py-1" >Remitente</p>
                    <div class="flex items-center space-x-4 m-1 ">
                        <!-- Etiqueta -->
                        <label for="remnom" class="text-sm font-medium text-gray-900 dark:text-white">
                            Nombre:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="remnom"
                            wire:model="rem_nombre"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center space-x-4 m-1 ">
                        <!-- Etiqueta -->
                        <label for="rencar" class="text-sm font-medium text-gray-900 dark:text-white">
                            Cargo:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="rencar"
                            wire:model="rem_cargo"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center space-x-4 m-1 ">
                        <!-- Etiqueta -->
                        <label for="remdep" class="text-sm font-medium text-gray-900 dark:text-white">
                            Dep:
                        </label>
                        <!-- Campo de Entrada -->
                        <input
                            type="text"
                            id="remdep"
                            wire:model="rem_deporg"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center space-x-4 m-1 ">
                            <label for="remdir" class="text-sm font-medium text-gray-900 dark:text-white">
                                Direccion:
                            </label>
                            <input
                                type="text"
                                id="remdir"
                                wire:model="rem_dir"
                                class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <button
                        type="button"
                        class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buscar
                    </button>
                </div>
                <div class="col-span-1 ">
                    <label
                               for="seg"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Seguimiento
                    </label>
                    <textarea
                             id="seg"
                             rows="4"
                             class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                    <button
                        type="button"
                        class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Extra small</button>
                </div>
                <div class="col-span-1 ">
                    <p>Turnado</p>
                    <div class="flex items-center space-x-4 m-1 ">
                        <label for="turnom" class="text-sm font-medium text-gray-900 dark:text-white">
                         Nombre;
                        </label>
                        <input
                            type="text"
                            id="turnom"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center space-x-4 m-1 ">
                        <!-- Etiqueta -->
                        <label for="turcar" class="text-sm font-medium text-gray-900 dark:text-white">
                            Cargo:
                        </label>
                        <input
                            type="text"
                            id="turcar"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center space-x-4 m-1 ">
                        <label for="turdep" class="text-sm font-medium text-gray-900 dark:text-white">
                            Dep.:
                        </label>
                        <input
                            type="text"
                            id="turdep"
                            class="w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <button
                        type="button"
                        class="px-3 py-2 m-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Extra small</button>
                </div>

            </div>
            {{$users}}
            <br>
            <hr>
            <br>
            {{$users->email}} {{$users->name}} {{$users->id}}
            <br>
            <hr class="bg-orange-600 text-orange-500 p-4" >
            <br>
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
        class="hidden fixed top-0 right-0 left-0 z-50 w-full h-full max-h-full overflow-y-auto overflow-x-hidden justify-center items-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-4xl bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between px-4 py-3 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Usuarios
                </h3>
                <button
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                    class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg text-white">
                    Cerrar
                </button>
            </div>
        </div>
    </div>



</div>
