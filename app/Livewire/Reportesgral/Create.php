<?php

namespace App\Livewire\Reportesgral;

use Livewire\Attributes\Computed;
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
use App\Models\UserGroup;
use App\Models\Co;
use App\Models\CosFile;
use App\Traits\HandlesFileUploads;


class Create extends Component
{
    use WithPagination, WithFileUploads, HandlesFileUploads;
    public $selectedLegislaturaId, $ffcap, $fncor, $ftcor, $ftcorid;
    public $legislatura, $fcap, $frec, $ncor, $tcor, $ccor, $fofi, $nofi, $nhoj, $rem_nombre, $rem_cargo, $rem_deporg, $rem_dir;
    public $des, $seguimiento, $tur_nom, $tur_cargo, $tur_deporg, $creo, $modifico, $reporte, $estatus;
    public $rem_id = null; // Para almacenar el ID del usuario seleccionado en Turnado
    public $tcccid = null;
    public $tccctext = '';
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
    
    // --- Propiedades para el Modal de Groups (Turnado) ---
    public $showModalGroups = false;
    public $searchGroupName = '';
    public $searchGroupDescription = '';
    public $perPageGroups = 10;
    public $selectedGroupColumn = null;
    
    // --- Propiedades para manejo de Turnado ---
    public $turnadoType = 'user'; // 'user' o 'group'
    public $selectedGroup = null;
    public $groupMembers = [];
    public $showGroupMembers = false;
    // ------------------------------------------

    // --- Propiedades para manejo de archivos ---
    public $files = [];
    public $fileDescriptions = [];
    // ------------------------------------------

    public function mount()
    {
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
    }

    // Catálogos pequeños: se calculan por petición y no viajan en el estado de Livewire
    #[Computed]
    public function legs()
    {
        return Legislatura::all();
    }

    #[Computed]
    public function ncors()
    {
        return Ncor::all();
    }

    #[Computed]
    public function tcors()
    {
        return Tcor::all();
    }

    #[Computed]
    public function ccors()
    {
        return Ccor::all();
    }

