<?php

namespace App\Traits;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\CosFile;

trait HandlesFileUploads
{
    public $files = [];
    public $fileDescriptions = [];
    public $maxFileSize = 15728640; // 15MB en bytes
    public $allowedFileTypes = ['pdf'];

    /**
     * Validar archivos antes de la subida
     */
    public function validateFiles()
    {
        $this->validate([
            'files.*' => [
                'required',
                'file',
                'max:' . ($this->maxFileSize / 1024 / 1024), // Convertir a MB
                'mimes:' . implode(',', $this->allowedFileTypes)
            ],
            'fileDescriptions.*' => 'nullable|string|max:255'
        ], [
            'files.*.required' => 'Debe seleccionar al menos un archivo.',
            'files.*.file' => 'El archivo debe ser válido.',
            'files.*.max' => 'El archivo no puede ser mayor a 15MB.',
            'files.*.mimes' => 'Solo se permiten archivos PDF.'
        ]);
    }

    /**
     * Guardar archivos en el almacenamiento y base de datos
     */
    public function saveFiles($cosId, $uploadedBy = null)
    {
        if (empty($this->files)) {
            return;
        }

        foreach ($this->files as $index => $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $this->saveSingleFile($file, $cosId, $index, $uploadedBy);
            }
        }

        // Limpiar archivos temporales
        $this->files = [];
        $this->fileDescriptions = [];
    }

    /**
     * Guardar un archivo individual
     */
    protected function saveSingleFile($file, $cosId, $index, $uploadedBy = null)
    {
        // Generar nombre único para el archivo
        $fileName = time() . '_' . uniqid() . '.pdf';
        $filePath = 'cos-files/' . $fileName;

        // Guardar archivo en el almacenamiento
        $file->storeAs('cos-files', $fileName, 'public');

        // Crear registro en la base de datos
        CosFile::create([
            'cos_id' => $cosId,
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_type' => 'pdf',
            'file_size' => $file->getSize(),
            'description' => $this->fileDescriptions[$index] ?? null,
            'uploaded_by' => $uploadedBy
        ]);
    }

    /**
     * Eliminar archivo
     */
    public function deleteFile($fileId)
    {
        $file = CosFile::find($fileId);
        
        if ($file) {
            // Eliminar archivo físico
            $file->deleteFile();
            
            // Eliminar registro de la base de datos
            $file->delete();
            
            $this->dispatch('file-deleted', message: 'Archivo eliminado correctamente.');
        }
    }

    /**
     * Descargar archivo
     */
    public function downloadFile($fileId)
    {
        $file = CosFile::find($fileId);
        
        if ($file && $file->exists()) {
            return Storage::disk('public')->download($file->file_path, $file->original_name);
        }
        
        $this->dispatch('file-error', message: 'El archivo no existe.');
    }

    /**
     * Obtener archivos de un registro CO
     */
    public function getFilesForCos($cosId)
    {
        return CosFile::where('cos_id', $cosId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Limpiar archivos temporales
     */
    public function clearFiles()
    {
        $this->files = [];
        $this->fileDescriptions = [];
    }

    /**
     * Verificar si hay archivos para subir
     */
    public function hasFiles()
    {
        return !empty($this->files);
    }

    /**
     * Obtener el tamaño total de los archivos
     */
    public function getTotalFilesSize()
    {
        $total = 0;
        foreach ($this->files as $file) {
            if ($file instanceof TemporaryUploadedFile) {
                $total += $file->getSize();
            }
        }
        return $total;
    }

    /**
     * Verificar si el tamaño total excede el límite
     */
    public function exceedsTotalSizeLimit()
    {
        return $this->getTotalFilesSize() > $this->maxFileSize;
    }
}
