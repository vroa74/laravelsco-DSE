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


class Edit extends Component
{
    use WithPagination;
    public $legs, $ncors, $tcors, $ccors, $users, $ages;
    public $selectedLegislaturaId, $ffcap, $fncor, $ftcor, $ftcorid;
    public $legislatura, $fcap, $frec, $ncor, $tcor, $ccor, $fofi, $nofi, $nhoj, $rem_nombre, $rem_cargo, $rem_deporg, $rem_dir;
    public $des, $seguimiento, $tur_nom, $tur_cargo, $tur_deporg, $creo, $modifico, $reporte, $estatus;
    public $tcccid = null;
    public $tccctext = '';
    public $filteredCcor = [];
    public $accion = '';

    // Variables para los componentes de la tabla
    public $textarea_1 = 'Hola';
    public $textarea_2 = 'Hola';
    public $input_3_1 = 'Hola';
    public $input_3_2 = 'Hola';
    public $input_3_3 = 'Hola';
    public $input_3_4 = 'Hola';
    public $input_4_1 = 'Hola';
    public $input_4_2 = 'Hola';
    public $input_4_3 = 'Hola';
    public $input_4_4 = 'Hola';

    // Propiedades para el modal de Ages
    public $showModalAgent = false;
    public $searchNombre = '';
    public $searchCargo = '';
    public $searchDeporg = '';
    public $perPage = 10;

    // --- Propiedades para el Modal de Ages ---
    public $isAgeModalOpen = false;
    public $modalAgeFilter = '';
    public $currentAgeAction = ''; // Para saber qué hacer al seleccionar ('fillRemitente', 'fillTurnado', etc.)
    public $isCccorEnabled = false; // Para controlar si el select de clasificación está habilitado
    public $selectedColumn = null; // Para almacenar la columna seleccionada

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

        // Inicializar variables de la tabla
        $this->textarea_1 = 'Hola';
        $this->textarea_2 = 'Hola';
        $this->input_3_1 = 'Hola';
        $this->input_3_2 = 'Hola';
        $this->input_3_3 = 'Hola';
        $this->input_3_4 = 'Hola';
        $this->input_4_1 = 'Hola';
        $this->input_4_2 = 'Hola';
        $this->input_4_3 = 'Hola';
        $this->input_4_4 = 'Hola';

        // Encontrar la legislatura actual y preseleccionar su ID
        $actualLegislatura = $this->legs->firstWhere('actual', true);
        if ($actualLegislatura) {
            $this->selectedLegislaturaId = $actualLegislatura->id;
        }

        // Inicializar el estado de isCccorEnabled basado en tcccid
        $this->isCccorEnabled = !empty($this->tcccid);
        $this->updateFilteredCcor();
    }

    public function selectCorrespondence($fid, $fttcor)
    {
        $this->ftcorid = $fid;
        $this->ftcor = $fttcor;
        $this->tcor = $this->ftcor;
    }

    public function openAgeModal($action, $column = null)
    {
        $this->currentAgeAction = $action;
        $this->accion = $action;
        $this->modalAgeFilter = '';
        $this->isAgeModalOpen = true;
        $this->selectedColumn = $column;
    }

    public function closeAgeModal()
    {
        $this->isAgeModalOpen = false;
        $this->modalAgeFilter = '';
        $this->currentAgeAction = '';
        $this->accion = '';
    }

    public function selectAgeFromModal($ageId)
    {
        $selectedAge = Age::find($ageId);
        if ($selectedAge) {
            $textoSeleccionado = ' '.trim($selectedAge->nombre . ' ' . $selectedAge->cargo . ' ' . $selectedAge->deporg);
            
            switch ($this->selectedColumn) {
                case 'seguimiento':
                    $this->seguimiento = $this->seguimiento ? $this->seguimiento . "\n" . $textoSeleccionado : $textoSeleccionado;
                    break;
                case 'des':
                    $this->des = $this->des ? $this->des . "\n" . $textoSeleccionado : $textoSeleccionado;
                    break;
                case 'Remitente':
                    $this->rem_nombre = $this->rem_nombre ? $this->rem_nombre . "\n" . $selectedAge->nombre : $selectedAge->nombre;
                    $this->rem_cargo = $this->rem_cargo ? $this->rem_cargo . "\n" . $selectedAge->cargo : $selectedAge->cargo;
                    $this->rem_deporg = $this->rem_deporg ? $this->rem_deporg . "\n" . $selectedAge->deporg : $selectedAge->deporg;
                    $this->rem_dir = $this->rem_dir ? $this->rem_dir . "\n" . $selectedAge->dir : $selectedAge->dir;
                    break;
                case 'Turnado:':
                    $this->tur_nom = $this->tur_nom ? $this->tur_nom . "\n" . $selectedAge->nombre : $selectedAge->nombre;
                    $this->tur_cargo = $this->tur_cargo ? $this->tur_cargo . "\n" . $selectedAge->cargo : $selectedAge->cargo;
                    $this->tur_deporg = $this->tur_deporg ? $this->tur_deporg . "\n" . $selectedAge->deporg : $selectedAge->deporg;
                    $this->input_4_4 = $this->input_4_4 ? $this->input_4_4 . "\n" . $selectedAge->dir : $selectedAge->dir;
                    break;
            }
            $this->closeModal();
        }
    }

    public function updatedTcccid($value)
    {
        $this->isCccorEnabled = !empty($value);
        if (!$this->isCccorEnabled) {
            $this->ccor = '';
            $this->tccctext = '';
        } else {
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

    public function openModalAgent($column = null)
    {
        $this->showModalAgent = true;
        $this->selectedColumn = $column;
    }

    public function closeModal()
    {
        $this->showModalAgent = false;
        $this->selectedColumn = null;
        $this->reset(['searchNombre', 'searchCargo', 'searchDeporg']);
    }

    public function getModalAgesProperty()
    {
        $query = Age::query();

        if ($this->searchNombre) {
            $query->where('nombre', 'like', '%' . $this->searchNombre . '%');
        }

        if ($this->searchCargo) {
            $query->where('cargo', 'like', '%' . $this->searchCargo . '%');
        }

        if ($this->searchDeporg) {
            $query->where('deporg', 'like', '%' . $this->searchDeporg . '%');
        }

        return $query->orderBy('nombre')->paginate($this->perPage);
    }

    public function updatedSearchNombre()
    {
        $this->resetPage();
        $this->showModalAgent = true;
    }

    public function updatedSearchCargo()
    {
        $this->resetPage();
        $this->showModalAgent = true;
    }

    public function updatedSearchDeporg()
    {
        $this->resetPage();
        $this->showModalAgent = true;
    }

    public function render()
    {
        return view('livewire.edit', [
            'legs' => $this->legs,
            'ncors' => $this->ncors,
            'tcc' => $this->tcors,
            'ccors' => $this->ccors,
            'users' => $this->users,
            'modalAges' => $this->modalAges,
        ]);
    }

    public function save()
    {
        try {
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

            session()->flash('success', 'Registro guardado exitosamente.');
            
            return redirect()->route('reportesgral');
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'Por favor, verifica los datos del formulario.');
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Error al guardar el registro: ' . $e->getMessage());
            return;
        }
    }
} 