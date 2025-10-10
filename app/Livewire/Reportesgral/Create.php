<?php

namespace App\Livewire\Reportesgral;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Age;
use App\Models\Legislatura;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;
use App\Models\User;
use App\Models\Co;
use App\Models\CosFile;
use App\Traits\HandlesFileUploads;


class Create extends Component
{
    use WithPagination, WithFileUploads, HandlesFileUploads;
    public $legs, $ncors, $tcors, $ccors, $users, $ages;
    public $selectedLegislaturaId, $ffcap, $fncor, $ftcor, $ftcorid;
    public $legislatura, $fcap, $frec, $ncor, $tcor, $ccor, $fofi, $nofi, $nhoj, $rem_nombre, $rem_cargo, $rem_deporg, $rem_dir;
    public $des, $seguimiento, $tur_nom, $tur_cargo, $tur_deporg, $creo, $modifico, $reporte, $estatus;
    public $rem_id = null; // Para almacenar el ID del usuario seleccionado en Turnado
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
    // No necesitamos una propiedad separada para $modalAges, filtraremos $this->ages en render
    // ------------------------------------------

    // --- Propiedades para el Modal de Users (Turnado) ---
    public $showModalUsers = false;
    public $searchUserName = '';
    public $searchUserPosition = '';
    public $searchUserDirection = '';
    public $perPageUsers = 10;
    public $selectedUserColumn = null; // Para almacenar la columna seleccionada para usuarios
    // ------------------------------------------

    // --- Propiedades para manejo de archivos ---
    public $files = [];
    public $fileDescriptions = [];
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

    // --- Métodos para el Modal de Users (Turnado) ---
    public function openModalUsers($column = null)
    {
        $this->showModalUsers = true;
        $this->selectedUserColumn = $column;
    }

    public function closeModalUsers()
    {
        $this->showModalUsers = false;
        $this->selectedUserColumn = null;
        $this->reset(['searchUserName', 'searchUserPosition', 'searchUserDirection']);
    }

    public function selectUserFromModal($userId)
    {
        $selectedUser = User::find($userId);
        if ($selectedUser) {
            $textoSeleccionado = ' '.trim($selectedUser->name . ' ' . $selectedUser->position . ' ' . $selectedUser->direction);
            
            switch ($this->selectedUserColumn) {
                case 'Turnado':
                    $this->tur_nom = $selectedUser->name;
                    $this->tur_cargo = $selectedUser->position;
                    $this->tur_deporg = $selectedUser->direction;
                    $this->rem_id = $selectedUser->id; // Asignar el ID del usuario al rem_id
                    break;
                case 'Remitente':
                    $this->rem_nombre = $selectedUser->name;
                    $this->rem_cargo = $selectedUser->position;
                    $this->rem_deporg = $selectedUser->direction;
                    $this->rem_dir = $selectedUser->direction; // Usar direction como dirección
                    break;
                case 'des':
                    $this->des = $this->des ? $this->des . "\n" . $textoSeleccionado : $textoSeleccionado;
                    break;
                case 'seguimiento':
                    $this->seguimiento = $this->seguimiento ? $this->seguimiento . "\n" . $textoSeleccionado : $textoSeleccionado;
                    break;
            }
            $this->closeModalUsers();
        }
    }

    // Método para obtener los Users paginados y filtrados
    public function getModalUsersProperty()
    {
        $query = User::query();

        if ($this->searchUserName) {
            $query->where('name', 'like', '%' . $this->searchUserName . '%');
        }

        if ($this->searchUserPosition) {
            $query->where('position', 'like', '%' . $this->searchUserPosition . '%');
        }

        if ($this->searchUserDirection) {
            $query->where('direction', 'like', '%' . $this->searchUserDirection . '%');
        }

        return $query->orderBy('name')->paginate($this->perPageUsers);
    }

    // Reseteo de la paginación al cambiar los filtros de usuarios
    public function updatedSearchUserName()
    {
        $this->resetPage();
        $this->showModalUsers = true; // Mantener el modal abierto
    }

    public function updatedSearchUserPosition()
    {
        $this->resetPage();
        $this->showModalUsers = true; // Mantener el modal abierto
    }

    public function updatedSearchUserDirection()
    {
        $this->resetPage();
        $this->showModalUsers = true; // Mantener el modal abierto
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
        return view('livewire.reportesgral.create', [
            'legs' => $this->legs,
            'ncors' => $this->ncors,
            'tcc' => $this->tcors,
            'ccors' => $this->ccors,
            'users' => $this->users,
            'modalAges' => $this->modalAges,
            'modalUsers' => $this->modalUsers,
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
            $correspondencia->rem_id = $this->rem_id; // Asignar el rem_id del usuario seleccionado
            $correspondencia->creo = Auth::user()->email;
            $correspondencia->save();

            // Guardar archivos si existen
            if (!empty($this->files)) {
                foreach ($this->files as $index => $file) {
                    $this->saveSingleFile($file, $correspondencia->id, $index, Auth::user()->email);
                }
            }

            // Mostrar mensaje de éxito
            session()->flash('success', 'Registro guardado exitosamente.');
            
            // Redirigir a la página de listado
            return redirect()->route('rg.index');
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

    public function removeFile($index)
    {
        if (isset($this->files[$index])) {
            unset($this->files[$index]);
            $this->files = array_values($this->files); // Reindexar el array
        }
    }

    public function cancel()
    {
        return redirect()->route('rg.index');
    }
}
