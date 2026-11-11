<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        // Bloquea migrate:fresh/refresh/reset, db:wipe, etc. fuera de las pruebas (que usan SQLite en memoria).
        DB::prohibitDestructiveCommands(! $this->app->runningUnitTests());
    }
}
