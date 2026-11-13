<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $actor, User $target): bool
    {
        return $actor->administraSistema() && ($target->tipoVigente() !== 0 || $actor->tipoVigente() === 0);
    }

    public function delete(User $actor, User $target): bool
    {
        return $this->update($actor, $target);
    }

    /** La administración de usuarios no concede crear un superadministrador. */
    public function assignType(User $actor, mixed $type): bool
    {
        return $actor->administraSistema() && in_array($type, [0, 1, 2, 3, '0', '1', '2', '3'], true)
            && (! in_array($type, [0, '0'], true) || $actor->tipoVigente() === 0);
    }
}
