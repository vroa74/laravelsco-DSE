<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CosFile;
use Illuminate\Support\Facades\Storage;

class FileManager extends Component
{
    public $cosId;
    public $files = [];
    public $showUploadForm = false;
    public $newFile;
    public $fileDescription = '';

    protected $listeners = ['refreshFiles' => 'loadFiles'];

    public function mount($cosId = null)
    {
        $this->cosId = $cosId;
        $this->loadFiles();
    }

    public function loadFiles()
    {
        if ($this->cosId) {
            $this->files = CosFile::where('cos_id', $this->cosId)
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        }
    }

    public function toggleUploadForm()
    {
        $this->showUploadForm = !$this->showUploadForm;
    }

    public function downloadFile($fileId)
    {
        $file = CosFile::find($fileId);
        
        if ($file && $file->exists()) {
            return Storage::disk('public')->download($file->file_path, $file->original_name);
        }
        
        $this->dispatch('file-error', message: 'El archivo no existe.');
    }

    public function deleteFile($fileId)
    {
        $file = CosFile::find($fileId);
        
        if ($file) {
            // Eliminar archivo físico
            $file->deleteFile();
            
            // Eliminar registro de la base de datos
            $file->delete();
            
            // Recargar archivos
            $this->loadFiles();
            
            $this->dispatch('file-deleted', message: 'Archivo eliminado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.file-manager');
    }
}
