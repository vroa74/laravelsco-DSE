<?php

namespace App\Livewire;

use App\Actions\Correspondence\DownloadCorrespondenceFile;
use App\Models\Co;
use App\Models\CosFile;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FileManager extends Component
{
    #[Locked]
    public $cosId;

    public $files = [];

    public $showUploadForm = false;

    public $newFile;

    public $fileDescription = '';

    protected $listeners = ['refreshFiles' => 'loadFiles'];

    public function boot(): void
    {
        Gate::authorize('viewAny', Co::class);
    }

    public function mount($cosId = null)
    {
        $this->cosId = $cosId;
        $this->loadFiles();
    }

    public function loadFiles()
    {
        if ($this->cosId) {
            Co::visibleTo(auth()->user())->findOrFail($this->cosId);
            $this->files = CosFile::where('cos_id', $this->cosId)
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function toggleUploadForm()
    {
        Gate::authorize('update', Co::findOrFail($this->cosId));
        $this->showUploadForm = ! $this->showUploadForm;
    }

    public function downloadFile($fileId)
    {
        Co::visibleTo(auth()->user())->findOrFail($this->cosId);
        $file = CosFile::where('cos_id', $this->cosId)->findOrFail($fileId);

        if ($file && $file->exists()) {
            return app(DownloadCorrespondenceFile::class)((string) $this->cosId, (string) $file->id);
        }

        $this->dispatch('file-error', message: 'El archivo no existe.');
    }

    public function deleteFile($fileId)
    {
        Gate::authorize('update', Co::findOrFail($this->cosId));
        $file = CosFile::where('cos_id', $this->cosId)->findOrFail($fileId);

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
