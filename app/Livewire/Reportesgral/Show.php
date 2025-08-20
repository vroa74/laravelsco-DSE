<?php

namespace App\Livewire\Reportesgral;

use Livewire\Component;
use App\Models\Co;
use App\Models\UserGroup;

class Show extends Component
{
    public $record;
    public $recordId;
    public $userGroups;

    public function mount($id)
    {
        $this->recordId = $id;
        $this->record = Co::findOrFail($id);
        $this->userGroups = UserGroup::active()->get();
    }

    public function render()
    {
        return view('livewire.reportesgral.show', [
            'record' => $this->record,
            'userGroups' => $this->userGroups
        ]);
    }
}
