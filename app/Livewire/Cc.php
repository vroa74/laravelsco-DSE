<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Ccor;
use App\Models\Tcor;


class Cc extends Component
{
    public $ccc, $tcc;
    
    // Propiedades para el formulario principal (añadir/editar)
    public $tcccid = null; // ID del Tcor seleccionado en el <select>
    public $newCcorText = ''; // Texto en el <input>
    
    // ID del registro que se está editando (null si se está añadiendo)
    public $editingId = null;
    
    // Propiedades para mostrar info debajo del select (opcional, mantenido de tu código)
    public $tccc = null;
    public $tccctxt = null;

    public function mount()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        $this->ccc = Ccor::all();
        $this->tcc = Tcor::all();
    }

    public function miFuncionPersonalizada($value)
    {
        if ($value && $value != 0) {
            $selected = Tcor::find($value);
            if ($selected) {
                $this->tcccid = $selected->id; // Asegura que el ID está actualizado
                // Actualiza la info mostrada si es necesario (adaptado de tu código)
                $this->tccc = $selected->tcor; // Asumiendo que tcor es el nombre/código
                $this->tccctxt = $selected->ccor; // Asumiendo que ccor es la descripción
            } else {
                $this->reset(['tccc', 'tccctxt', 'tcccid']);
            }
        } else {
             $this->reset(['tccc', 'tccctxt', 'tcccid']);
        }
    }
    
    public function addCcor()
    {
        $this->validate([
            'tcccid' => 'required|exists:tcors,id',
            'newCcorText' => 'required|string|max:255',
        ], [
            'tcccid.required' => 'Selecciona un Nivel de Correspondencia.',
            'newCcorText.required' => 'Ingresa el Texto de Clasificación.',
        ]);

        Ccor::create([
            'tcor' => $this->tcccid,
            'ccor' => $this->newCcorText,
        ]);

        $this->loadData(); // Recarga la lista
        $this->resetForm(); // Limpia el formulario
        session()->flash('message', 'Clasificación añadida.');
    }

    public function startEdit($id)
    {
        $ccor = Ccor::findOrFail($id);
        $this->editingId = $id;
        $this->tcccid = $ccor->tcor; // Carga el ID del Tcor en el select
        $this->newCcorText = $ccor->ccor; // Carga el texto en el input
        
        // Actualiza la info mostrada debajo del select si la tienes
        $this->miFuncionPersonalizada($this->tcccid); 
    }

    public function updateCcor()
    {
        $this->validate([
            'tcccid' => 'required|exists:tcors,id',
            'newCcorText' => 'required|string|max:255',
        ], [
            'tcccid.required' => 'Selecciona un Nivel de Correspondencia.',
            'newCcorText.required' => 'Ingresa el Texto de Clasificación.',
        ]);

        if ($this->editingId) {
            $ccor = Ccor::findOrFail($this->editingId);
            $ccor->update([
                'tcor' => $this->tcccid,
                'ccor' => $this->newCcorText,
            ]);
            $this->loadData(); // Recarga la lista
            $this->resetForm(); // Limpia formulario y sale de modo edición
            session()->flash('message', 'Registro actualizado.');
        } 
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }
    
    protected function resetForm()
    {
         $this->reset(['editingId', 'tcccid', 'newCcorText', 'tccc', 'tccctxt']);
         // Asegúrate que el select visualmente marque la opción por defecto
         $this->dispatch('reset-select'); 
    }

    public function deleteCcor($id) // Cambiado para aceptar solo ID
    {
        $ccor = Ccor::find($id);
        if ($ccor) {
            $ccor->delete();
            $this->loadData(); // Actualiza la lista
            session()->flash('message', 'Registro eliminado correctamente');
            $this->resetForm(); // << Añadir esta línea para limpiar el form
        } else {
             session()->flash('error', 'No se pudo encontrar el registro para eliminar.');
             // Opcional: ¿resetear form también en caso de error?
             // $this->resetForm(); 
        }
    }

    public function render()
    {
        return view('livewire.cc');
    }
}
