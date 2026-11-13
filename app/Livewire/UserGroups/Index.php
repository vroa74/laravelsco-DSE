<?php

namespace App\Livewire\UserGroups;

use App\Models\User;
use App\Models\UserGroup;
use App\Traits\AuthorizesAdministration;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesAdministration;
    use WithPagination;

    public $search = '';

    public $searchAvailableUsers = '';

    public $showModal = false;

    public $selectedGroup = null;

    public $showMembersModal = false;

    public $showAddMemberModal = false;

    public $selectedUser = null;

    public $availableUsers = [];

    public $filteredAvailableUsers = [];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->loadAvailableUsers();
    }

    public function render()
    {
        $query = UserGroup::with(['creator', 'members']);

        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%');
        }

        $groups = $query->orderBy('name')
            ->paginate(10);

        return view('livewire.user-groups.index', [
            'groups' => $groups,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function showGroup(UserGroup $group)
    {
        $this->selectedGroup = $group->load(['creator', 'members']);
        $this->showModal = true;
    }

    public function showMembers(UserGroup $group)
    {
        $this->selectedGroup = $group->load(['members']);
        $this->showMembersModal = true;
    }

    public function showAddMember(UserGroup $group)
    {
        $this->selectedGroup = $group;
        $this->loadAvailableUsers();
        $this->showAddMemberModal = true;
    }

    public function addMember(User $user)
    {
        if ($user->groups()->count() > 0) {
            $this->dispatch('error', 'El usuario ya pertenece a un grupo.');

            return;
        }

        $this->selectedGroup->addMember($user, auth()->user());
        $this->loadAvailableUsers();
        $this->dispatch('success', 'Usuario agregado al grupo exitosamente.');

        // Recargar el grupo seleccionado
        $this->selectedGroup->load(['members']);
    }

    public function removeMember(User $user)
    {
        $this->selectedGroup->removeMember($user);
        $this->loadAvailableUsers();
        $this->dispatch('success', 'Usuario removido del grupo exitosamente.');

        // Recargar el grupo seleccionado
        $this->selectedGroup->load(['members']);
    }

    public function deleteGroup(UserGroup $group)
    {
        // Verificar si tiene miembros
        if ($group->members()->count() > 0) {
            $this->dispatch('error', 'No se puede eliminar un grupo que tiene miembros.');

            return;
        }

        // Verificar si tiene reportes turnados
        if ($group->cos()->count() > 0) {
            $this->dispatch('error', 'No se puede eliminar un grupo que tiene reportes turnados.');

            return;
        }

        $group->delete();
        $this->dispatch('success', 'Grupo eliminado exitosamente.');
    }

    public function toggleActive(UserGroup $group)
    {
        $group->update(['active' => ! $group->active]);
        $this->dispatch('success', 'Estado del grupo actualizado.');
    }

    private function loadAvailableUsers()
    {
        $this->availableUsers = User::whereDoesntHave('groups')
            ->where('id', '!=', auth()->id())
            ->select('id', 'name', 'email', 'position')
            ->get();
        $this->filterAvailableUsers();
    }

    private function filterAvailableUsers()
    {
        if (empty($this->searchAvailableUsers)) {
            $this->filteredAvailableUsers = $this->availableUsers;
        } else {
            $searchTerm = strtolower($this->searchAvailableUsers);
            $this->filteredAvailableUsers = $this->availableUsers->filter(function ($user) use ($searchTerm) {
                return str_contains(strtolower($user->name), $searchTerm) ||
                       str_contains(strtolower($user->email), $searchTerm);
            });
        }
    }

    public function updatedSearchAvailableUsers()
    {
        $this->filterAvailableUsers();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showMembersModal = false;
        $this->showAddMemberModal = false;
        $this->selectedGroup = null;
        $this->selectedUser = null;
        $this->searchAvailableUsers = '';
    }
}
