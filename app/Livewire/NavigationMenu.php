<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\AvatarHelper;

class NavigationMenu extends Component
{
    public function generateAvatar($name, $size = 32)
    {
        return AvatarHelper::generate($name, $size);
    }

    public function render()
    {
        return view('livewire.navigation-menu');
    }
} 