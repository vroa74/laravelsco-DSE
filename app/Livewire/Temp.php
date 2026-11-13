<?php

namespace App\Livewire;

use App\Traits\AuthorizesAdministration;
use Livewire\Component;

class Temp extends Component
{
    use AuthorizesAdministration;

    public function render()
    {
        return view('livewire.temp');
    }
}
