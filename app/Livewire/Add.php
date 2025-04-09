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
use App\Models\Co;


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
    public $accion = ''; // Nueva propiedad para almacenar la acción
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
        
        // Inicializar las fechas con el día actual
        $this->fcap = now()->format('Y-m-d');
        $this->frec = now()->format('Y-m-d');
        $this->fofi = now()->format('Y-m-d');
        $this->nhoj = 1;
        $this->nofi = '1';

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
        $this->currentAgeAction = $action;
        $this->accion = $action; // Establecer la acción
        $this->modalAgeFilter = '';
        $this->isAgeModalOpen = true;
    }

    public function closeAgeModal()
    {
        $this->isAgeModalOpen = false;
        $this->modalAgeFilter = '';
        $this->currentAgeAction = '';
        $this->accion = ''; // Limpiar la acción al cerrar
    }

    public function selectAgeFromModal($ageId)
    {
        $selectedAge = Age::find($ageId);
        if ($selectedAge) {
            // Realizar acción basada en $accion
            switch ($this->accion) {
                case 'REM':
                    // Llenar campos de Remitente
                    $this->rem_nombre = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->rem_cargo = $selectedAge->cargo;
                    $this->rem_deporg = $selectedAge->deporg;
                    $this->rem_dir = $selectedAge->dir;
                    break;
                case 'TUR':
                    // Llenar campos de Turnado
                    $this->tur_nom = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->tur_cargo = $selectedAge->cargo;
                    $this->tur_deporg = $selectedAge->deporg;
                    break;
                case 'DES':
                    // Agregar al textarea de Descripción
                    $textoDescripcion = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->des = $this->des ? $this->des . "\n" . $textoDescripcion : $textoDescripcion;
                    break;
                case 'SEG':
                    // Agregar al textarea de Seguimiento
                    $textoSeguimiento = trim($selectedAge->titulo . ' ' . $selectedAge->nombre . ' ' . $selectedAge->apaterno . ' ' . $selectedAge->amaterno);
                    $this->seguimiento = $this->seguimiento ? $this->seguimiento . "\n" . $textoSeguimiento : $textoSeguimiento;
                    break;
            }
        }
        $this->closeAgeModal();
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

    public function save()
    {
        try {
            // Validar los datos del formulario
            $validatedData = $this->validate([
                'selectedLegislaturaId' => 'required|exists:legislaturas,id',
                'fcap' => 'required|date',
                'frec' => 'required|date',
                'ncor' => 'required|exists:ncors,ncor',
                'tcor' => 'required|exists:tcors,tcor',
                'ccor' => 'required|exists:ccors,tcor',
                'nhoj' => 'required|numeric|min:1',
                'nofi' => 'required|string|max:255',
                'fofi' => 'required|date',
                'rem_nombre' => 'string|max:255',
                'rem_cargo' => 'string|max:255',
                'rem_deporg' => 'string|max:255',
                'rem_dir' => 'string|max:255',
                'des' => 'required|string',
                'seguimiento' => 'required|string',
                'tur_nom' => 'string|max:255',
                'tur_cargo' => 'string|max:255',
                'tur_deporg' => 'string|max:255',
            ], [
                'selectedLegislaturaId.required' => 'La legislatura es requerida',
                'selectedLegislaturaId.exists' => 'La legislatura seleccionada no es válida',
                'fcap.required' => 'La fecha de captura es requerida',
                'fcap.date' => 'La fecha de captura debe ser una fecha válida',
                'frec.required' => 'La fecha de recepción es requerida',
                'frec.date' => 'La fecha de recepción debe ser una fecha válida',
                'ncor.required' => 'El nivel de correspondencia es requerido',
                'ncor.exists' => 'El nivel de correspondencia seleccionado no es válido',
                'tcor.required' => 'El tipo de correspondencia es requerido',
                'tcor.exists' => 'El tipo de correspondencia seleccionado no es válido',
                'ccor.required' => 'La clasificación es requerida',
                'ccor.exists' => 'La clasificación seleccionada no es válida',
                'nhoj.required' => 'El número de hojas es requerido',
                'nhoj.numeric' => 'El número de hojas debe ser un número',
                'nhoj.min' => 'El número de hojas debe ser mayor a 0',
                'nofi.required' => 'El número de oficio es requerido',
                'fofi.required' => 'La fecha del oficio es requerida',
                'fofi.date' => 'La fecha del oficio debe ser una fecha válida',
                'rem_nombre.required' => 'El nombre del remitente es requerido',
                'rem_cargo.required' => 'El cargo del remitente es requerido',
                'rem_deporg.required' => 'La dependencia del remitente es requerida',
                'rem_dir.required' => 'La dirección del remitente es requerida',
                'des.required' => 'La descripción es requerida',
                'seguimiento.required' => 'El seguimiento es requerido',
                'tur_nom.required' => 'El nombre del turnado es requerido',
                'tur_cargo.required' => 'El cargo del turnado es requerido',
                'tur_deporg.required' => 'La dependencia del turnado es requerida',
            ]);

            // Crear y guardar el nuevo registro
            $correspondencia = new Co();
            $correspondencia->legislatura_id = $this->selectedLegislaturaId;
            $correspondencia->fcap = $this->fcap;
            $correspondencia->frec = $this->frec;
            $correspondencia->ncor = $this->ncor;
            $correspondencia->tcor = $this->tcor;
            $correspondencia->ccor = $this->ccor;
            $correspondencia->nhoj = $this->nhoj;
            $correspondencia->nofi = $this->nofi;
            $correspondencia->fofi = $this->fofi;
            $correspondencia->rem_nombre = $this->rem_nombre;
            $correspondencia->rem_cargo = $this->rem_cargo;
            $correspondencia->rem_deporg = $this->rem_deporg;
            $correspondencia->rem_dir = $this->rem_dir;
            $correspondencia->des = $this->des;
            $correspondencia->seguimiento = $this->seguimiento;
            $correspondencia->tur_nom = $this->tur_nom;
            $correspondencia->tur_cargo = $this->tur_cargo;
            $correspondencia->tur_deporg = $this->tur_deporg;
            $correspondencia->creo = Auth::user()->email;
            $correspondencia->save();

            // Mostrar mensaje de éxito
            session()->flash('success', 'Registro guardado exitosamente.');
            
            // Redirigir a la página de listado
            return redirect()->route('reportesgral');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación
            session()->flash('error', 'Por favor, verifica los datos del formulario.');
            throw $e;
        } catch (\Exception $e) {
            // Capturar otros errores
            session()->flash('error', 'Error al guardar el registro: ' . $e->getMessage());
            return;
        }
    }
}
