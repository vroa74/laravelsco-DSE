<?php

namespace App\Livewire\Catalogo;

use App\Traits\AuthorizesAdministration;
use Livewire\Component;

class Tc extends Component
{
    use AuthorizesAdministration;

    public function render()
    {
        return view('livewire.catalogo.tc');
    }
}
