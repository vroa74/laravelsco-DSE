<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Ccor;
use App\Models\Tcor;


class Cc extends Component
{
    public $ccc, $tcc;
    public $tccc, $tccctxt, $tcccid;

    public function mount(){
        $this->ccc = Ccor::all();
        $this->tcc = Tcor::all();
        $this->tccc = null;
        $this->tccctxt = null;
        $this->tcccid = null;

    }
    public function miFuncionPersonalizada($value)
    {
        if ($value != 0) {
            $selected = Tcor::find($value);
            if ($selected) {
                $this->tcccid = $selected->id;
                $this->tccc = $selected->ncor;
                $this->tccctxt = $selected->ccor;
            }
        } else {
            $this->tccc = null;
            $this->tcccid = null;
            $this->tccctxt = null;
        }
    }

    public function render()
    {
        return view('livewire.cc');
    }
}
