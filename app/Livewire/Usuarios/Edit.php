<?php

namespace App\Livewire\Usuarios;

use App\Traits\AuthorizesAdministration;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesAdministration;

    public function render()
    {
        return view('livewire.usuarios.edit');
    }
}
