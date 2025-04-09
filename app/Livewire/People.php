<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Age;

use Barryvdh\DomPDF\Facade\Pdf;  //esta libreria es para generar el reporte con doom pdf

class People extends Component
{
    use WithPagination;

    public $perPage = 10;  /// variable de la paginacion
    public $queryStringPreview = '';// Variable para mostrar el query

    //variables de la migracion y del modelo
    //    public $titulo, $nombre, $apaterno, $amaterno, $cargo, $deporg;
    //    public $telefono, $email, $dir, $modifico ;
    //    variables para los filtros

    public $filtitulo, $filnombre, $filapaterno, $filamaterno, $filcargo, $fildeporg;
    public $filtelefono, $filemail, $fildir, $filmodifico ;

    public $selectedRecord;

    public $editRecordId;
    public $editTitulo, $editNombre, $editApaterno, $editAmaterno, $editCargo, $editDeporg, $editTelefono, $editEmail, $editDir;
    protected $paginationTheme = 'tailwind';

    public function buildFilteredQuery()
    {
        $query = Age::query();

        if ($this->filtitulo) {
            $query->where('titulo', 'like', '%' . $this->filtitulo . '%');
        }
        if ($this->filnombre) {
            $query->where('nombre', 'like', '%' . $this->filnombre . '%');
        }
        if ($this->filapaterno) {
            $query->where('apaterno', 'like', '%' . $this->filapaterno . '%');
        }
        if ($this->filamaterno) {
            $query->where('amaterno', 'like', '%' . $this->filamaterno . '%');
        }
        if ($this->filcargo) {
            $query->where('cargo', 'like', '%' . $this->filcargo . '%');
        }
        if ($this->fildeporg) {
            $query->where('deporg', 'like', '%' . $this->fildeporg . '%');
        }
        if ($this->filtelefono) {
            $query->where('telefono', 'like', '%' . $this->filtelefono . '%');
        }
        if ($this->filemail) {
            $query->where('email', 'like', '%' . $this->filemail . '%');
        }
        if ($this->fildir) {
            $query->where('dir', 'like', '%' . $this->fildir . '%');
        }
        if ($this->filmodifico) {
            $query->where('modifico', 'like', '%' . $this->filmodifico . '%');
        }

        return $query;
    }

//-----------------   begin insertar nuevo registro -- variables-----------------------------
        public $isInsertModalOpen = false; // Controla la visibilidad del modal de inserción
        public $isViewqueryModalOpen = false; // Controla la visibilidad del modal de inserción

        public $newTitulo, $newNombre, $newApaterno, $newAmaterno, $newCargo, $newDeporg, $newTelefono, $newEmail, $newDir;
        //   begin insertar nuevo registro -- variables
        // begin insertar registro funciones -----------------------------------------------------------------------------
        public function openInsertModal()
        {
            $this->isInsertModalOpen = true;
        }
        public function openViewQuery(){
            $this->isViewqueryModalOpen = true;
        }
    public function closeViewQuery(){
        $this->isViewqueryModalOpen = false;
    }

        public function closeInsertModal()
        {
            $this->isInsertModalOpen = false;
            $this->reset(['newTitulo', 'newNombre', 'newApaterno', 'newAmaterno', 'newCargo', 'newDeporg', 'newTelefono', 'newEmail', 'newDir']);
        }


        public function saveNewRecord()
        {
            $this->validate([
                'newTitulo' => 'nullable|string|max:15',
                'newNombre' => 'nullable|string|max:30',
                'newApaterno' => 'nullable|string|max:30',
                'newAmaterno' => 'nullable|string|max:30',
                'newCargo' => 'nullable|string|max:30',
                'newDeporg' => 'nullable|string|max:60',
                'newTelefono' => 'nullable|string|max:255',
                'newEmail' => 'nullable|email|max:255',
                'newDir' => 'nullable|string',
            ]);

            Age::create([
                'titulo' => $this->newTitulo,
                'nombre' => $this->newNombre,
                'apaterno' => $this->newApaterno,
                'amaterno' => $this->newAmaterno,
                'cargo' => $this->newCargo,
                'deporg' => $this->newDeporg,
                'telefono' => $this->newTelefono,
                'email' => $this->newEmail,
                'dir' => $this->newDir,
            ]);

            $this->closeInsertModal();
        }
//--------- end insertar registro funciones -----------------------------------------------------------------------------
//--------- begin borrar registro -----------------------------------------------------------------------------
// Declarar variables necesarias
    public $deleteRecordId = null;
    public $recordToDelete = null;

// Método para preparar el borrado
    public function confirmDelete($id)
    {
        $this->deleteRecordId = $id; // Almacena el ID del registro a borrar
        $this->recordToDelete = Age::find($id);
    }
// Método para realizar el borrado
    public function deleteRecord()
    {
        if ($this->deleteRecordId) {
            $record = Age::find($this->deleteRecordId);
            if ($record) {
                $record->delete(); // Borra el registro
            }
        }
        $this->deleteRecordId = null; // Restablece la variable
        $this->recordToDelete = null; // Restablece la variable del registro a borrar
        session()->flash('message', 'Registro eliminado correctamente.');
    }
//--------- end borrar registro -----------------------------------------------------------------------------
//--------- Begin Exportar registro -----------------------------------------------------------------------------