    #[Computed]
    public function filteredCcor()
    {
        return $this->tcccid ? $this->ccors->where('tcor', $this->tcccid) : collect();
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

    // --- Métodos para el Modal de Groups ---
    public function openModalGroups($column = null)
    {
        $this->showModalGroups = true;
        $this->selectedGroupColumn = $column;
    }

    public function closeModalGroups()
    {
        $this->showModalGroups = false;
        $this->selectedGroupColumn = null;
        $this->reset(['searchGroupName', 'searchGroupDescription']);
    }

    public function selectGroupFromModal($groupId)
    {
        $selectedGroup = UserGroup::with('members')->find($groupId);
        if ($selectedGroup) {
            $this->selectedGroup = $selectedGroup;
            $this->groupMembers = $selectedGroup->members;
            $this->turnadoType = 'group';
            
            // Limpiar campos de usuario individual
            $this->tur_nom = '';
            $this->tur_cargo = '';
            $this->tur_deporg = '';
            $this->rem_id = null;
            
            $this->closeModalGroups();
        }
    }

    public function switchToUserTurnado()
    {
        $this->turnadoType = 'user';
        $this->selectedGroup = null;
        $this->groupMembers = [];
        $this->showGroupMembers = false;
    }

    public function switchToGroupTurnado()
    {
        $this->turnadoType = 'group';
        // Limpiar campos de usuario individual
        $this->tur_nom = '';
        $this->tur_cargo = '';
        $this->tur_deporg = '';
        $this->rem_id = null;
    }

    public function toggleGroupMembers()
    {
        $this->showGroupMembers = !$this->showGroupMembers;
    }

    // Método para obtener los Groups paginados y filtrados
    public function getModalGroupsProperty()
    {
        $query = UserGroup::where('active', true);

        if ($this->searchGroupName) {
            $query->where('name', 'like', '%' . $this->searchGroupName . '%');
        }

        if ($this->searchGroupDescription) {
            $query->where('description', 'like', '%' . $this->searchGroupDescription . '%');
        }

        return $query->orderBy('name')->paginate($this->perPageGroups);
    }

    // Reseteo de la paginación al cambiar los filtros de grupos
    public function updatedSearchGroupName()
    {
        $this->resetPage();
        $this->showModalGroups = true;
    }

    public function updatedSearchGroupDescription()
    {
        $this->resetPage();
        $this->showModalGroups = true;
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
            'filteredCcor' => $this->filteredCcor,
            'users' => Auth::user(),
            'modalAges' => ($this->showModalAgent || $this->isAgeModalOpen) ? $this->modalAges : collect(),
            'modalUsers' => $this->showModalUsers ? $this->modalUsers : null,
            'modalGroups' => $this->showModalGroups ? $this->modalGroups : null,
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
                'tcccid' => 'required|exists:tcors,id',
                'ccor' => 'required|exists:ccors,tcor',
                'nhoj' => 'required|numeric|min:1',
                'nofi' => 'required|string|max:255',
                'fofi' => 'required|date',
                'rem_nombre' => 'nullable|string|max:255',
                'rem_cargo' => 'nullable|string|max:255',
                'rem_deporg' => 'nullable|string|max:255',
                'rem_dir' => 'nullable|string|max:255',
                'des' => 'required|string',
                'seguimiento' => 'required|string',
                'tur_nom' => 'nullable|string|max:255',
                'tur_cargo' => 'nullable|string|max:255',
                'tur_deporg' => 'nullable|string|max:255',
            ], [
                'selectedLegislaturaId.required' => 'La legislatura es requerida',
                'selectedLegislaturaId.exists' => 'La legislatura seleccionada no es válida',
                'fcap.required' => 'La fecha de captura es requerida',
                'fcap.date' => 'La fecha de captura debe ser una fecha válida',
                'frec.required' => 'La fecha de recepción es requerida',
                'frec.date' => 'La fecha de recepción debe ser una fecha válida',
                'ncor.required' => 'El nivel de correspondencia es requerido',
                'ncor.exists' => 'El nivel de correspondencia seleccionado no es válido',
                'tcccid.required' => 'El tipo de correspondencia es requerido',
                'tcccid.exists' => 'El tipo de correspondencia seleccionado no es válido',
                'ccor.required' => 'La clasificación es requerida',
                'ccor.exists' => 'La clasificación seleccionada no es válida',
                'nhoj.required' => 'El número de hojas es requerido',
                'nhoj.numeric' => 'El número de hojas debe ser un número',
                'nhoj.min' => 'El número de hojas debe ser mayor a 0',
                'nofi.required' => 'El número de oficio es requerido',
                'fofi.required' => 'La fecha del oficio es requerida',
                'fofi.date' => 'La fecha del oficio debe ser una fecha válida',
                'des.required' => 'La descripción es requerida',
                'seguimiento.required' => 'El seguimiento es requerido',
            ]);

            // Crear y guardar el nuevo registro
            $correspondencia = new Co();
            $correspondencia->legislatura_id = $this->selectedLegislaturaId;
            $correspondencia->fcap = $this->fcap;
            $correspondencia->frec = $this->frec;
            $correspondencia->ncor = $this->ncor;
            $correspondencia->tcor = $this->tccctext;
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
            // Manejar turnado según el tipo seleccionado
            if ($this->turnadoType === 'user') {
                $correspondencia->tur_nom = $this->tur_nom;
                $correspondencia->tur_cargo = $this->tur_cargo;
                $correspondencia->tur_deporg = $this->tur_deporg;
                $correspondencia->rem_id = $this->rem_id;
                $correspondencia->tur_type = 'user';
                $correspondencia->tur_group_id = null;
            } else {
                // Para grupos, guardar el nombre del grupo y su ID
                $correspondencia->tur_nom = $this->selectedGroup ? $this->selectedGroup->name : '';
                $correspondencia->tur_cargo = '';
                $correspondencia->tur_deporg = '';
                $correspondencia->rem_id = null;
                $correspondencia->tur_type = 'group';
                $correspondencia->tur_group_id = $this->selectedGroup ? $this->selectedGroup->id : null;
            }
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
