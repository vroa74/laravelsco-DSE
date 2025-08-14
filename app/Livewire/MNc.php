<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ncor;

class MNc extends Component
{
    public $ncors; // Lista de N. Cor.
    public $newNcor = ''; // Input para el nuevo N. Cor.
    public $editingId = null; // ID del elemento que se está editando
    public $temp;

    public function mount()
    {
        $this->loadNcors();
    }

    public function loadNcors()
    {
        $this->ncors = Ncor::orderBy('id', 'desc')->get();
    }

    public function addNcor()
    {
        // Validar el input
        $this->validate([
            'newNcor' => 'required|string|max:255',
        ]);

        // Verificar duplicados
        if (Ncor::where('ncor', $this->newNcor)->exists()) {
            session()->flash('error', 'El N. Cor. ya existe.');
            return;
        }

        // Guardar en la base de datos
        Ncor::create(['ncor' => $this->newNcor]);

        // Recargar la lista
        $this->loadNcors();

        // Limpiar el input
        $this->newNcor = '';
        session()->flash('success', 'N. Cor. agregado correctamente.');
    }

    public function startEdit($id)
    {
        $this->editingId = $id;
        $this->temp = Ncor::find($id)->ncor; // Guardar el valor actual en temp
        $this->newNcor = $this->temp; // Establecer el valor para editar
    }

    public function saveEdit()
    {
        $this->validate([
            'newNcor' => 'required|string|max:255',
        ]);

        // Verificar que el ID en edición exista
        $ncor = Ncor::find($this->editingId);
        if (!$ncor) {
            session()->flash('error', 'N. Cor. no encontrado.');
            return;
        }

        // Verificar duplicados (excepto el actual)
        if (Ncor::where('ncor', $this->newNcor)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'El N. Cor. ya existe.');
            return;
        }

        // Actualizar el registro
        $ncor->update(['ncor' => $this->newNcor]);

        // Limpiar el estado de edición
        $this->newNcor = '';
        $this->editingId = null;
        $this->loadNcors();

        session()->flash('success', 'N. Cor. actualizado correctamente.');
    }

    public function deleteNcor($id)
    {
        Ncor::find($id)->delete();
        $this->loadNcors();
        session()->flash('success', 'N. Cor. eliminado correctamente.');
    }

    public function cancelEdit()
    {
        $this->newNcor = '';
        $this->editingId = null;
    }

    public function render()
    {
        return view('livewire.m-nc');
    }
}
