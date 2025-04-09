<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Age;
use App\Models\Legislatura;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;
use App\Models\User;


class Add extends Component
{
    use WithPagination;
    public $legs, $ncors, $tcors, $ccors, $users, $ages;
    public $selectedLegislaturaId, $ffcap, $fncor, $ftcor, $ftcorid;
    public $legislatura, $fcap, $frec, $ncor, $tcor, $ccor, $fofi, $nofi, $nhoj, $rem_nombre, $rem_cargo, $rem_deporg, $rem_dir;
    public $des, $seguimiento, $tur_nom, $tur_cargo, $tur_deporg, $creo, $modifico, $reporte, $estatus;
    public $tcccid = null;
    public $tccctext = '';
    public $filteredCcor = []; // Nueva propiedad para almacenar las clasificaciones filtradas
    // Quitar $selectedId y $selectedTcor si ya no se usan globalmente
    // public $selectedId = null;
    // public $selectedTcor = null;

    // --- Propiedades para el Modal de Ages ---
    public $isAgeModalOpen = false;
    public $modalAgeFilter = '';
    public $currentAgeAction = ''; // Para saber qué hacer al seleccionar ('fillRemitente', 'fillTurnado', etc.)
    public $isCccorEnabled = false; // Para controlar si el select de clasificación está habilitado
    // No necesitamos una propiedad separada para $modalAges, filtraremos $this->ages en render
    // ------------------------------------------

    public function mount()
    {
        // Cargar todos los registros necesarios
        $this->ages = Age::all();
        $this->legs = Legislatura::all();
        $this->ncors = Ncor::all();
        $this->tcors = Tcor::all();
        $this->ccors = Ccor::all();
        $this->users = Auth::user();

        // Encontrar la legislatura actual y preseleccionar su ID
        $actualLegislatura = $this->legs->firstWhere('actual', true);
        if ($actualLegislatura) {
            $this->selectedLegislaturaId = $actualLegislatura->id;
        }

        // Inicializar el estado de isCccorEnabled basado en tcccid
        $this->isCccorEnabled = !empty($this->tcccid);
        $this->updateFilteredCcor();
    }
    // Mantener la función selectCorrespondence optimizada
    public function selectCorrespondence($fid, $fttcor)
    {
        $this->ftcorid = $fid;
        $this->ftcor = $fttcor;
        $this->tcor = $this->ftcor;
    }

    // --- Métodos para el Modal de Ages ---
    public function openAgeModal($action)
    {
        $this->currentAgeAction = $action; // Guarda la acción a realizar
        $this->modalAgeFilter = ''; // Resetea el filtro cada vez que se abre
        $this->isAgeModalOpen = true;
    }

    public function closeAgeModal()
    {
        $this->isAgeModalOpen = false;
        $this->modalAgeFilter = '';
        $this->currentAgeAction = '';
    }

    public function selectAgeFromModal($ageId)
    {
        $selectedAge = Age::find($ageId);
        if ($selectedAge) {
            // Realizar acción basada en $currentAgeAction
            switch ($this->currentAgeAction) {
                case 'fillRemitente':
                    $this->rem_nombre = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->rem_cargo = $selectedAge->cargo;
                    $this->rem_deporg = $selectedAge->deporg;
                    $this->rem_dir = $selectedAge->dir;
                    break;
                case 'fillTurnado':
                    // Asumiendo que los campos de Turnado se llaman así
                    $this->tur_nom = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->tur_cargo = $selectedAge->cargo;
                    $this->tur_deporg = $selectedAge->deporg;
                    // ¿Hay algún otro campo de turnado que coincida con Age?
                    break;
                // Puedes añadir más casos para otras acciones
                // case 'otraAccion':
                //     // ...
                //     break;
            }
        }
        $this->closeAgeModal(); // Cierra el modal después de seleccionar
    }

    // --- Método para actualizar el estado de habilitación del select de clasificación ---
    public function updatedTcccid($value)
    {
        $this->isCccorEnabled = !empty($value);
        if (!$this->isCccorEnabled) {
            $this->ccor = ''; // Resetear el valor de clasificación si se deshabilita
            $this->tccctext = ''; // Resetear el texto
        } else {
            // Obtener el texto del tipo de correspondencia seleccionado
            $selectedTcor = $this->tcors->find($value);
            $this->tccctext = $selectedTcor ? $selectedTcor->tcor : '';
        }
        $this->updateFilteredCcor();
    }

    protected function updateFilteredCcor()
    {
        if ($this->tcccid) {
            $this->filteredCcor = $this->ccors->where('tcor', $this->tcccid);
        } else {
            $this->filteredCcor = collect([]);
        }
    }
    // -------------------------------------

    public function render()
    {
        // Filtrar los datos para el modal si está abierto
        $modalAgesData = collect(); // Inicializa como colección vacía
        if ($this->isAgeModalOpen) {
            $query = Age::query();
            if (!empty($this->modalAgeFilter)) {
                $filter = '%' . $this->modalAgeFilter . '%';
                // Busca en múltiples campos
                $query->where(function ($q) use ($filter) {
                    $q->where('titulo', 'like', $filter)
                      ->orWhere('nombre', 'like', $filter)
                      ->orWhere('apaterno', 'like', $filter)
                      ->orWhere('amaterno', 'like', $filter)
                      ->orWhere('cargo', 'like', $filter)
                      ->orWhere('deporg', 'like', $filter)
                      ->orWhere('telefono', 'like', $filter)
                      ->orWhere('email', 'like', $filter)
                      ->orWhere('dir', 'like', $filter);
                });
            }
            $modalAgesData = $query->orderBy('nombre')->orderBy('apaterno')->get();
            // Alternativa si $this->ages ya tiene *todos* los registros y no son demasiados:
            // $modalAgesData = $this->ages->filter(function ($age) {
            //     $filterLower = strtolower($this->modalAgeFilter);
            //     return str_contains(strtolower($age->titulo ?? ''), $filterLower) ||
            //            str_contains(strtolower($age->nombre ?? ''), $filterLower) ||
            //            str_contains(strtolower($age->apaterno ?? ''), $filterLower) ||
            //            str_contains(strtolower($age->amaterno ?? ''), $filterLower) ||
            //            str_contains(strtolower($age->cargo ?? ''), $filterLower) ||
            //            str_contains(strtolower($age->deporg ?? ''), $filterLower);
            // });
        }

        // Ya no es necesario paginar aquí si el modal usa su propia query
        // $ages = Age::paginate(10);

        return view('livewire.add', [
            // 'ages' => $ages, // Quitar si ya no se usa fuera del modal
            'legs' => $this->legs,
            'ncors' => $this->ncors,
            'tcc' => $this->tcors,
            'ccors' => $this->ccors,
            'users' => $this->users,
            'modalAges' => $modalAgesData, // Pasar los datos filtrados para el modal
        ]);
    }
}