    public function exportPDF()
    {
        // Obtener los datos con los mismos filtros aplicados
        $data = $this->buildFilteredQuery()->orderBy('id', 'desc')->get();

        // Generar el PDF usando la vista y los datos
        $pdf = Pdf::loadView('reports.age-report', ['ages' => $data]);

        // Retornar la descarga del PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'lista-ages.pdf');
    }
    //--------- End Exportar registro -----------------------------------------------------------------------------

    // Begin  editar registro -------------------------------------------------------------------
    public function editRecord($id)
    {
        $record = Age::findOrFail($id);
        $this->editRecordId = $record->id;
        $this->editTitulo = $record->titulo;
        $this->editNombre = $record->nombre;
        $this->editApaterno = $record->apaterno;
        $this->editAmaterno = $record->amaterno;
        $this->editCargo = $record->cargo;
        $this->editDeporg = $record->deporg;
        $this->editTelefono = $record->telefono;
        $this->editEmail = $record->email;
        $this->editDir = $record->dir;
    }
// Actualizar el registro
    public function updateRecord()
    {
        $this->validate([
            'editTitulo' => 'nullable|string|max:15',
            'editNombre' => 'nullable|string|max:30',
            'editApaterno' => 'nullable|string|max:30',
            'editAmaterno' => 'nullable|string|max:30',
            'editCargo' => 'nullable|string|max:30',
            'editDeporg' => 'nullable|string|max:60',
            'editTelefono' => 'nullable|string|max:255',
            'editEmail' => 'nullable|email|max:255',
            'editDir' => 'nullable|string',
        ]);
        $record = Age::findOrFail($this->editRecordId);
        $record->update([
            'titulo' => $this->editTitulo,
            'nombre' => $this->editNombre,
            'apaterno' => $this->editApaterno,
            'amaterno' => $this->editAmaterno,
            'cargo' => $this->editCargo,
            'deporg' => $this->editDeporg,
            'telefono' => $this->editTelefono,
            'email' => $this->editEmail,
            'dir' => $this->editDir,
        ]);
        $this->closeEditModal();
    }

// Cerrar el modal de edición
    public function closeEditModal()
    {
        $this->reset(['editRecordId', 'editTitulo', 'editNombre', 'editApaterno', 'editAmaterno', 'editCargo', 'editDeporg', 'editTelefono', 'editEmail', 'editDir']);
    }
    //  end editar registro -------------------------------------------------------------------
    // Acordión-------------------------------------------------------------------------------------------------------
    public $isOpen = true;
    public function showRecord($id)
    {
        // Buscar y asignar el registro a la variable
        $this->selectedRecord = Age::findOrFail($id);
    }
    public function closeModal()
    {
        $this->selectedRecord = null; // Resetear el registro seleccionado
    }

    protected $rules = [
        'titulo' => 'nullable|string|max:15',
        'nombre' => 'nullable|string|max:30',
        'apaterno' => 'nullable|string|max:30',
        'amaterno' => 'nullable|string|max:30',
        'cargo' => 'nullable|string|max:30',
        'deporg' => 'nullable|string|max:60',
        'telefono' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'dir' => 'nullable|string',
        'modifico' => 'nullable|string|max:20',
    ];

    public function toggleAccordion()
    {
        $this->isOpen = !$this->isOpen; // Alterna entre abierto y cerrado
    }

    public function save()
    {
        $this->validate();
        if ($this->editing) {
            Age::find($this->editing)->update($this->getValidated());
        } else {
            Age::create($this->getValidated());
        }
        $this->resetForm();
        $this->toggleAccordion();
    }

    public function edit($id)
    {
        $this->editRecordId = $id;
        $record = Age::findOrFail($id);
        
        $this->editTitulo = $record->titulo;
        $this->editNombre = $record->nombre;
        $this->editApaterno = $record->apaterno;
        $this->editAmaterno = $record->amaterno;
        $this->editCargo = $record->cargo;
        $this->editDeporg = $record->deporg;
        $this->editTelefono = $record->telefono;
        $this->editEmail = $record->email;
        $this->editDir = $record->dir;
        
        $this->toggleAccordion();
    }
    
    public function resetForm()    {
        $this->reset([
            'titulo',
            'nombre',
            'apaterno',
            'amaterno',
            'cargo',
            'deporg',
            'telefono',
            'email',
            'dir',
            'modifico',
            'editing',
        ]);
    }

    // Reseteo de la paginación al cambiar `$perPage`
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        // Reseteo de la página al actualizar cualquier filtro
        $this->resetPage();
    }


    public function render()
    {
        $query = $this->buildFilteredQuery();

        // Guardar el query generado en formato SQL (opcional para debug)
        $this->queryStringPreview = $query->toSql();

        return view('livewire.people', [
            'ages' => $query->orderBy('id', 'desc')->paginate($this->perPage),
        ]);
    }}
