<?php

use App\Models\User;

test('component inventory page lists project ui components and icons', function () {
    $response = $this->actingAs(User::factory()->create())
        ->get(route('componentes'));

    $response
        ->assertOk()
        ->assertSee('Componentes Blade propios y Jetstream')
        ->assertSee('Componentes Livewire')
        ->assertSee('Plugins e integraciones de interfaz')
        ->assertSee('fa-regular fa-eye')
        ->assertSee('components/banner.blade.php');
});
