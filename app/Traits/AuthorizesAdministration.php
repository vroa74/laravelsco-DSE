<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait AuthorizesAdministration
{
    /** Livewire ejecuta el boot del trait en montaje y en cada actualización. */
    public function bootAuthorizesAdministration(): void
    {
        Gate::authorize('administrar-sistema');
    }
}
