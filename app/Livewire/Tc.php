<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tcor;

class Tc extends Component
{
    public $ttc; // Lista de elementos
    public $newTcor = ''; // Texto ingresado en el input
    public $editingId = null; // ID del elemento en edición

    public function mount()
    {
        $this->loadTcor();
    }

    public function loadTcor()
    {
        $this->ttc = Tcor::orderBy('id', 'desc')->get();
    }

    public function addTcor()
    {
        // Validar el input
        $this->validate([
            'newTcor' => 'required|string|max:255',
        ]);

        // Verificar si ya existe
        if (Tcor::where('tcor', $this->newTcor)->exists()) {
            session()->flash('error', 'El elemento ya existe.');
            return;
        }

        // Guardar en la base de datos
        Tcor::create(['tcor' => $this->newTcor]);

        // Recargar la lista y limpiar el input
        $this->loadTcor();
        $this->newTcor = '';
        session()->flash('success', 'Elemento agregado correctamente.');
    }

    public function startEdit($id)
    {
        $tcor = Tcor::find($id);
        if ($tcor) {
            $this->editingId = $id;
            $this->newTcor = $tcor->tcor;
        }
    }

    public function saveEdit()
    {
        $this->validate([
            'newTcor' => 'required|string|max:255',
        ]);

        // Verificar si ya existe otro elemento con el mismo valor
        if (Tcor::where('tcor', $this->newTcor)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'El elemento ya existe.');
            return;
        }

        $tcor = Tcor::find($this->editingId);
        if ($tcor) {
            $tcor->update(['tcor' => $this->newTcor]);
            $this->loadTcor();
            $this->editingId = null;
            $this->newTcor = '';
            session()->flash('success', 'Elemento actualizado correctamente.');
        }
    }

    public function deleteTcor($id)
    {
        Tcor::find($id)->delete();
        $this->loadTcor();
        session()->flash('success', 'Elemento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.tc');
    }
}
