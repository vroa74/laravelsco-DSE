<div >

    <div class="text-right">
        <!-- Botón -->
    </div>   {{--    fin del div de lo botones--}}

    <div id="accordion-collapse" class="text-center items-center w-[99%] mx-auto">
        <h2 id="accordion-collapse-heading-1">
            <div class="relative">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-stretch">
                    <!-- Botón de filtros -->
                    <button
                        type="button"
                        class="flex w-full items-center justify-between gap-3 rounded-xl border border-gray-700 bg-blue-950 px-4 py-2.5 text-sm font-medium text-gray-200 transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-gray-700 sm:flex-1"
                        wire:click="toggleAccordion"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="accordion-collapse-body-1">
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                            Filtros
                        </span>

                        <svg
                            class="w-5 h-5 transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>

                    <!-- Acciones de la barra: solo iconos con tooltip -->
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-end">
                        <x-icon-action variant="success" icon="fa-regular fa-square-plus" label="Agregar registro"
                            wire:click="openInsertModal" />

                        <x-icon-action variant="danger" icon="fa-solid fa-file-pdf" label="Exportar a PDF"
                            wire:click="exportPDF" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" />

                        <x-icon-action variant="info" icon="fa-solid fa-filter" label="Aplicar filtros"
                            wire:click="openViewQuery" />
                    </div>
                </div>
            </div>
        </h2>

        <div id="accordion-collapse-body-1"
             class="{{ $isOpen ? '' : 'hidden' }} p-1 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            {{--      begin section containes filter--}}


            <div class="grid grid-cols-1 gap-1 w-full h-full px-2 text-xs text-white sm:grid-cols-2 sm:px-4 xl:grid-cols-4">
                <div class="border-2 border-gray-300 rounded-lg p-1 items-center text-center space-y-1">
                    {{-- inline-block se usa para un tamaño especifico           --}}
                    Mostrar::
                    <select
                        id="countries"
                        wire:model.live="perPage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 inline-block w-auto p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="10" selected>Registros a mostrar</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                    Registros. -  {{  $perPage }}
                    {{-- estatus --}}
                    <p>Total de registros: {{ $ages->total() }}</p>
                    {{--                        <p>{{ $myquery }}</p>--}}
                </div>
                <div class="border-2 border-gray-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label
                            for="nombre"
                            class="text-sm text-gray-900 dark:text-white">Nombre</label>
                        <input type="text"
                               id="nombre"
                               placeholder="nombre"
                               wire:model.live="filnombre"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label
                            for="apa"
                            class="text-sm text-gray-900 dark:text-white">Ap. Pat.</label>
                        <input type="text"
                               id="apa"
                               placeholder="Apellido Paterno"
                               wire:model.live="filapaterno"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label
                            for="ama"
                            class="text-sm text-gray-900 dark:text-white">Ap. Mat.</label>
                        <input type="text"
                               id="ama"
                               placeholder="Apellido Materno"
                               wire:model.live="filamaterno"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                </div>
                <div class="border-2 border-gray-300 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label
                            for="cargo"
                            class="text-sm text-gray-900 dark:text-white">Cargo</label>
                        <input type="text"
                               id="cargo"
                               placeholder="Cargo"
                               wire:model.live="filcargo"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label
                            for="dep"
                            class="text-sm text-gray-900 dark:text-white">Dep. Org.</label>
                        <input type="text"
                               id="dep"
                               placeholder="Dep. Org."
                               wire:model.live="fildeporg"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                </div>
                <div class="border-2 border-gray-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label
                            for="tel"
                            class="text-sm text-gray-900 dark:text-white">Telefono</label>
                        <input type="text"
                               id="tel"
                               placeholder="Telefono"
                               wire:model.live="filtelefono"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label
                            for="email"
                            class="text-sm text-gray-900 dark:text-white">E-mail</label>
                        <input type="text"
                               id="email"
                               placeholder="Email"
                               wire:model.live="filemail"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label
                            for="dir"
                            class="text-sm text-gray-900 dark:text-white">Direccion</label>
                        <input type="text"
                               id="dir"
                               placeholder="Direccion"
                               wire:model.live="fildir"
                               class="p-1 border rounded bg-gray-50 text-xs dark:bg-gray-700" style="width: 150px;">
                    </div>
                </div>
            </div>

            {{--      end section containes filter--}}

        </div>
    </div>
    {{--         ------------------------------------------------------------------------------------------------------------}}
    <div class="relative pt-1 px-4 shadow-md sm:rounded-lg">
        <div class="mx-auto w-full sm:w-[96%]">
            <table class="tabla-apilada rounded-2xl text-xs text-left rtl:text-right text-gray-500
                          dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-blue-900
                              dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 w-12">Folio</th>
                    <th class="px-6 py-3 w-20">Título</th>
                    <th class="px-6 py-3 w-32">Nombre</th>
                    <th class="px-6 py-3 w-32">Ap. Paterno</th>
                    <th class="px-6 py-3 w-32">Ap. Materno</th>
                    <th class="px-6 py-3 w-40">Cargo</th>
                    <th class="px-6 py-3 w-40">Dep. Org.</th>
                    <th class="px-6 py-3 w-28">Teléfono</th>
                    <th class="px-6 py-3 w-40">Email</th>
                    <th class="px-6 py-3 w-48">Dirección</th>
                    <th class="px-6 py-3 text-right  w-[150px]">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if($ages->count() > 0)
                    @foreach($ages as $items)
                        <tr class="bg-white border-b text-xs dark:bg-gray-800 dark:border-gray-700
                                    hover:bg-gray-50 dark:hover:bg-gray-950">
                            <th scope="row"
                                class="px-3 py-3 font-medium text-gray-900 dark:text-white md:w-12 md:px-6 md:py-4"
                                data-label="Folio">
                                {{ $items->id }}
                            </th>
                            <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="Título">{{ $items->titulo }}</td>
                            <td class="px-3 py-3 md:w-32 md:px-6 md:py-4" data-label="Nombre">{{ $items->nombre }}</td>
                            <td class="px-3 py-3 md:w-32 md:px-6 md:py-4" data-label="Ap. paterno">{{ $items->apaterno }}</td>
                            <td class="px-3 py-3 md:w-32 md:px-6 md:py-4" data-label="Ap. materno">{{ $items->amaterno }}</td>
                            <td class="px-3 py-3 md:w-40 md:px-6 md:py-4" data-label="Cargo">{{ $items->cargo }}</td>
                            <td class="px-3 py-3 md:w-40 md:px-6 md:py-4" data-label="Dep. org.">{{ $items->deporg }}</td>
                            <td class="px-3 py-3 md:w-28 md:px-6 md:py-4" data-label="Teléfono">{{ $items->telefono }}</td>
                            <td class="px-3 py-3 md:w-40 md:px-6 md:py-4" data-label="Email">{{ $items->email }}</td>
                            <td class="px-3 py-3 md:w-48 md:px-6 md:py-4" data-label="Dirección">{{ $items->dir }}</td>
                            <td class="px-3 py-3 text-right md:w-[150px] md:px-6 md:py-4" data-label="Acciones">
{{--                                seccion de botones de acciones de la tabla--}}
                                <button
                                    wire:click="showRecord({{ $items->id }})"
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span class="relative px-1 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                </button>

                                <button wire:click="editRecord({{ $items->id }})"
                                          class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                               overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                               bg-gradient-to-br from-yellow-300 to-orange-600
                                               group-hover:from-yellow-500 group-hover:to-orange-700 hover:text-white
                                               dark:text-white focus:ring-4 focus:outline-none focus:ring-yellow-200
                                               dark:focus:ring-yellow-800">
                                    <span class="relative px-1.5 py-1 transition-all ease-in duration-75
                                                bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                 <i class="fa-solid fa-pen-to-square"></i>
                                   </span>
                                </button>
                                <button wire:click="confirmDelete({{ $items->id }})"
                                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                               overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                               bg-gradient-to-br from-red-600 to-orange-400
                                               group-hover:from-red-500 group-hover:to-orange-700 hover:text-white
                                               dark:text-white focus:ring-4 focus:outline-none focus:ring-red-200
                                               dark:focus:ring-red-800">
                                    <span class="relative px-1.5 py-1 transition-all ease-in duration-75
                                                bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                 <i class="fa-solid fa-trash-can"></i>
                                   </span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="px-3 py-3 text-center text-gray-500">
                            No se encontraron registros.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <br>
        @if($ages->count() > 0)
        {{$ages}}
    </div>
{{--    begin modal  -------------------------------------------------------------------------------------------------}}

    @if($selectedRecord)
        <div id="record-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-2xl h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detalles del Registro
                    </h3>
                    <button wire:click="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4 bg-gray-500 text-white">
                    <p><strong>ID:</strong> {{ $selectedRecord->id }}</p>
                    <p><strong>Nombre:</strong> {{ $selectedRecord->nombre }}</p>
                    <p><strong>Apellido Paterno:</strong> {{ $selectedRecord->apaterno }}</p>
                    <p><strong>Apellido Materno:</strong> {{ $selectedRecord->amaterno }}</p>
                    <p><strong>Cargo:</strong> {{ $selectedRecord->cargo }}</p>
                    <p><strong>Departamento:</strong> {{ $selectedRecord->deporg }}</p>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                </div>
            </div>
        </div>
    @endif
{{--    ----------------------------------------------------------------------------}}
{{--  Begin Modal de edir registro--}}
    @if($editRecordId)
        <div id="edit-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-2xl h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Editar Registro
                    </h3>
                    <button wire:click="closeEditModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4 bg-gray-900 p-1">

                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Título:</label>
                            <input wire:model="editTitulo" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <!-- Fila 1, Columna 2 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Nombre:</label>
                            <input wire:model="editNombre" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <!-- Fila 2, Columna 1 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Apellido Paterno:</label>
                            <input wire:model="editApaterno" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <!-- Fila 2, Columna 2 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Apellido Materno:</label>
                            <input wire:model="editAmaterno" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>

                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Cargo:</label>
                            <input wire:model="editCargo" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <!-- Fila 2, Columna 2 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Departamento:</label>
                            <input wire:model="editDeporg" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Teléfono:</label>
                            <input wire:model="editTelefono" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                        <!-- Fila 2, Columna 2 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Email:</label>
                            <input wire:model="editEmail" type="email" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 p-1">
                        <!-- Fila 1, Columna 1 -->
                        <div class="bg-gray-500 text-white p-1 rounded-lg">
                            <label>Dirección:</label>
                            <input wire:model="editDir" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                        </div>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                    {{--                    begin  botones de acciones--}}
                    <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="updateRecord" />
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="closeEditModal" />
{{--                    end  botones de acciones--}}
                </div>
            </div>
        </div>
    @endif
    {{--  end Modal de edir registro--}}


