<?php

namespace App\Livewire\Catalogo;

use App\Traits\AuthorizesAdministration;
use Livewire\Component;

class Nc extends Component
{
    use AuthorizesAdministration;

    public function render()
    {
        return view('livewire.catalogo.nc');
    }
}
