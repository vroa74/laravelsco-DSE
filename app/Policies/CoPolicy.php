<?php

namespace App\Policies;

use App\Models\Co;
use App\Models\User;

class CoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->cuentaActiva() && $user->tipoVigente() !== null;
    }

    public function view(User $user, Co $co): bool
    {
        return $user->administraSistema() || ($this->viewAny($user)
            && $user->tipoVigente() === 3 && $co->tur_type === 'user'
            && $co->tur_id !== null && (string) $co->tur_id === (string) $user->getKey());
    }

    public function create(User $user): bool
    {
        return $user->administraSistema();
    }

    public function update(User $user, Co $co): bool
    {
        return $user->administraSistema();
    }

    public function delete(User $user, Co $co): bool
    {
        return $user->administraSistema();
    }
}
