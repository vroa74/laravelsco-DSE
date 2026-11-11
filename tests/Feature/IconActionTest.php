<?php

use App\Models\User;
use Illuminate\Support\Facades\Blade;

it('renderiza un botón de acción solo con icono y etiqueta accesible', function () {
    $html = Blade::render('<x-icon-action icon="fa-solid fa-trash" label="Eliminar grupo" variant="danger" />');

    expect($html)
        ->toContain('aria-label="Eliminar grupo"')
        ->toContain('title="Eliminar grupo"')
        ->toContain('fa-solid fa-trash')
        ->toContain('from-orange-400')
        ->not->toContain('<a ');
});

it('renderiza un enlace cuando recibe href', function () {
    $html = Blade::render('<x-icon-action icon="fa-regular fa-eye" label="Ver detalles" variant="info" href="/rg/1" />');

    expect($html)
        ->toContain('<a href="/rg/1"')
        ->toContain('aria-label="Ver detalles"')
        ->toContain('from-sky-400');
});

it('renderiza el botón de mostrar u ocultar contraseña', function () {
    $html = Blade::render('<div x-data="{ show: false }"><x-password-toggle-button /></div>');

    expect($html)
        ->toContain('x-on:click="show = !show"')
        ->toContain('aria-label="Mostrar u ocultar contraseña"');
});

it('usa el escudo del estado de Campeche como fondo de la sección auth', function () {
    $response = $this->get(route('login'));

    $response->assertOk()->assertSee('media/img/ple_legis_65.png', false);
});

it('renderiza las vistas principales del sistema sin errores', function (string $routeName) {
    $this->actingAs(User::factory()->create());

    $this->get(route($routeName))->assertOk();
})->with([
    'reportgral',
    'rg.create',
    'user-groups.index',
    'user-groups.create',
    'agen.index',
    'catalogos',
    'usuarios',
    'dashboard',
]);

it('muestra las acciones de las barras como botones de icono', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('reportgral'))
        ->assertOk()
        ->assertSee('aria-label="Agregar registro"', false)
        ->assertSee('aria-label="Exportar a PDF"', false)
        ->assertSee('aria-label="Aplicar filtros"', false);

    $this->get(route('user-groups.index'))
        ->assertOk()
        ->assertSee('aria-label="Crear grupo"', false);
});
