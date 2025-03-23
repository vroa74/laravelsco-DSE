<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ncor;

class Nc extends Component
{
    public $nncor; // Lista de elementos
    public $newNcor = ''; // Input para nuevo elemento
    public $editingId = null; // ID del elemento en edición

    public function mount()
    {
        $this->loadNcor();
    }

    public function loadNcor()
    {
        $this->nncor = Ncor::orderBy('id', 'desc')->get();
    }

    public function addNcor()
    {
        // Validar el input
        $this->validate([
            'newNcor' => 'required|string|max:255',
        ]);

        // Verificar si ya existe
        if (Ncor::where('ncor', $this->newNcor)->exists()) {
            session()->flash('error', 'El elemento ya existe.');
            return;
        }

        // Guardar en la base de datos
        Ncor::create(['ncor' => $this->newNcor]);

        // Recargar la lista y limpiar el input
        $this->loadNcor();
        $this->newNcor = '';
        session()->flash('success', 'Elemento agregado correctamente.');
    }

    public function startEdit($id)
    {
        $ncor = Ncor::find($id);
        if ($ncor) {
            $this->editingId = $id;
            $this->newNcor = $ncor->ncor;
        }
    }

    public function saveEdit()
    {
        $this->validate([
            'newNcor' => 'required|string|max:255',
        ]);

        // Verificar si ya existe otro elemento con el mismo valor
        if (Ncor::where('ncor', $this->newNcor)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'El elemento ya existe.');
            return;
        }

        $ncor = Ncor::find($this->editingId);
        if ($ncor) {
            $ncor->update(['ncor' => $this->newNcor]);
            $this->loadNcor();
            $this->editingId = null;
            $this->newNcor = '';
            session()->flash('success', 'Elemento actualizado correctamente.');
        }
    }

    public function deleteNcor($id)
    {
        Ncor::find($id)->delete();
        $this->loadNcor();
        session()->flash('success', 'Elemento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.nc');
    }
}
