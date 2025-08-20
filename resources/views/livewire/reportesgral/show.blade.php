<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            📋 Detalles del Registro
        </h2>
        
        <!-- Información básica -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    Información General
                </h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Legislatura</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->legislatura ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Captura</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->fcap ? $record->fcap->format('d/m/Y') : 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Recepción</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->frec ? $record->frec->format('d/m/Y') : 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel de Correspondencia</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->ncor ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Correspondencia</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->tcor ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Clasificación</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->ccor ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    Remitente
                </h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->rem_nombre ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Cargo</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->rem_cargo ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dependencia</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $record->rem_deporg ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Descripción y Seguimiento -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Contenido
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Descripción</dt>
                    <dd class="text-sm text-gray-900 dark:text-white p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        {{ $record->des ?? 'Sin descripción' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Seguimiento</dt>
                    <dd class="text-sm text-gray-900 dark:text-white p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        {{ $record->seguimiento ?? 'Sin seguimiento' }}
                    </dd>
                </div>
            </div>
        </div>

        <!-- Turnado -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Turnado
            </h3>
            <dl class="space-y-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $record->tur_nom ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Cargo</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $record->tur_cargo ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dependencia</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $record->tur_deporg ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Metadatos -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Metadatos
            </h3>
            <dl class="space-y-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creado por</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $record->creo ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Modificado por</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $record->modifico ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</dt>
                    <dd class="text-sm">
                        @if($record->estatus)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Activo
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Inactivo
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Gestión de Archivos PDF -->
    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
            📎 Archivos PDF Adjuntos
        </h3>
        
        @if($record->files->count() > 0)
            <div class="space-y-3 mb-4">
                @foreach($record->files as $file)
                    <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $file->original_name }}
                                </p>
                                @if($file->description)
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $file->description }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    {{ $file->formatted_size }} • Subido el {{ $file->created_at->format('d/m/Y H:i') }}
                                    @if($file->uploaded_by)
                                        por {{ $file->uploaded_by }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ $file->url }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                               title="Ver archivo">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" 
                                    wire:click="downloadFile({{ $file->id }})"
                                    class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300"
                                    title="Descargar">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500 dark:text-gray-400">
                    <i class="fas fa-file-pdf text-4xl mb-4"></i>
                    <p class="text-lg">No hay archivos PDF adjuntos</p>
                    <p class="text-sm">Este registro no tiene documentos adjuntos</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-between mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('rg.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>
            Volver a la lista
        </a>
        
        <div class="flex space-x-3">
            <a href="{{ route('rg.edit', $record->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-edit mr-2"></i>
                Editar
            </a>
        </div>
    </div>
</div>

<!-- Notificaciones para archivos -->
<script>
    // Escuchar eventos de archivos
    document.addEventListener('livewire:init', () => {
        Livewire.on('file-deleted', (data) => {
            // Mostrar notificación de archivo eliminado
            if (data.message) {
                showNotification(data.message, 'success');
            }
        });

        Livewire.on('file-error', (data) => {
            // Mostrar notificación de error
            if (data.message) {
                showNotification(data.message, 'error');
            }
        });
    });

    // Función para mostrar notificaciones
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
            type === 'success' 
                ? 'bg-green-500 text-white' 
                : 'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Auto-ocultar después de 3 segundos
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
