<div>
    <!-- Filtros -->
    <div class="overflow-hidden shadow-sm sm:rounded-lg mb-4 surface-panel">
        <div class="p-4 text-primary">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Búsqueda -->
                <div>
                    <label for="search" class="block text-xs font-medium text-primary">
                        Buscar
                    </label>
                    <input type="text" wire:model.live="search" id="search"
                        placeholder="Buscar por nombre o descripción..."
                        class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 text-primary input-base">
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
    <div class="overflow-hidden shadow-sm sm:rounded-lg surface-panel">
        <div class="p-4 text-primary">
            @if ($groups->count() > 0)
                <div>
                    <table class="tabla-apilada divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                    Nombre
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                    Descripción
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                    Miembros
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                    Estado
                                </th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-primary">
                                    Creado por
                                </th>
                                <th
                                    class="px-4 py-2 text-right text-xs font-medium uppercase tracking-wider text-primary">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($groups as $group)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2" data-label="Nombre">
                                        <div class="text-xs font-medium text-primary">
                                            {{ $group->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-2" data-label="Descripción">
                                        <div class="text-xs text-primary">
                                            {{ $group->description ? Str::limit($group->description, 40) : 'Sin descripción' }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-xs text-primary" data-label="Miembros">
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
                                    <td class="px-4 py-2 text-xs text-primary" data-label="Creado por">
                                        {{ $group->creator->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2 text-xs font-medium" data-label="Acciones">
                                        <div class="flex justify-end gap-2">
                                            <x-icon-action variant="view" icon="fa-regular fa-eye"
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
                    <h3 class="mt-2 text-xs font-medium text-primary">No hay grupos</h3>
                    <p class="mt-1 text-xs text-primary">Comienza creando un nuevo grupo.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de detalles: encabezado, datos y pie pertenecen al mismo panel. -->
    @if ($showModal && $selectedGroup)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto p-4 sco-modal-backdrop"
            wire:click.self="closeModal" role="dialog" aria-modal="true" aria-labelledby="group-detail-title"
            x-data x-trap.inert.noscroll="true" x-on:keydown.escape.window="$wire.closeModal()">
            <section class="relative flex w-full max-w-lg flex-col text-left modal-elevated" data-group-detail-panel>
                <header class="flex shrink-0 items-center justify-between gap-4 border-b border-primary p-4">
                    <h3 id="group-detail-title" class="min-w-0 break-words text-sm font-semibold text-primary">
                        {{ $selectedGroup->name }}
                    </h3>
                    <button type="button" wire:click="closeModal" class="modal-close" aria-label="Cerrar detalle del grupo">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </header>
                <dl class="min-h-0 space-y-4 overflow-y-auto break-words p-4">
                    @if ($selectedGroup->description)
                        <div>
                            <dt class="text-xs font-medium text-primary">Descripción:</dt>
                            <dd class="mt-1 text-xs text-secondary">{{ $selectedGroup->description }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-xs font-medium text-primary">Miembros:</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                {{ $selectedGroup->members_count }} miembros
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-primary">Creado por:</dt>
                        <dd class="mt-1 text-xs text-secondary">{{ $selectedGroup->creator->name ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-primary">Estado:</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $selectedGroup->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                {{ $selectedGroup->active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </dd>
                    </div>
                </dl>
                <footer class="modal-actions shrink-0 border-t border-primary p-4">
                    <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                </footer>
            </section>
        </div>
    @endif

    <!-- Modal de miembros con drag & drop -->
    @if ($showMembersModal && $selectedGroup)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:click.self="closeModal">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div
                    class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full modal-elevated">
                    <div class="px-4 pt-4 pb-3 sm:p-5 surface-panel">
                        <!-- Header con título y botón de cerrar -->
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm leading-5 font-medium text-primary">
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
                                class="block w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 text-primary input-base">
                        </div>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <!-- Columna izquierda: Usuarios disponibles -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-xs font-medium text-primary">
                                        Usuarios Disponibles ({{ $filteredAvailableUsers->count() }})
                                    </h4>
                                </div>
                                <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-3 min-h-[300px] max-h-[400px] overflow-y-auto surface-panel"
                                    ondragover="event.preventDefault();">
                                    @if ($filteredAvailableUsers->count() > 0)
                                        <div class="space-y-2">
                                            @foreach ($filteredAvailableUsers as $user)
                                                <div draggable="true"
                                                    ondragstart="event.dataTransfer.setData('userId', {{ $user->id }})"
                                                    class="flex items-center justify-between p-2 rounded-lg border border-gray-200 dark:border-gray-700 cursor-move hover:shadow-md transition-shadow surface-panel">
                                                    <div class="flex min-w-0 items-center space-x-2">
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 8h16M4 16h16" />
                                                        </svg>
                                                        <div class="min-w-0">
                                                            <div
                                                                class="text-xs font-medium break-words text-primary">
                                                                {{ $user->name }}</div>
                                                            <div class="text-xs break-words text-primary">
                                                                {{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                    <button wire:click="addMember({{ $user->id }})"
                                                        class="btn-icon btn-success">
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
                                            <p class="text-xs text-primary">No hay usuarios
                                                disponibles</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Columna derecha: Miembros del grupo -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-xs font-medium text-primary">
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
                                                    class="flex items-center justify-between p-2 rounded-lg border border-green-200 dark:border-green-700 cursor-move hover:shadow-md transition-shadow surface-panel">
                                                    <div class="flex min-w-0 items-center space-x-2">
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 8h16M4 16h16" />
                                                        </svg>
                                                        <div class="min-w-0">
                                                            <div
                                                                class="text-xs font-medium break-words text-primary">
                                                                {{ $member->name }}</div>
                                                            <div class="text-xs break-words text-primary">
                                                                {{ $member->email }}</div>
                                                        </div>
                                                    </div>
                                                    <button wire:click="removeMember({{ $member->id }})"
                                                        class="btn-icon btn-danger">
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
                                            <p class="text-xs mt-2 text-primary">Arrastra usuarios
                                                aquí</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-xs text-center text-primary">
                            💡 Arrastra y suelta usuarios entre las columnas o usa las flechas
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-2 sm:px-5 surface-panel">
                        <x-icon-action variant="neutral" icon="fa-solid fa-xmark" label="Cerrar" size="md" wire:click="closeModal" />
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
