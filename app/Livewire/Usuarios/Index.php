<?php

namespace App\Livewire\Usuarios;

use App\Helpers\AvatarHelper;
use App\Models\User;
use App\Traits\AuthorizesAdministration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesAdministration;
    use WithFileUploads, WithPagination;

    public $perPage = 10;

    public $queryStringPreview = '';

    // Variables para los filtros
    public $filname = '';

    public $filrfc = '';

    public $filcurp = '';

    public $filposition = '';

    public $filsex = '';

    public $fillvl = '';

    public $filtipo = '';

    public $filstatus = '';

    public $filemail = '';

    public $fildirection = '';

    public $selectedRecord;

    public $editRecordId;

    public $editName;

    public $editRfc;

    public $editCurp;

    public $editPosition;

    public $editSex;

    public $editLvl;

    public $editTipo;

    public $editStatus;

    public $editEmail;

    public $editDirection;

    public $editPassword;

    public $editPasswordConfirmation;

    public $editProfilePhoto;

    public $editProfilePhotoPath;

    public $editProfilePhotoUrl;

    // Variables para el modal de creación (duplicado del modal de edición)
    public $createModalOpen = false;

    public $createName;

    public $createRfc;

    public $createCurp;

    public $createPosition;

    public $createSex;

    public $createLvl;

    public $createTipo;

    public $createStatus;

    public $createEmail;

    public $createDirection;

    public $createPassword;

    public $createPasswordConfirmation;

    public $createProfilePhoto;

    // Variables para mostrar/ocultar contraseñas
    public $showEditPassword = false;

    public $showEditPasswordConfirmation = false;

    public $showCreatePassword = false;

    public $showCreatePasswordConfirmation = false;

    protected $paginationTheme = 'tailwind';

    // Variables adicionales del componente original
    public $deleteRecordId = null;

    public $editing = null;

    public $name;

    public $rfc;

    public $curp;

    public $position;

    public $sex;

    public $lvl;

    public $tipo;

    public $status;

    public $email;

    public $direction;

    // Variables para el acordeón y modales
    public $isOpen = true;

    public $isInsertModalOpen = false;

    public $isViewqueryModalOpen = false;

    public $recordToDelete;

    public $newName;

    public $newRfc;

    public $newCurp;

    public $newPosition;

    public $newSex;

    public $newLvl;

    public $newTipo;

    public $newStatus;

    public $newEmail;

    public $newDirection;

    public $newPassword;

    public $newPasswordConfirmation;

    public $newProfilePhoto;

    public function buildFilteredQuery()
    {
        $query = User::query();

        if (! empty($this->filname)) {
            $query->where('name', 'like', '%'.$this->filname.'%');
        }
        if (! empty($this->filrfc)) {
            $query->where('rfc', 'like', '%'.$this->filrfc.'%');
        }
        if (! empty($this->filcurp)) {
            $query->where('curp', 'like', '%'.$this->filcurp.'%');
        }
        if (! empty($this->filposition)) {
            $query->where('position', $this->filposition);
        }
        if (! empty($this->filsex)) {
            $query->where('sex', $this->filsex);
        }
        if (! empty($this->fillvl)) {
            $query->where('lvl', $this->fillvl);
        }
        if (! empty($this->filtipo)) {
            $query->where('tipo', $this->filtipo);
        }
        if ($this->filstatus !== null && $this->filstatus !== '') {
            $query->where('status', $this->filstatus);
        }
        if (! empty($this->filemail)) {
            $query->where('email', 'like', '%'.$this->filemail.'%');
        }
        if (! empty($this->fildirection)) {
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
            'createPassword', 'createPasswordConfirmation', 'showCreatePassword', 'showCreatePasswordConfirmation',
        ]);
    }

    public function saveCreateRecord()
    {
        Gate::authorize('assignType', [User::class, $this->createTipo ?? 3]);
        $this->validate([
            'createName' => 'required|string|max:255',
            'createRfc' => 'nullable|string|max:13|unique:users,rfc',
            'createCurp' => 'nullable|string|max:20|unique:users,curp',
            'createPosition' => 'nullable|string|max:35',
            'createSex' => 'nullable|in:masculino,femenino',
            'createLvl' => 'nullable|string|max:10',
            'createTipo' => 'nullable|integer|in:0,1,2,3',
            'createStatus' => 'nullable|boolean',
            'createEmail' => 'required|email|max:255|unique:users,email',
            'createDirection' => 'nullable|string|max:250',
            'createPassword' => 'required|string|min:8',
            'createProfilePhoto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp|max:2048', // 2 MB; solo formatos web servibles
        ]);

        // Validar que las contraseñas coincidan manualmente
        if ($this->createPassword !== $this->createPasswordConfirmation) {
            $this->addError('createPasswordConfirmation', 'La confirmación de contraseña no coincide.');

            return;
        }

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
        if (! $this->crearUsuarioConFoto($createData, $this->createProfilePhoto, 'createProfilePhoto')) {
            return;
        }

        $this->closeCreateModal();
        session()->flash('message', 'Usuario creado exitosamente.');

        // Forzar actualización de la tabla para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    /**
     * Crea el usuario y, si hay foto, la guarda primero. Si algo falla no se
     * crea el registro y se borra el archivo recién escrito.
     */
    private function crearUsuarioConFoto(array $datos, ?UploadedFile $foto, string $campoError): bool
    {
        $photoPath = null;

        try {
            if ($foto) {
                // El disco public no lanza errores y Livewire devuelve la ruta
                // aunque el put() haya fallado: comprobar que el archivo existe.
                $photoPath = $foto->store('profile-photos', 'public');

                if (! is_string($photoPath) || User::rutaFotoValida($photoPath) === null || ! Storage::disk('public')->exists($photoPath)) {
                    $this->addError($campoError, 'No se pudo guardar la fotografía; no se creó el registro.');

                    return false;
                }

                $datos['profile_photo_path'] = $photoPath;
            }

            $creado = User::create($datos);

            // Un evento creating cancelado devuelve false sin escribir el registro.
            if (! $creado->exists) {
                throw new \RuntimeException('El registro no se creó.');
            }
        } catch (\Throwable $e) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            $this->addError($campoError, 'No se pudo guardar el usuario ni su fotografía; no se creó el registro.');

            return false;
        }

        return true;
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
        $this->showEditPassword = ! $this->showEditPassword;
    }

    public function toggleEditPasswordConfirmation()
    {
        $this->showEditPasswordConfirmation = ! $this->showEditPasswordConfirmation;
    }

    public function toggleCreatePassword()
    {
        $this->showCreatePassword = ! $this->showCreatePassword;
    }

    public function toggleCreatePasswordConfirmation()
    {
        $this->showCreatePasswordConfirmation = ! $this->showCreatePasswordConfirmation;
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
        Gate::authorize('assignType', [User::class, $this->newTipo ?? 3]);
        $this->validate([
            'newName' => 'required|string|max:255',
            'newRfc' => 'nullable|string|max:13|unique:users,rfc',
            'newCurp' => 'nullable|string|max:20|unique:users,curp',
            'newPosition' => 'nullable|string|max:35',
            'newSex' => 'nullable|in:masculino,femenino',
            'newLvl' => 'nullable|string|max:10',
            'newTipo' => 'nullable|integer|in:0,1,2,3',
            'newStatus' => 'nullable|boolean',
            'newEmail' => 'required|email|max:255|unique:users,email',
            'newDirection' => 'nullable|string|max:250',
            'newPassword' => 'required|string|min:8',
            'newProfilePhoto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp|max:2048', // 2 MB; solo formatos web servibles
        ]);

        // Validar que las contraseñas coincidan manualmente
        if ($this->newPassword !== $this->newPasswordConfirmation) {
            $this->addError('newPasswordConfirmation', 'La confirmación de contraseña no coincide.');

            return;
        }

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
        if (! $this->crearUsuarioConFoto($createData, $this->newProfilePhoto, 'newProfilePhoto')) {
            return;
        }

        $this->closeInsertModal();
        session()->flash('message', 'Usuario creado exitosamente.');

        // Forzar actualización de la tabla para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    public function confirmDelete($id)
    {
        $this->deleteRecordId = $id;
        $this->recordToDelete = User::findOrFail($id);
        Gate::authorize('delete', $this->recordToDelete);
    }

    public function deleteRecord()
    {
        if ($this->deleteRecordId) {
            $record = User::findOrFail($this->deleteRecordId);
            Gate::authorize('delete', $record);
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
        Gate::authorize('update', $record);

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
        // URL real de la foto ya guardada (null si no hay archivo disponible).
        $this->editProfilePhotoUrl = $record->profile_photo_url;
    }

    public function updateRecord()
    {
        $rules = [
            'editName' => 'required|string|max:255',
            'editRfc' => 'nullable|string|max:13|unique:users,rfc,'.$this->editRecordId,
            'editCurp' => 'nullable|string|max:20|unique:users,curp,'.$this->editRecordId,
            'editPosition' => 'nullable|string|max:35',
            'editSex' => 'nullable|in:masculino,femenino',
            'editLvl' => 'nullable|string|max:10',
            'editTipo' => 'nullable|integer|in:0,1,2,3',
            'editStatus' => 'nullable|boolean',
            'editEmail' => 'required|email|max:255|unique:users,email,'.$this->editRecordId,
            'editDirection' => 'nullable|string|max:250',
            'editProfilePhoto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp|max:2048', // 2 MB; solo formatos web servibles
        ];

        // Solo validar contraseña si se está cambiando
        if (! empty($this->editPassword)) {
            $rules['editPassword'] = 'string|min:8';
            // Validar que las contraseñas coincidan manualmente
            if ($this->editPassword !== $this->editPasswordConfirmation) {
                $this->addError('editPasswordConfirmation', 'La confirmación de edit password no coincide.');

                return;
            }
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
        if (! empty($this->editPassword)) {
            $updateData['password'] = bcrypt($this->editPassword);
        }

        $user = User::findOrFail($this->editRecordId);
        Gate::authorize('update', $user);
        Gate::authorize('assignType', [User::class, $this->editTipo ?? 3]);

        // La foto anterior se conserva hasta que la nueva esté guardada y el
        // registro actualizado; así una escritura fallida no pierde la foto.
        $photoAnterior = $user->profile_photo_path;
        $photoNueva = null;

        if ($this->editProfilePhoto) {
            try {
                // El disco public no lanza errores: store() puede devolver false.
                $photoNueva = $this->editProfilePhoto->store('profile-photos', 'public');
            } catch (\Throwable $e) {
                $this->addError('editProfilePhoto', 'No se pudo guardar la fotografía; se conserva la anterior.');

                return;
            }

            if (! is_string($photoNueva) || User::rutaFotoValida($photoNueva) === null || ! Storage::disk('public')->exists($photoNueva)) {
                $this->addError('editProfilePhoto', 'No se pudo guardar la fotografía; se conserva la anterior.');

                return;
            }

            $updateData['profile_photo_path'] = $photoNueva;
        }

        try {
            $guardado = $user->update($updateData);
        } catch (\Throwable $e) {
            $guardado = false;
        }

        // update() devuelve false si un evento cancela el guardado o si la
        // escritura falla: en ambos casos la foto anterior sigue siendo válida.
        if (! $guardado) {
            if (is_string($photoNueva) && $photoNueva !== '') {
                Storage::disk('public')->delete($photoNueva);
            }

            $this->addError('editProfilePhoto', 'No se pudo actualizar el usuario; se conserva la fotografía anterior.');

            return;
        }

        // La foto sustituida se borra solo después de guardar con éxito.
        if (is_string($photoNueva) && $photoNueva !== '' && $photoAnterior && $photoAnterior !== $photoNueva) {
            // No borrar una ruta histórica ajena al directorio de fotos.
            if (User::rutaFotoValida($photoAnterior) !== null) {
                Storage::disk('public')->delete($photoAnterior);
            }
        }

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
        $this->reset(['editName', 'editRfc', 'editCurp', 'editPosition', 'editSex', 'editLvl', 'editTipo', 'editStatus', 'editEmail', 'editDirection', 'editPassword', 'editPasswordConfirmation', 'editProfilePhotoPath', 'editProfilePhotoUrl', 'showEditPassword', 'showEditPasswordConfirmation']);
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
        'tipo' => 'nullable|integer|in:0,1,2,3',
        'status' => 'nullable|boolean',
        'email' => 'required|email|max:255',
        'direction' => 'nullable|string|max:250',
    ];

    public function toggleAccordion()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function save()
    {
        $this->validate();
        if ($this->editing) {
            Gate::authorize('update', User::findOrFail($this->editing));
            Gate::authorize('assignType', [User::class, $this->tipo ?? 3]);
            User::findOrFail($this->editing)->update($this->getValidated());
        } else {
            Gate::authorize('assignType', [User::class, $this->tipo ?? 3]);
            User::create($this->getValidated());
        }
        $this->resetForm();
        $this->toggleAccordion();
    }

    public function edit($id)
    {
        $this->editRecordId = $id;
        $record = User::findOrFail($id);
        Gate::authorize('update', $record);

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
        $this->editProfilePhotoUrl = $record->profile_photo_url;

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
            'fillvl', 'filtipo', 'filstatus', 'filemail', 'fildirection',
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
        return AvatarHelper::generate($name, $size);
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
