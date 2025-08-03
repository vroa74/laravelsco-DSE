<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $perPage = 10;
    public $queryStringPreview = '';

    // Variables para los filtros
    public $filname = '', $filrfc = '', $filcurp = '', $filposition = '', $filsex = '', $fillvl = '', $filtipo = '', $filstatus = '', $filemail = '', $fildirection = '';

    public $selectedRecord;

    public $editRecordId;
    public $editName, $editRfc, $editCurp, $editPosition, $editSex, $editLvl, $editTipo, $editStatus, $editEmail, $editDirection, $editPassword, $editPasswordConfirmation, $editProfilePhoto, $editProfilePhotoPath;
    
    // Variables para el modal de creación (duplicado del modal de edición)
    public $createModalOpen = false;
    public $createName, $createRfc, $createCurp, $createPosition, $createSex, $createLvl, $createTipo, $createStatus, $createEmail, $createDirection, $createPassword, $createPasswordConfirmation, $createProfilePhoto;
    
    // Variables para mostrar/ocultar contraseñas
    public $showEditPassword = false;
    public $showEditPasswordConfirmation = false;
    public $showCreatePassword = false;
    public $showCreatePasswordConfirmation = false;
    protected $paginationTheme = 'tailwind';
    
    // Variables adicionales del componente original
    public $deleteRecordId = null;
    public $editing = null;
    public $name, $rfc, $curp, $position, $sex, $lvl, $tipo, $status, $email, $direction;
    
    // Variables para el acordeón y modales
    public $isOpen = true;
    public $isInsertModalOpen = false;
    public $isViewqueryModalOpen = false;
    public $recordToDelete;

    public $newName, $newRfc, $newCurp, $newPosition, $newSex, $newLvl, $newTipo, $newStatus, $newEmail, $newDirection, $newPassword, $newPasswordConfirmation, $newProfilePhoto;

    public function buildFilteredQuery()
    {
        $query = User::query();

        if (!empty($this->filname)) {
            $query->where('name', 'like', '%' . $this->filname . '%');
        }
        if (!empty($this->filrfc)) {
            $query->where('rfc', 'like', '%' . $this->filrfc . '%');
        }
        if (!empty($this->filcurp)) {
            $query->where('curp', 'like', '%' . $this->filcurp . '%');
        }
        if (!empty($this->filposition)) {
            $query->where('position', $this->filposition);
        }
        if (!empty($this->filsex)) {
            $query->where('sex', $this->filsex);
        }
        if (!empty($this->fillvl)) {
            $query->where('lvl', $this->fillvl);
        }
        if (!empty($this->filtipo)) {
            $query->where('tipo', $this->filtipo);
        }
        if ($this->filstatus !== null && $this->filstatus !== '') {
            $query->where('status', $this->filstatus);
        }
        if (!empty($this->filemail)) {
            $query->where('email', 'like', '%' . $this->filemail . '%');
        }
        if (!empty($this->fildirection)) {
            $query->where('direction', $this->fildirection);
        }

        return $query->orderBy('id', 'asc');
    }

    public function openInsertModal()
    {
        $this->isInsertModalOpen = true;
    }

    public function openCreateModal()
    {
        $this->createModalOpen = true;
        // Inicializar valores por defecto
        $this->createStatus = true;
        $this->createTipo = 3;
    }

    public function closeCreateModal()
    {
        $this->createModalOpen = false;
        // Limpiar foto temporal si existe
        if ($this->createProfilePhoto) {
            $this->createProfilePhoto = null;
        }
        // Resetear todos los campos
        $this->reset([
            'createName', 'createRfc', 'createCurp', 'createPosition', 'createSex', 
            'createLvl', 'createTipo', 'createStatus', 'createEmail', 'createDirection', 
            'createPassword', 'createPasswordConfirmation', 'showCreatePassword', 'showCreatePasswordConfirmation'
        ]);
    }

    public function saveCreateRecord()
    {
        $this->validate([
            'createName' => 'required|string|max:255',
            'createRfc' => 'nullable|string|max:13|unique:users,rfc',
            'createCurp' => 'nullable|string|max:20|unique:users,curp',
            'createPosition' => 'nullable|string|max:35',
            'createSex' => 'nullable|in:masculino,femenino',
            'createLvl' => 'nullable|string|max:10',
            'createTipo' => 'nullable|integer',
            'createStatus' => 'nullable|boolean',
            'createEmail' => 'required|email|max:255|unique:users,email',
            'createDirection' => 'nullable|string|max:250',
            'createPassword' => 'required|string|min:8|confirmed',
            'createProfilePhoto' => 'nullable|image|max:2048', // 2MB máximo
        ]);

        $createData = [
            'name' => $this->createName,
            'rfc' => $this->createRfc,
            'curp' => $this->createCurp,
            'position' => $this->createPosition,
            'sex' => $this->createSex,
            'lvl' => $this->createLvl,
            'tipo' => $this->createTipo ?? 3,
            'status' => $this->createStatus ?? true,
            'email' => $this->createEmail,
            'direction' => $this->createDirection,
            'password' => bcrypt($this->createPassword),
        ];

        // Manejar foto de perfil
        if ($this->createProfilePhoto) {
            $photoPath = $this->createProfilePhoto->store('profile-photos', 'public');
            $createData['profile_photo_path'] = $photoPath;
        }

        User::create($createData);

        $this->closeCreateModal();
        session()->flash('message', 'Usuario creado exitosamente.');
        
        // Forzar actualización de la tabla para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    public function updatedCreateProfilePhoto()
    {
        // Este método se ejecuta cuando se selecciona una nueva foto en creación
        if ($this->createProfilePhoto) {
            // Forzar actualización de la vista para mostrar la vista previa
            $this->dispatch('$refresh');
        }
    }

    // Métodos para mostrar/ocultar contraseñas
    public function toggleEditPassword()
    {
        $this->showEditPassword = !$this->showEditPassword;
    }

    public function toggleEditPasswordConfirmation()
    {
        $this->showEditPasswordConfirmation = !$this->showEditPasswordConfirmation;
    }

    public function toggleCreatePassword()
    {
        $this->showCreatePassword = !$this->showCreatePassword;
    }

    public function toggleCreatePasswordConfirmation()
    {
        $this->showCreatePasswordConfirmation = !$this->showCreatePasswordConfirmation;
    }

    public function openViewQuery()
    {
        $this->isViewqueryModalOpen = true;
    }

    public function closeViewQuery()
    {
        $this->isViewqueryModalOpen = false;
    }

    public function closeInsertModal()
    {
        // Limpiar foto temporal si existe
        if ($this->newProfilePhoto) {
            $this->newProfilePhoto = null;
        }
        
        $this->isInsertModalOpen = false;
        $this->reset(['newName', 'newRfc', 'newCurp', 'newPosition', 'newSex', 'newLvl', 'newTipo', 'newStatus', 'newEmail', 'newDirection', 'newPassword', 'newPasswordConfirmation']);
    }

    public function saveNewRecord()
    {
        $this->validate([
            'newName' => 'required|string|max:255',
            'newRfc' => 'nullable|string|max:13|unique:users,rfc',
            'newCurp' => 'nullable|string|max:20|unique:users,curp',
            'newPosition' => 'nullable|string|max:35',
            'newSex' => 'nullable|in:masculino,femenino',
            'newLvl' => 'nullable|string|max:10',
            'newTipo' => 'nullable|integer',
            'newStatus' => 'nullable|boolean',
            'newEmail' => 'required|email|max:255|unique:users,email',
            'newDirection' => 'nullable|string|max:250',
            'newPassword' => 'required|string|min:8|confirmed',
            'newProfilePhoto' => 'nullable|image|max:2048', // 2MB máximo
        ]);

        $createData = [
            'name' => $this->newName,
            'rfc' => $this->newRfc,
            'curp' => $this->newCurp,
            'position' => $this->newPosition,
            'sex' => $this->newSex,
            'lvl' => $this->newLvl,
            'tipo' => $this->newTipo ?? 3,
            'status' => $this->newStatus ?? true,
            'email' => $this->newEmail,
            'direction' => $this->newDirection,
            'password' => bcrypt($this->newPassword),
        ];

        // Manejar foto de perfil
        if ($this->newProfilePhoto) {
            $photoPath = $this->newProfilePhoto->store('profile-photos', 'public');
            $createData['profile_photo_path'] = $photoPath;
        }

        User::create($createData);

        $this->closeInsertModal();
        session()->flash('message', 'Usuario creado exitosamente.');
        
        // Forzar actualización de la tabla para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    public function confirmDelete($id)
    {
        $this->deleteRecordId = $id;
        $this->recordToDelete = User::find($id);
    }

    public function deleteRecord()
    {
        if ($this->deleteRecordId) {
            $record = User::find($this->deleteRecordId);
            if ($record) {
                $record->delete();
            }
        }
        $this->deleteRecordId = null;
        $this->recordToDelete = null;
        session()->flash('message', 'Usuario eliminado correctamente.');
        
        // Forzar actualización de la tabla
        $this->dispatch('$refresh');
    }

    public function exportPDF()
    {
        $data = $this->buildFilteredQuery()->get();

        $pdf = Pdf::loadView('reports.users-report', ['users' => $data]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'lista-usuarios.pdf');
    }

    public function editRecord($id)
    {
        $this->editRecordId = $id;
        $record = User::findOrFail($id);
        
        $this->editName = $record->name;
        $this->editRfc = $record->rfc;
        $this->editCurp = $record->curp;
        $this->editPosition = $record->position;
        $this->editSex = $record->sex;
        $this->editLvl = $record->lvl;
        $this->editTipo = $record->tipo;
        $this->editStatus = $record->status;
        $this->editEmail = $record->email;
        $this->editDirection = $record->direction;
        $this->editProfilePhotoPath = $record->profile_photo_path;
    }

    public function updateRecord()
    {
        $rules = [
            'editName' => 'required|string|max:255',
            'editRfc' => 'nullable|string|max:13|unique:users,rfc,' . $this->editRecordId,
            'editCurp' => 'nullable|string|max:20|unique:users,curp,' . $this->editRecordId,
            'editPosition' => 'nullable|string|max:35',
            'editSex' => 'nullable|in:masculino,femenino',
            'editLvl' => 'nullable|string|max:10',
            'editTipo' => 'nullable|integer',
            'editStatus' => 'nullable|boolean',
            'editEmail' => 'required|email|max:255|unique:users,email,' . $this->editRecordId,
            'editDirection' => 'nullable|string|max:250',
            'editProfilePhoto' => 'nullable|image|max:2048', // 2MB máximo
        ];

        // Solo validar contraseña si se está cambiando
        if (!empty($this->editPassword)) {
            $rules['editPassword'] = 'string|min:8|confirmed';
        }

        $this->validate($rules);

        $updateData = [
            'name' => $this->editName,
            'rfc' => $this->editRfc,
            'curp' => $this->editCurp,
            'position' => $this->editPosition,
            'sex' => $this->editSex,
            'lvl' => $this->editLvl,
            'tipo' => $this->editTipo,
            'status' => $this->editStatus,
            'email' => $this->editEmail,
            'direction' => $this->editDirection,
        ];

        // Actualizar contraseña si se proporcionó
        if (!empty($this->editPassword)) {
            $updateData['password'] = bcrypt($this->editPassword);
        }

        // Manejar foto de perfil
        if ($this->editProfilePhoto) {
            // Eliminar foto anterior si existe
            $user = User::find($this->editRecordId);
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Guardar nueva foto
            $photoPath = $this->editProfilePhoto->store('profile-photos', 'public');
            $updateData['profile_photo_path'] = $photoPath;
        }

        User::find($this->editRecordId)->update($updateData);

        $this->closeEditModal();
        session()->flash('message', 'Usuario actualizado exitosamente.');
        
        // Forzar actualización de la tabla para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    public function closeEditModal()
    {
        // Limpiar foto temporal si existe
        if ($this->editProfilePhoto) {
            $this->editProfilePhoto = null;
        }
        
        $this->editRecordId = null;
        $this->reset(['editName', 'editRfc', 'editCurp', 'editPosition', 'editSex', 'editLvl', 'editTipo', 'editStatus', 'editEmail', 'editDirection', 'editPassword', 'editPasswordConfirmation', 'editProfilePhotoPath', 'showEditPassword', 'showEditPasswordConfirmation']);
    }

    public function showRecord($id)
    {
        $this->selectedRecord = User::findOrFail($id);
    }

    public function closeModal()
    {
        $this->selectedRecord = null;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'rfc' => 'nullable|string|max:13',
        'curp' => 'nullable|string|max:20',
        'position' => 'nullable|string|max:35',
        'sex' => 'nullable|in:masculino,femenino',
        'lvl' => 'nullable|string|max:10',
        'tipo' => 'nullable|integer',
        'status' => 'nullable|boolean',
        'email' => 'required|email|max:255',
        'direction' => 'nullable|string|max:250',
    ];

    public function toggleAccordion()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function save()
    {
        $this->validate();
        if ($this->editing) {
            User::find($this->editing)->update($this->getValidated());
        } else {
            User::create($this->getValidated());
        }
        $this->resetForm();
        $this->toggleAccordion();
    }

    public function edit($id)
    {
        $this->editRecordId = $id;
        $record = User::findOrFail($id);
        
        $this->editName = $record->name;
        $this->editRfc = $record->rfc;
        $this->editCurp = $record->curp;
        $this->editPosition = $record->position;
        $this->editSex = $record->sex;
        $this->editLvl = $record->lvl;
        $this->editTipo = $record->tipo;
        $this->editStatus = $record->status;
        $this->editEmail = $record->email;
        $this->editDirection = $record->direction;
        
        $this->toggleAccordion();
    }
    
    public function resetForm()
    {
        $this->reset([
            'name',
            'rfc',
            'curp',
            'position',
            'sex',
            'lvl',
            'tipo',
            'status',
            'email',
            'direction',
            'editing',
        ]);
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'filname', 'filrfc', 'filcurp', 'filposition', 'filsex', 
            'fillvl', 'filtipo', 'filstatus', 'filemail', 'fildirection'
        ]);
        $this->resetPage();
    }

    public function updatedEditProfilePhoto()
    {
        // Este método se ejecuta cuando se selecciona una nueva foto
        // Se puede usar para validaciones adicionales si es necesario
        if ($this->editProfilePhoto) {
            // Forzar actualización de la vista para mostrar la vista previa
            $this->dispatch('$refresh');
        }
    }

    public function updatedNewProfilePhoto()
    {
        // Este método se ejecuta cuando se selecciona una nueva foto en inserción
        // Se puede usar para validaciones adicionales si es necesario
        if ($this->newProfilePhoto) {
            // Forzar actualización de la vista para mostrar la vista previa
            $this->dispatch('$refresh');
        }
    }

    public function generateAvatar($name, $size = 40)
    {
        return \App\Helpers\AvatarHelper::generate($name, $size);
    }

    public function refreshTable()
    {
        // Este método se puede llamar para refrescar la tabla manualmente
        $this->dispatch('$refresh');
    }

    public function getValidated()
    {
        return $this->validate();
    }

    public function getUniquePositions()
    {
        return User::whereNotNull('position')
                  ->where('position', '!=', '')
                  ->distinct()
                  ->pluck('position')
                  ->sort()
                  ->values();
    }

    public function getUniqueLevels()
    {
        return User::whereNotNull('lvl')
                  ->where('lvl', '!=', '')
                  ->distinct()
                  ->pluck('lvl')
                  ->sort()
                  ->values();
    }

    public function getUniqueDirections()
    {
        return User::whereNotNull('direction')
                  ->where('direction', '!=', '')
                  ->distinct()
                  ->pluck('direction')
                  ->sort()
                  ->values();
    }

    public function render()
    {
        $query = $this->buildFilteredQuery();
        $this->queryStringPreview = $query->toSql();

        return view('livewire.usuarios.index', [
            'users' => $query->paginate($this->perPage),
            'uniquePositions' => $this->getUniquePositions(),
            'uniqueLevels' => $this->getUniqueLevels(),
            'uniqueDirections' => $this->getUniqueDirections(),
        ]);
    }
}
