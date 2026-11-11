<div>
    <!-- Filtros -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
        <div class="p-4 text-gray-900 dark:text-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Búsqueda -->
                <div>
                    <label for="search" class="block text-xs font-medium text-gray-700 dark:text-gray-300">
                        Buscar
                    </label>
                    <input type="text" wire:model.live="search" id="search"
                        placeholder="Buscar por nombre o descripción..."
                        class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Botón de reset -->
                <div class="flex items-end justify-start md:justify-end">
                    <x-icon-action variant="neutral" icon="fa-solid fa-eraser" label="Limpiar filtros"
                        wire:click="$set('search', '')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de grupos -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 text-gray-900 dark:text-gray-100">
            @if ($groups->count() > 0)
                <div>
                    <table class="tabla-apilada divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Miembros
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Creado por
                                </th>
                                <th
                                    class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($groups as $group)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2" data-label="Nombre">
                                        <div class="text-xs font-medium text-gray-900 dark:text-white">
                                            {{ $group->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-2" data-label="Descripción">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $group->description ? Str::limit($group->description, 40) : 'Sin descripción' }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400" data-label="Miembros">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            {{ $group->members_count }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2" data-label="Estado">
                                        <button wire:click="toggleActive({{ $group->id }})"
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $group->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                            {{ $group->active ? 'Activo' : 'Inactivo' }}
                                        </button>
                                    </td>
                                    <td class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400" data-label="Creado por">
                                        {{ $group->creator->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2 text-xs font-medium" data-label="Acciones">
                                        <div class="flex justify-end gap-2">
                                            <x-icon-action variant="info" icon="fa-regular fa-eye"
                                                label="Ver grupo" wire:click="showGroup({{ $group->id }})" />

                                            <x-icon-action variant="warning" icon="fa-solid fa-pencil"
                                                label="Editar grupo" :href="route('user-groups.edit', $group)" />

                                            <x-icon-action variant="success" icon="fa-solid fa-users"
                                                label="Gestionar miembros" wire:click="showMembers({{ $group->id }})" />

                                            <x-icon-action variant="danger" icon="fa-solid fa-trash"
                                                label="Eliminar grupo" wire:click="deleteGroup({{ $group->id }})"
                                                onclick="return confirm('¿Está seguro de eliminar este grupo?')" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $groups->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-xs font-medium text-gray-900 dark:text-white">No hay grupos</h3>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Comienza creando un nuevo grupo.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de detalles del grupo -->
    @if ($showModal && $selectedGroup)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:click.self="closeModal">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-4 pb-3 sm:p-5">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-2 text-center sm:mt-0 sm:ml-3 sm:text-left w-full">
                                <h3 class="text-sm leading-5 font-medium text-gray-900 dark:text-white mb-3">
                                    {{ $selectedGroup->name }}
                                </h3>

                                <div class="space-y-2">
                                    @if ($selectedGroup->description)
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300">Descripción:</label>
                                            <p class="mt-1 text-xs text-gray-900 dark:text-white">
                                                {{ $selectedGroup->description }}</p>
                                        </div>
                                    @endif

                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Miembros:</label>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            {{ $selectedGroup->members_count }} miembros
                                        </span>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Creado
                                            por:</label>
                                        <p class="mt-1 text-xs text-gray-900 dark:text-white">
                                            {{ $selectedGroup->creator->name ?? 'N/A' }}</p>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Estado:</label>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $selectedGroup->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                            {{ $selectedGroup->active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end bg-gray-50 px-4 py-2 dark:bg-gray-700 sm:px-5">
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de miembros con drag & drop -->
    @if ($showMembersModal && $selectedGroup)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:click.self="closeModal">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-4 pb-3 sm:p-5">
                        <!-- Header con título y botón de cerrar -->
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm leading-5 font-medium text-gray-900 dark:text-white">
                                Gestionar Miembros: {{ $selectedGroup->name }}
                            </h3>
                            <button type="button" wire:click="closeModal"
                                class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Input de búsqueda -->
                        <div class="mb-3">
                            <input type="text" wire:model.live="searchAvailableUsers"
                                placeholder="Buscar usuarios disponibles por nombre o email..."
                                class="block w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <!-- Columna izquierda: Usuarios disponibles -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                        Usuarios Disponibles ({{ $filteredAvailableUsers->count() }})
                                    </h4>
                                </div>
                                <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-3 min-h-[300px] max-h-[400px] overflow-y-auto bg-gray-50 dark:bg-gray-900"
                                    ondragover="event.preventDefault();">
                                    @if ($filteredAvailableUsers->count() > 0)
                                        <div class="space-y-2">
                                            @foreach ($filteredAvailableUsers as $user)
                                                <div draggable="true"
                                                    ondragstart="event.dataTransfer.setData('userId', {{ $user->id }})"
                                                    class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 cursor-move hover:shadow-md transition-shadow">
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 8h16M4 16h16" />
                                                        </svg>
                                                        <div>
                                                            <div
                                                                class="text-xs font-medium text-gray-900 dark:text-white">
                                                                {{ $user->name }}</div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                    <button wire:click="addMember({{ $user->id }})"
                                                        class="text-green-600 hover:text-green-900 dark:text-green-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-8">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">No hay usuarios
                                                disponibles</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Columna derecha: Miembros del grupo -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                        Miembros del Grupo ({{ $selectedGroup->members_count }})
                                    </h4>
                                </div>
                                <div class="border-2 border-dashed border-green-300 dark:border-green-700 rounded-lg p-3 min-h-[300px] max-h-[400px] overflow-y-auto bg-green-50 dark:bg-gray-900"
                                    ondragover="event.preventDefault();"
                                    ondrop="event.preventDefault(); const userId = event.dataTransfer.getData('userId'); if(userId) { @this.addMember(userId); }">
                                    @if ($selectedGroup->members->count() > 0)
                                        <div class="space-y-2">
                                            @foreach ($selectedGroup->members as $member)
                                                <div draggable="true"
                                                    ondragstart="event.dataTransfer.setData('memberId', {{ $member->id }})"
                                                    class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 rounded-lg border border-green-200 dark:border-green-700 cursor-move hover:shadow-md transition-shadow">
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 8h16M4 16h16" />
                                                        </svg>
                                                        <div>
                                                            <div
                                                                class="text-xs font-medium text-gray-900 dark:text-white">
                                                                {{ $member->name }}</div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $member->email }}</div>
                                                        </div>
                                                    </div>
                                                    <button wire:click="removeMember({{ $member->id }})"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-8">
                                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Arrastra usuarios
                                                aquí</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-xs text-gray-500 dark:text-gray-400 text-center">
                            💡 Arrastra y suelta usuarios entre las columnas o usa las flechas
                        </div>
                    </div>
                    <div class="flex items-center justify-end bg-gray-50 px-4 py-2 dark:bg-gray-700 sm:px-5">
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
