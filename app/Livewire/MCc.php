<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ccor;

class MCc extends Component
{
    public $ccors; // Lista de Clas. Cor.
    public $newCcor = ''; // Input para el nuevo Clas. Cor.
    public $editingId = null; // ID del elemento que se está editando
    public $temp;

    public function mount()
    {
        $this->loadCcors();
    }

    public function loadCcors()
    {
        $this->ccors = Ccor::orderBy('id', 'desc')->get();
    }

    public function addCcor()
    {
        // Validar el input
        $this->validate([
            'newCcor' => 'required|string|max:255',
        ]);

        // Verificar duplicados
        if (Ccor::where('ccor', $this->newCcor)->exists()) {
            session()->flash('error', 'El Clas. Cor. ya existe.');
            return;
        }

        // Guardar en la base de datos
        Ccor::create(['ccor' => $this->newCcor]);

        // Recargar la lista
        $this->loadCcors();

        // Limpiar el input
        $this->newCcor = '';
        session()->flash('success', 'Clas. Cor. agregado correctamente.');
    }

    public function startEdit($id)
    {
        $this->editingId = $id;
        $this->temp = Ccor::find($id)->ccor; // Guardar el valor actual en temp
        $this->newCcor = $this->temp; // Establecer el valor para editar
    }

    public function saveEdit()
    {
        $this->validate([
            'newCcor' => 'required|string|max:255',
        ]);

        // Verificar que el ID en edición exista
        $ccor = Ccor::find($this->editingId);
        if (!$ccor) {
            session()->flash('error', 'Clas. Cor. no encontrado.');
            return;
        }

        // Verificar duplicados (excepto el actual)
        if (Ccor::where('ccor', $this->newCcor)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'El Clas. Cor. ya existe.');
            return;
        }

        // Actualizar el registro
        $ccor->update(['ccor' => $this->newCcor]);

        // Limpiar el estado de edición
        $this->newCcor = '';
        $this->editingId = null;
        $this->loadCcors();

        session()->flash('success', 'Clas. Cor. actualizado correctamente.');
    }

    public function deleteCcor($id)
    {
        Ccor::find($id)->delete();
        $this->loadCcors();
        session()->flash('success', 'Clas. Cor. eliminado correctamente.');
    }

    public function cancelEdit()
    {
        $this->newCcor = '';
        $this->editingId = null;
    }

    public function render()
    {
        return view('livewire.m-cc');
    }
}
