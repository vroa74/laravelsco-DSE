<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Legislatura;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;

class Cat extends Component
{

    public $ncorss;
    public $tcorss;
    public $ccorss; // Listas adicionales
    public $newLegislatura; // Variable para el nuevo input de legislatura

    public function mount()
    {
        $this->legis = Legislatura::all(); // Cargar legislaturas
        $this->ncorss = Ncor::all(); // Cargar datos de Ncor
        $this->tcorss = Tcor::all(); // Cargar datos de Tcor
        $this->ccorss = Ccor::all(); // Cargar datos de Ccor
        $this->newLegislatura = ''; // Inicializar el valor del input
    }

    public function addLegislatura()
    {
        // Validar el input
        $this->validate([
            'newLegislatura' => 'required|string|max:15',
        ]);

        // Crear una nueva legislatura
        $newEntry = Legislatura::create([
            'legislatura' => $this->newLegislatura,
            'actual' => false, // Si el campo "actual" existe, lo marcamos como true
        ]);
        // Actualizar la lista en tiempo real
        $this->legis->push($newEntry);
        // Limpiar el input
        $this->newLegislatura = '';
        // Mensaje de éxito (opcional)
        session()->flash('message', 'Legislatura agregada correctamente.');
    }

    public function render()
    {
        return view('livewire.cat');
    }
}
