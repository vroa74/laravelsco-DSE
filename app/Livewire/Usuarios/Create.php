<?php

namespace App\Livewire\Usuarios;

use App\Traits\AuthorizesAdministration;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesAdministration;

    public function render()
    {
        return view('livewire.usuarios.create');
    }
}
