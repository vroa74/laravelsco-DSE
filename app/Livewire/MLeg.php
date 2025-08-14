<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Legislatura;

class MLeg extends Component
{
    public $legis; // Lista de legislaturas
    public $newLegislatura = ''; // Input para la nueva legislatura
    public $editingId = null; // ID del elemento que se está editando
    public $temp;

    public function mount()
    {
        $this->loadLegislaturas();
    }

    public function loadLegislaturas()
    {
        $this->legis = Legislatura::orderBy('id', 'desc')->get();
    }

    public function addLegislatura()
    {
        // Validar el input
        $this->validate([
            'newLegislatura' => 'required|string|max:15|regex:/^[IVXLCDM]+$/',
        ]);
        // Convertir a uppercase
        $this->newLegislatura = strtoupper($this->newLegislatura);
        // Verificar duplicados
        if (Legislatura::where('legislatura', $this->newLegislatura)->exists()) {
            session()->flash('error', 'La legislatura ya existe.');
            return;
        }

        // Guardar en la base de datos
        Legislatura::create(['legislatura' => $this->newLegislatura, 'actual' => false]);

        // Recargar la lista
        $this->loadLegislaturas();

        // Limpiar el input
        $this->newLegislatura = '';
        session()->flash('success', 'Legislatura agregada correctamente.');
    }

    public function startEdit($id)
    {
        $this->editingId = $id;
        $this->temp = Legislatura::find($id)->legislatura; // Guardar el valor actual en temp
        $this->newLegislatura = $this->temp; // Establecer el valor para editar
    }

    public function saveEdit()
    {
        $this->validate([
            'newLegislatura' => 'required|string|max:15|regex:/^[IVXLCDM]+$/',
        ]);
        $this->newLegislatura = strtoupper($this->newLegislatura);

        // Verificar que el ID en edición exista
        $legislatura = Legislatura::find($this->editingId);
        if (!$legislatura) {
            session()->flash('error', 'Legislatura no encontrada.');
            return;
        }

        // Verificar duplicados (excepto el actual)
        if (Legislatura::where('legislatura', $this->newLegislatura)
            ->where('id', '!=', $this->editingId)
            ->exists()) {
            session()->flash('error', 'La legislatura ya existe.');
            return;
        }

        // Actualizar el registro
        $legislatura->update(['legislatura' => $this->newLegislatura]);

        // Limpiar el estado de edición
        $this->newLegislatura = '';
        $this->editingId = null;
        $this->loadLegislaturas();

        session()->flash('success', 'Legislatura actualizada correctamente.');
    }

    public function deleteLegislatura($id)
    {
        Legislatura::find($id)->delete();
        $this->loadLegislaturas();
        session()->flash('success', 'Legislatura eliminada correctamente.');
    }

    public function setActual($id)
    {
        // Establecer el elemento seleccionado como actual y los demás como falso
        Legislatura::query()->update(['actual' => false]);
        Legislatura::find($id)->update(['actual' => true]);
        $this->loadLegislaturas();
        session()->flash('success', 'Legislatura actual establecida correctamente.');
    }

    public function cancelEdit()
    {
        $this->newLegislatura = '';
        $this->editingId = null;
    }

    public function render()
    {
        return view('livewire.m-leg');
    }
}
