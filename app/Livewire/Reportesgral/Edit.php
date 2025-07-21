<?php

namespace App\Livewire\Reportesgral;

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
    public $recordId; // ID del registro a editar

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
    // No necesitamos una propiedad separada para $modalAges, filtraremos $this->ages en render
    // ------------------------------------------

    public function mount($id = null)
    {
        // Cargar todos los registros necesarios
        $this->ages = Age::all();
        $this->legs = Legislatura::all();
        $this->ncors = Ncor::all();
        $this->tcors = Tcor::all();
        $this->ccors = Ccor::all();
        $this->users = Auth::user();
        
        // Si se proporciona un ID, cargar el registro para editar
        if ($id) {
            $this->recordId = $id;
            $this->loadRecord($id);
        }

        // Inicializar el estado de isCccorEnabled basado en tcccid
        $this->isCccorEnabled = !empty($this->tcccid);
        $this->updateFilteredCcor();
    }

    public function loadRecord($id)
    {
        $record = Co::findOrFail($id);
        
        // Cargar los datos del registro en las propiedades del componente
        $this->selectedLegislaturaId = $record->legislatura_id;
        $this->fcap = $record->fcap;
        $this->frec = $record->frec;
        $this->ncor = $record->ncor;
        $this->tcor = $record->tcor;
        $this->ccor = $record->ccor;
        $this->nhoj = $record->nhoj;
        $this->nofi = $record->nofi;
        $this->fofi = $record->fofi;
        $this->rem_nombre = $record->rem_nombre;
        $this->rem_cargo = $record->rem_cargo;
        $this->rem_deporg = $record->rem_deporg;
        $this->rem_dir = $record->rem_dir;
        $this->des = $record->des;
        $this->seguimiento = $record->seguimiento;
        $this->tur_nom = $record->tur_nom;
        $this->tur_cargo = $record->tur_cargo;
        $this->tur_deporg = $record->tur_deporg;

        // Establecer el tcccid basado en el tcor para habilitar la clasificación
        $this->tcccid = $this->tcors->where('tcor', $record->tcor)->first()?->id;
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
    public function openAgeModal($action, $column = null)
    {
        $this->currentAgeAction = $action;
        $this->accion = $action; // Establecer la acción
        $this->modalAgeFilter = '';
        $this->isAgeModalOpen = true;
        $this->selectedColumn = $column; // Guardar la columna seleccionada
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
            $textoSeleccionado = ' '.trim($selectedAge->nombre . ' ' . $selectedAge->cargo . ' ' . $selectedAge->deporg);
            
            // Lógica para el modal principal
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

    // Método para abrir el modal
    public function openModalAgent($column = null)
    {
        $this->showModalAgent = true;
        $this->selectedColumn = $column;
    }

    // Método para cerrar el modal
    public function closeModal()
    {
        $this->showModalAgent = false;
        $this->selectedColumn = null;
        $this->reset(['searchNombre', 'searchCargo', 'searchDeporg']);
    }

    // Método para obtener los Ages paginados y filtrados
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

    // Reseteo de la paginación al cambiar los filtros
    public function updatedSearchNombre()
    {
        $this->resetPage();
        $this->showModalAgent = true; // Mantener el modal abierto
    }

    public function updatedSearchCargo()
    {
        $this->resetPage();
        $this->showModalAgent = true; // Mantener el modal abierto
    }

    public function updatedSearchDeporg()
    {
        $this->resetPage();
        $this->showModalAgent = true; // Mantener el modal abierto
    }

    public function render()
    {
        return view('livewire.reportesgral.edit', [
            'legs' => $this->legs,
            'ncors' => $this->ncors,
            'tcc' => $this->tcors,
            'ccors' => $this->ccors,
            'users' => $this->users,
            'modalAges' => $this->modalAges,
        ]);
    }

    public function update()
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

            // Buscar y actualizar el registro existente
            $correspondencia = Co::findOrFail($this->recordId);
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
            $correspondencia->modifico = Auth::user()->email;
            $correspondencia->save();

            // Mostrar mensaje de éxito
            session()->flash('success', 'Registro actualizado exitosamente.');
            
            // Redirigir a la página de listado
            return redirect()->route('rg.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación
            session()->flash('error', 'Por favor, verifica los datos del formulario.');
            throw $e;
        } catch (\Exception $e) {
            // Capturar otros errores
            session()->flash('error', 'Error al actualizar el registro: ' . $e->getMessage());
            return;
        }
    }

    public function cancel()
    {
        return redirect()->route('rg.index');
    }
}
