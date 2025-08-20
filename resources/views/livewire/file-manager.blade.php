<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Archivos PDF ({{ $files->count() }})
        </h3>
        <button wire:click="toggleUploadForm" 
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i>
            {{ $showUploadForm ? 'Cancelar' : 'Agregar Archivo' }}
        </button>
    </div>

    <!-- Lista de archivos -->
    @if($files->count() > 0)
        <div class="space-y-3">
            @foreach($files as $file)
                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $file->original_name }}
                            </p>
                            @if($file->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400">
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
                        <button wire:click="downloadFile({{ $file->id }})" 
                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                title="Descargar">
                            <i class="fas fa-download"></i>
                        </button>
                        <button wire:click="deleteFile({{ $file->id }})" 
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                title="Eliminar"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este archivo?')">
                            <i class="fas fa-trash"></i>
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
                <p class="text-sm">Haz clic en "Agregar Archivo" para subir documentos</p>
            </div>
        </div>
    @endif

    <!-- Formulario de subida (oculto por defecto) -->
    @if($showUploadForm)
        <div class="mt-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700">
            <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                Subir Nuevo Archivo PDF
            </h4>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Seleccionar Archivo PDF
                    </label>
                    <input type="file" 
                           wire:model="newFile" 
                           accept=".pdf"
                           class="block w-full text-sm text-gray-500 dark:text-gray-400
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100
                                  dark:file:bg-blue-900 dark:file:text-blue-300">
                    @error('newFile') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Descripción (opcional)
                    </label>
                    <input type="text" 
                           wire:model="fileDescription" 
                           placeholder="Descripción del archivo"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>

                <div class="flex justify-end space-x-3">
                    <button wire:click="toggleUploadForm" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 dark:hover:bg-gray-500">
                        Cancelar
                    </button>
                    <button wire:click="uploadFile" 
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Subir Archivo
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
