<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('administrar-sistema', fn (User $user) => $user->administraSistema());
        Livewire::addPersistentMiddleware([CheckUserType::class]);
        // Bloquea migrate:fresh/refresh/reset, db:wipe, etc. fuera de las pruebas (que usan SQLite en memoria).
        DB::prohibitDestructiveCommands(! $this->app->runningUnitTests());
    }
}