{{-- Modal de inserción --}}
@if($isInsertModalOpen)
    <div id="insert-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-2xl h-auto bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Agregar Nuevo Registro
                </h3>
                <button wire:click="closeInsertModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4 bg-gray-900 p-1">
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Título:</label>
                        <input wire:model="newTitulo" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Nombre:</label>
                        <input wire:model="newNombre" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Apellido Paterno:</label>
                        <input wire:model="newApaterno" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Apellido Materno:</label>
                        <input wire:model="newAmaterno" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Cargo:</label>
                        <input wire:model="newCargo" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Departamento:</label>
                        <input wire:model="newDeporg" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Teléfono:</label>
                        <input wire:model="newTelefono" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Email:</label>
                        <input wire:model="newEmail" type="email" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 p-1">
                    <div class="bg-gray-500 text-white p-1 rounded-lg">
                        <label>Dirección:</label>
                        <input wire:model="newDir" type="text" class="w-full p-2 border rounded dark:bg-gray-800">
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="saveNewRecord" />
                <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="closeInsertModal" />
            </div>
        </div>
    </div>
@endif
     {{-- end insert record --}}
    @if($deleteRecordId && $recordToDelete)
        <div id="delete-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-md h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Confirmar Borrado
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
                    </p>
                    <div class="mt-4 text-left text-white">
                        <p><strong>ID:</strong> {{ $recordToDelete->id }}</p>
                        <p><strong>Nombre:</strong> {{ $recordToDelete->nombre }}</p>
                        <p><strong>Apellido Paterno:</strong> {{ $recordToDelete->apaterno }}</p>
                        <p><strong>Apellido Materno:</strong> {{ $recordToDelete->amaterno }}</p>
                        <p><strong>Cargo:</strong> {{ $recordToDelete->cargo }}</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <x-icon-action variant="danger" icon="fa-solid fa-trash" label="Sí, eliminar" size="md"
                        wire:click="deleteRecord" data-modal-hide="delete-modal" />
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md"
                        wire:click="$set('deleteRecordId', null)" data-modal-hide="delete-modal" />
                </div>
            </div>
        </div>
    @endif
    {{--     end modal eresear record--}}
    {{--    --}}
    @if($isViewqueryModalOpen)
        <div id="record-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-2xl h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detalles de la consulta
                    </h3>
                    <button wire:click="closeViewQuery" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4 bg-gray-500 text-white">
                    <p class="text-blue-400"> {{$queryStringPreview}} </p>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeViewQuery" />
                </div>
            </div>
        </div>
    @endif



    @endif

{{--    end modal ----------------------------------------------------------------------------------------------------}}

</div>
