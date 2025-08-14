<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tcor;

class MTc extends Component
{
    public $tcors; // Lista de T. Cor.
    public $newTcor = ''; // Input para el nuevo T. Cor.
    public $editingId = null; // ID del elemento que se está editando
    public $temp;

    public function mount()
    {
        $this->loadTcors();
    }

    public function loadTcors()
    {
        $this->tcors = Tcor::orderBy('id', 'desc')->get();
    }

    public function addTcor()
    {
        // Validar el input
        $this->validate([
            'newTcor' => 'required|string|max:255',
        ]);

        // Verificar duplicados
        if (Tcor::where('tcor', $this->newTcor)->exists()) {
            session()->flash('error', 'El T. Cor. ya existe.');
            return;
        }

        // Guardar en la base de datos
        Tcor::create(['tcor' => $this->newTcor]);

        // Recargar la lista
        $this->loadTcors();

        // Limpiar el input
        $this->newTcor = '';
        session()->flash('success', 'T. Cor. agregado correctamente.');
    }

    public function startEdit($id)
    {
        $this->editingId = $id;
        $this->temp = Tcor::find($id)->tcor; // Guardar el valor actual en temp
        $this->newTcor = $this->temp; // Establecer el valor para editar
    }

    public function saveEdit()
    {
        $this->validate([
            'newTcor' => 'required|string|max:255',
        ]);

        // Verificar que el ID en edición exista
        $tcor = Tcor::find($this->editingId);
        if (!$tcor) {
            session()->flash('error', 'T. Cor. no encontrado.');
            return;
        }

        // Verificar duplicados (excepto el actual)
        if (Tcor::where('tcor', $this->newTcor)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'El T. Cor. ya existe.');
            return;
        }

        // Actualizar el registro
        $tcor->update(['tcor' => $this->newTcor]);

        // Limpiar el estado de edición
        $this->newTcor = '';
        $this->editingId = null;
        $this->loadTcors();

        session()->flash('success', 'T. Cor. actualizado correctamente.');
    }

    public function deleteTcor($id)
    {
        Tcor::find($id)->delete();
        $this->loadTcors();
        session()->flash('success', 'T. Cor. eliminado correctamente.');
    }

    public function cancelEdit()
    {
        $this->newTcor = '';
        $this->editingId = null;
    }

    public function render()
    {
        return view('livewire.m-tc');
    }
}
