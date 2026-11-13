<div>

    <div class="text-right">
        <!-- Botón -->
    </div> {{--    fin del div de lo botones --}}

    <div id="accordion-collapse" class="text-center items-center w-[99%] mx-auto">
        <h2 id="accordion-collapse-heading-1">
            <div class="relative">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-stretch">
                    <!-- Botón de filtros -->
                    <button type="button"
                        class="filter-toggle flex w-full items-center justify-between gap-3 rounded-xl border border-gray-700  px-4 py-2.5 text-sm font-medium  transition  focus:outline-none focus:ring-4 focus:ring-gray-700 sm:flex-1"
                        wire:click="toggleAccordion" aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="accordion-collapse-body-1">
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                            Filtros
                        </span>

                        <svg class="w-5 h-5 transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>

                    <!-- Acciones de la barra: solo iconos con tooltip -->
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-end">
                        <x-icon-action variant="success" icon="fa-regular fa-square-plus" label="Agregar registro"
                            wire:click="openCreateModal" />

                        <x-icon-action variant="info" icon="fa-solid fa-filter" label="Mostrar consulta"
                            wire:click="openViewQuery" />
                    </div>
                </div>
            </div>
        </h2>

        <div id="accordion-collapse-body-1"
            class="{{ $isOpen ? '' : 'hidden' }} p-1 border border-gray-200 dark:border-gray-700 surface-panel">
            {{--      begin section containes filter --}}


            <div class="grid grid-cols-1 gap-1 w-full h-full px-2 text-xs sm:grid-cols-2 sm:px-4 xl:grid-cols-4 text-primary">
                <div class="border-2 border-gray-300 rounded-lg p-1 items-center text-center space-y-1">
                    {{-- inline-block se usa para un tamaño especifico           --}}
                    Mostrar::
                    <select id="countries" wire:model.live="perPage"
                        class="border border-gray-300 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 inline-block w-auto p-1 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-primary input-base">
                        <option value="10" selected>Registros a mostrar</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                    Registros. - {{ $perPage }}
                    {{-- estatus --}}
                    <p>Total de registros: {{ $users->total() }}</p>
                    {{--                        <p>{{ $myquery }}</p> --}}
                </div>
                <div class="border-2 border-gray-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label for="name" class="text-sm text-primary">Nombre</label>
                        <input type="text" id="name" placeholder="Nombre completo" wire:model.live="filname"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="rfc" class="text-sm text-primary">RFC</label>
                        <input type="text" id="rfc" placeholder="RFC" wire:model.live="filrfc"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="curp" class="text-sm text-primary">CURP</label>
                        <input type="text" id="curp" placeholder="CURP" wire:model.live="filcurp"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                    </div>
                </div>
                <div class="border-2 border-gray-300 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label for="position" class="text-sm text-primary">Cargo</label>
                        <select id="position" wire:model.live="filposition"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                            <option value="">Todos los cargos</option>
                            @foreach ($uniquePositions as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="sex" class="text-sm text-primary">Sexo</label>
                        <select id="sex" wire:model.live="filsex"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                            <option value="">Todos</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="border-2 border-gray-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                    <div class="flex items-center space-x-2">
                        <label for="lvl" class="text-sm text-primary">Nivel</label>
                        <select id="lvl" wire:model.live="fillvl"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                            <option value="">Todos los niveles</option>
                            @foreach ($uniqueLevels as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="email" class="text-sm text-primary">E-mail</label>
                        <input type="text" id="email" placeholder="Email" wire:model.live="filemail"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="direction" class="text-sm text-primary">Dirección</label>
                        <select id="direction" wire:model.live="fildirection"
                            class="p-1 border rounded text-xs input-base" style="width: 150px;">
                            <option value="">Todas las direcciones</option>
                            @foreach ($uniqueDirections as $direction)
                                <option value="{{ $direction }}">{{ $direction }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{--      end section containes filter --}}

        </div>
    </div>
    {{--         ---------------------------------------------------------------------------------------------------------- --}}
    <div class="relative pt-1 px-4 shadow-md sm:rounded-lg">
        <div class="mx-auto w-full sm:w-[96%]">
            <table
                class="tabla-apilada rounded-2xl text-xs text-left rtl:text-right text-primary">
                <thead
                    class="text-xs uppercase dark:bg-blue-900 text-primary">
                    <tr>
                        <th class="px-6 py-3 w-16">Foto</th>
                        <th class="px-6 py-3 w-12">ID</th>
                        <th class="px-6 py-3 w-32">Nombre</th>
                        <th class="px-6 py-3 w-20">RFC</th>
                        <th class="px-6 py-3 w-20">CURP</th>
                        <th class="px-6 py-3 w-32">Cargo</th>
                        <th class="px-6 py-3 w-20">Sexo</th>
                        <th class="px-6 py-3 w-20">Nivel</th>
                        <th class="px-6 py-3 w-20">Tipo</th>
                        <th class="px-6 py-3 w-20">Estado</th>
                        <th class="px-6 py-3 w-40">Email</th>
                        <th class="px-6 py-3 text-right w-[150px]">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $items)
                            <tr
                                class="border-b text-xs dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-950">
                                <td class="px-3 py-3 text-center md:w-16 md:px-6 md:py-4" data-label="Foto">
                                    @if ($items->profile_photo_path && $items->profile_photo_url)
                                        <img src="{{ $items->profile_photo_url }}"
                                            alt="Foto de perfil"
                                            class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mx-auto text-white font-semibold text-sm">
                                            {{ strtoupper(substr($items->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>
                                <th scope="row"
                                    class="px-3 py-3 font-medium md:w-12 md:px-6 md:py-4 text-primary"
                                    data-label="ID">
                                    {{ $items->id }}
                                </th>
                                <td class="px-3 py-3 md:w-32 md:px-6 md:py-4" data-label="Nombre">{{ $items->name }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="RFC">{{ $items->rfc }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="CURP">{{ $items->curp }}</td>
                                <td class="px-3 py-3 md:w-32 md:px-6 md:py-4" data-label="Cargo">{{ $items->position }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="Sexo">{{ $items->sex }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="Nivel">{{ $items->lvl }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="Tipo">{{ $items->tipo }}</td>
                                <td class="px-3 py-3 md:w-20 md:px-6 md:py-4" data-label="Estado">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $items->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $items->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 md:w-40 md:px-6 md:py-4" data-label="Email">{{ $items->email }}</td>
                                <td class="px-3 py-3 text-right md:w-[150px] md:px-6 md:py-4" data-label="Acciones">
                                    {{--                                seccion de botones de acciones de la tabla --}}
                                    <x-icon-action variant="view" icon="fa-solid fa-eye" label="Ver detalles" wire:click="showRecord({{ $items->id }})"
                                        title="Ver detalles del usuario" />

                                    <x-icon-action variant="warning" icon="fa-solid fa-pen-to-square" label="Editar registro" wire:click="editRecord({{ $items->id }})" title="Editar usuario" />
                                    {{-- <x-icon-action variant="danger" icon="fa-solid fa-trash-can" label="Eliminar registro" wire:click="confirmDelete({{ $items->id }})" /> --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="px-3 py-3 text-center text-primary">
                                No se encontraron registros.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <br>
        @if ($users->count() > 0)
            {{ $users }}
    </div>
    {{--    begin modal  ----------------------------------------------------------------------------------------------- --}}

    @if ($selectedRecord)
        <div id="record-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full sco-modal-backdrop"
            role="dialog" aria-modal="true" aria-labelledby="record-modal-title">
            <div class="relative w-full max-w-2xl h-auto modal-elevated">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="record-modal-title" class="text-xl font-semibold text-primary">
                        Detalles del Registro
                    </h3>
                    <button wire:click="closeModal" type="button"
                        class="modal-close text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        aria-label="Cerrar modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586l-4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4 surface-panel text-primary">
                    <p><strong>ID:</strong> {{ $selectedRecord->id }}</p>
                    <p><strong>Nombre:</strong> {{ $selectedRecord->name }}</p>
                    <p><strong>RFC:</strong> {{ $selectedRecord->rfc }}</p>
                    <p><strong>CURP:</strong> {{ $selectedRecord->curp }}</p>
                    <p><strong>Cargo:</strong> {{ $selectedRecord->position }}</p>
                    <p><strong>Sexo:</strong> {{ $selectedRecord->sex }}</p>
                    <p><strong>Nivel:</strong> {{ $selectedRecord->lvl }}</p>
                    <p><strong>Tipo:</strong> {{ $selectedRecord->tipo }}</p>
                    <p><strong>Estado:</strong> {{ $selectedRecord->status ? 'Activo' : 'Inactivo' }}</p>
                    <p><strong>Email:</strong> {{ $selectedRecord->email }}</p>
                    <p><strong>Dirección:</strong> {{ $selectedRecord->direction }}</p>
                    <p><strong>Foto de Perfil:</strong>
                        @if ($selectedRecord->profile_photo_path && $selectedRecord->profile_photo_url)
                            <img src="{{ $selectedRecord->profile_photo_url }}"
                                alt="Foto de perfil"
                                class="w-16 h-16 rounded-full object-cover border border-gray-300 mt-1">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mt-1 text-white font-semibold text-lg">
                                {{ strtoupper(substr($selectedRecord->name, 0, 2)) }}
                            </div>
                        @endif
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                </div>
            </div>
        </div>
    @endif
    {{--    -------------------------------------------------------------------------- --}}
    {{--  Begin Modal de edir registro --}}
    @if ($editRecordId)
        <div id="edit-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full sco-modal-backdrop"
            role="dialog" aria-modal="true" aria-labelledby="edit-modal-title">
            <div class="relative w-full max-w-2xl h-auto modal-elevated">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="edit-modal-title" class="text-xl font-semibold text-primary">
                        Editar Registro
                    </h3>
                    <button wire:click="closeEditModal" type="button"
                        class="modal-close text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        aria-label="Cerrar modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-1 surface-panel">
                        <!-- Fila 1 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Nombre:</label>
                            <input wire:model="editName" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="Nombre completo">
                            @error('editName')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Email:</label>
                            <input wire:model="editEmail" type="email"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="correo@ejemplo.com">
                            @error('editEmail')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 2 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">RFC:</label>
                            <input wire:model="editRfc" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="RFC (13 caracteres)" maxlength="13">
                            @error('editRfc')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">CURP:</label>
                            <input wire:model="editCurp" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="CURP (18 caracteres)" maxlength="20">
                            @error('editCurp')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 3 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Cargo:</label>
                            <select wire:model="editPosition"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar cargo</option>
                                @foreach ($uniquePositions as $position)
                                    <option value="{{ $position }}">{{ $position }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Nivel:</label>
                            <select wire:model="editLvl"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar nivel</option>
                                @foreach ($uniqueLevels as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 4 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Sexo:</label>
                            <select wire:model="editSex"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Tipo:</label>
                            <select wire:model="editTipo"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar tipo</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>

                        <!-- Fila 5 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Estado:</label>
                            <select wire:model="editStatus"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Dirección:</label>
                            <select wire:model="editDirection"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar dirección</option>
                                @foreach ($uniqueDirections as $direction)
                                    <option value="{{ $direction }}">{{ $direction }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 6 - Contraseña -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Nueva Contraseña:</label>
                            <div class="relative">
                                <input wire:model="editPassword" type="{{ $showEditPassword ? 'text' : 'password' }}"
                                    class="w-full p-2 pr-10 border rounded text-primary input-base"
                                    placeholder="Dejar vacío para mantener la actual">
                                <button type="button" wire:click="toggleEditPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    title="{{ $showEditPassword ? 'Ocultar contraseña' : 'Mostrar contraseña' }}">
                                    <i
                                        class="fa-solid {{ $showEditPassword ? 'fa-eye-slash' : 'fa-eye' }} text-gray-500"></i>
                                </button>
                            </div>
                            @error('editPassword')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Confirmar Contraseña:</label>
                            <div class="relative">
                                <input wire:model="editPasswordConfirmation"
                                    type="{{ $showEditPasswordConfirmation ? 'text' : 'password' }}"
                                    class="w-full p-2 pr-10 border rounded text-primary input-base"
                                    placeholder="Confirmar nueva contraseña">
                                <button type="button" wire:click="toggleEditPasswordConfirmation"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    title="{{ $showEditPasswordConfirmation ? 'Ocultar confirmación' : 'Mostrar confirmación' }}">
                                    <i
                                        class="fa-solid {{ $showEditPasswordConfirmation ? 'fa-eye-slash' : 'fa-eye' }} text-gray-500"></i>
                                </button>
                            </div>
                            @error('editPasswordConfirmation')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 7 - Foto de perfil -->
                        <div class="p-1 rounded-lg col-span-2 surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Foto de Perfil:</label>
                            <div class="flex items-center space-x-4">
                                <!-- Vista previa de foto actual o nueva -->
                                <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center">
                                    @if ($editProfilePhoto)
                                        <!-- Vista previa de nueva imagen seleccionada -->
                                        <img src="{{ $editProfilePhoto->temporaryUrl() }}" alt="Vista previa"
                                            class="w-full h-full object-cover">
                                    @elseif($editProfilePhotoPath && $editProfilePhotoUrl)
                                        <!-- Foto actual del usuario -->
                                        <img src="{{ $editProfilePhotoUrl }}"
                                            alt="Foto de perfil actual" class="w-full h-full object-cover">
                                    @else
                                        <!-- Avatar por defecto con iniciales -->
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center font-semibold text-xl text-primary">
                                            {{ strtoupper(substr($editName, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input wire:model.live="editProfilePhoto" type="file" accept="image/*"
                                        class="w-full p-2 border rounded text-sm text-primary input-base">
                                    <p class="text-xs mt-1 text-primary">Formatos: JPG, PNG, GIF. Máximo 2MB</p>
                                    @if ($editProfilePhoto)
                                        <p class="text-xs text-green-300 mt-1">Archivo seleccionado:
                                            {{ $editProfilePhoto->getClientOriginalName() }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                        {{--                    begin  botones de acciones --}}
                        <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Guardar" size="md" wire:click="updateRecord" />
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="closeEditModal" />
                        {{--                    end  botones de acciones --}}
                    </div>
                </div>
            </div>
    @endif
    {{--  end Modal de edir registro --}}

    {{-- Modal de creación (duplicado del modal de edición) --}}
    @if ($createModalOpen)
        <div id="create-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full sco-modal-backdrop"
            role="dialog" aria-modal="true" aria-labelledby="create-modal-title">
            <div class="relative w-full max-w-2xl h-auto modal-elevated">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="create-modal-title" class="text-xl font-semibold text-primary">
                        Crear Nuevo Usuario
                    </h3>
                    <button wire:click="closeCreateModal" type="button"
                        class="modal-close text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        aria-label="Cerrar modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-1 surface-panel">
                        <!-- Fila 1 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Nombre:</label>
                            <input wire:model="createName" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="Nombre completo">
                            @error('createName')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Email:</label>
                            <input wire:model="createEmail" type="email"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="correo@ejemplo.com">
                            @error('createEmail')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 2 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">RFC:</label>
                            <input wire:model="createRfc" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="RFC (13 caracteres)" maxlength="13">
                            @error('createRfc')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">CURP:</label>
                            <input wire:model="createCurp" type="text"
                                class="w-full p-2 border rounded text-primary input-base"
                                placeholder="CURP (18 caracteres)" maxlength="20">
                            @error('createCurp')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 3 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Cargo:</label>
                            <select wire:model="createPosition"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar cargo</option>
                                @foreach ($uniquePositions as $position)
                                    <option value="{{ $position }}">{{ $position }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Nivel:</label>
                            <select wire:model="createLvl"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar nivel</option>
                                @foreach ($uniqueLevels as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 4 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Sexo:</label>
                            <select wire:model="createSex"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Tipo:</label>
                            <select wire:model="createTipo"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar tipo</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>

                        <!-- Fila 5 -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Estado:</label>
                            <select wire:model="createStatus"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Dirección:</label>
                            <select wire:model="createDirection"
                                class="w-full p-2 border rounded text-primary input-base">
                                <option value="">Seleccionar dirección</option>
                                @foreach ($uniqueDirections as $direction)
                                    <option value="{{ $direction }}">{{ $direction }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 6 - Contraseña -->
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Contraseña:</label>
                            <div class="relative">
                                <input wire:model="createPassword"
                                    type="{{ $showCreatePassword ? 'text' : 'password' }}"
                                    class="w-full p-2 pr-10 border rounded text-primary input-base"
                                    placeholder="Mínimo 8 caracteres" required>
                                <button type="button" wire:click="toggleCreatePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    title="{{ $showCreatePassword ? 'Ocultar contraseña' : 'Mostrar contraseña' }}">
                                    <i
                                        class="fa-solid {{ $showCreatePassword ? 'fa-eye-slash' : 'fa-eye' }} text-gray-500"></i>
                                </button>
                            </div>
                            @error('createPassword')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Confirmar Contraseña:</label>
                            <div class="relative">
                                <input wire:model="createPasswordConfirmation"
                                    type="{{ $showCreatePasswordConfirmation ? 'text' : 'password' }}"
                                    class="w-full p-2 pr-10 border rounded text-primary input-base"
                                    placeholder="Confirmar contraseña" required>
                                <button type="button" wire:click="toggleCreatePasswordConfirmation"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    title="{{ $showCreatePasswordConfirmation ? 'Ocultar confirmación' : 'Mostrar confirmación' }}">
                                    <i
                                        class="fa-solid {{ $showCreatePasswordConfirmation ? 'fa-eye-slash' : 'fa-eye' }} text-gray-500"></i>
                                </button>
                            </div>
                            @error('createPasswordConfirmation')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fila 7 - Foto de perfil -->
                        <div class="p-1 rounded-lg col-span-2 surface-panel text-primary">
                            <label class="block text-sm font-medium mb-1">Foto de Perfil:</label>
                            <div class="flex items-center space-x-4">
                                <!-- Vista previa de nueva imagen -->
                                <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center">
                                    @if ($createProfilePhoto)
                                        <!-- Vista previa de nueva imagen seleccionada -->
                                        <img src="{{ $createProfilePhoto->temporaryUrl() }}" alt="Vista previa"
                                            class="w-full h-full object-cover">
                                    @else
                                        <!-- Avatar por defecto con iniciales -->
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center font-semibold text-xl text-primary">
                                            <i class="fa-solid fa-user-plus text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input wire:model.live="createProfilePhoto" type="file" accept="image/*"
                                        class="w-full p-2 border rounded text-sm text-primary input-base">
                                    <p class="text-xs mt-1 text-primary">Formatos: JPG, PNG, GIF. Máximo 2MB</p>
                                    @if ($createProfilePhoto)
                                        <p class="text-xs text-green-300 mt-1">Archivo seleccionado:
                                            {{ $createProfilePhoto->getClientOriginalName() }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                        <button wire:click="saveCreateRecord" type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                            Crear Usuario
                        </button>
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cancelar" size="md" wire:click="closeCreateModal" />
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- Modal de inserción --}}
    @if ($isInsertModalOpen)
        <div id="insert-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full sco-modal-backdrop"
            role="dialog" aria-modal="true" aria-labelledby="insert-modal-title">
            <div class="relative w-full max-w-2xl h-auto modal-elevated">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="insert-modal-title" class="text-xl font-semibold text-primary">
                        Agregar Nuevo Registro
                    </h3>
                    <button wire:click="closeInsertModal" type="button"
                        class="modal-close text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        aria-label="Cerrar modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-1 surface-panel">
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Nombre:</label>
                            <input wire:model="newName" type="text"
                                class="w-full p-2 border rounded input-base" placeholder="Nombre completo"
                                required>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>RFC:</label>
                            <input wire:model="newRfc" type="text"
                                class="w-full p-2 border rounded input-base" placeholder="RFC (13 caracteres)"
                                maxlength="13">
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>CURP:</label>
                            <input wire:model="newCurp" type="text"
                                class="w-full p-2 border rounded input-base" placeholder="CURP (18 caracteres)"
                                maxlength="20">
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Cargo:</label>
                            <select wire:model="newPosition" class="w-full p-2 border rounded input-base">
                                <option value="">Seleccionar cargo</option>
                                @foreach ($uniquePositions as $position)
                                    <option value="{{ $position }}">{{ $position }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Sexo:</label>
                            <select wire:model="newSex" class="w-full p-2 border rounded input-base">
                                <option value="">Seleccionar</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Nivel:</label>
                            <select wire:model="newLvl" class="w-full p-2 border rounded input-base">
                                <option value="">Seleccionar nivel</option>
                                @foreach ($uniqueLevels as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Tipo:</label>
                            <select wire:model="newTipo" class="w-full p-2 border rounded input-base">
                                <option value="">Seleccionar tipo</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Estado:</label>
                            <select wire:model="newStatus" class="w-full p-2 border rounded input-base">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Email:</label>
                            <input wire:model="newEmail" type="email"
                                class="w-full p-2 border rounded input-base" placeholder="correo@ejemplo.com">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 p-1">
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Dirección:</label>
                            <select wire:model="newDirection" class="w-full p-2 border rounded input-base">
                                <option value="">Seleccionar dirección</option>
                                @foreach ($uniqueDirections as $direction)
                                    <option value="{{ $direction }}">{{ $direction }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Contraseña:</label>
                            <input wire:model="newPassword" type="password"
                                class="w-full p-2 border rounded input-base" placeholder="Mínimo 8 caracteres"
                                required>
                            @error('newPassword')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Confirmar Contraseña:</label>
                            <input wire:model="newPasswordConfirmation" type="password"
                                class="w-full p-2 border rounded input-base" placeholder="Confirmar contraseña"
                                required>
                            @error('newPasswordConfirmation')
                                <span class="text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="p-1 rounded-lg surface-panel text-primary">
                            <label>Foto de Perfil:</label>
                            <div class="flex items-center space-x-4">
                                <!-- Vista previa de nueva imagen -->
                                <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center">
                                    @if ($newProfilePhoto)
                                        <img src="{{ $newProfilePhoto->temporaryUrl() }}" alt="Vista previa"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center font-semibold text-xl text-primary">
                                            <i class="fa-solid fa-user-plus text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input wire:model.live="newProfilePhoto" type="file" accept="image/*"
                                        class="w-full p-2 border rounded text-sm input-base">
                                    <p class="text-xs mt-1 text-primary">Formatos: JPG, PNG, GIF. Máximo 2MB</p>
                                    @if ($newProfilePhoto)
                                        <p class="text-xs text-green-300 mt-1">Archivo seleccionado:
                                            {{ $newProfilePhoto->getClientOriginalName() }}</p>
                                    @endif
                                </div>
                            </div>
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
    @if ($deleteRecordId && $recordToDelete)
        <div id="delete-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-md h-auto rounded-lg shadow modal-elevated">
                <!-- Modal header -->
                <div class="p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-primary">
                        Confirmar Borrado
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 text-center">
                    <p class="text-sm text-primary">
                        ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
                    </p>
                    <div class="mt-4 text-left text-primary">
                        <p><strong>ID:</strong> {{ $recordToDelete->id }}</p>
                        <p><strong>Nombre:</strong> {{ $recordToDelete->name }}</p>
                        <p><strong>RFC:</strong> {{ $recordToDelete->rfc }}</p>
                        <p><strong>CURP:</strong> {{ $recordToDelete->curp }}</p>
                        <p><strong>Cargo:</strong> {{ $recordToDelete->position }}</p>
                        <p><strong>Email:</strong> {{ $recordToDelete->email }}</p>
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
    {{--     end modal eresear record --}}
    {{--    --}}
    @if ($isViewqueryModalOpen)
        <div id="record-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full bg-gray-900 bg-opacity-50">
            <div class="relative w-full max-w-2xl h-auto rounded-lg shadow modal-elevated">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-primary">
                        Detalles de la consulta
                    </h3>
                    <button wire:click="closeViewQuery" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 8.586 5.707 4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4 surface-panel text-primary">
                    <p class="text-blue-400"> {{ $queryStringPreview }} </p>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 space-x-2 border-t border-gray-200 dark:border-gray-600">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeViewQuery" />
                </div>
            </div>
        </div>
    @endif



    @endif

    {{--    end modal -------------------------------------------------------------------------------------------------- --}}

</div>
