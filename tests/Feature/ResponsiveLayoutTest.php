<?php

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Regla de diseño del sitio: sólo se permite desplazamiento vertical.
 * Las tablas anchas se apilan como tarjetas en pantallas pequeñas.
 */

/**
 * @return array<string, string>
 */
function vistasDelSitio(): array
{
    $vistas = [];

    foreach (File::allFiles(resource_path('views')) as $archivo) {
        if ($archivo->getExtension() !== 'blade.php') {
            continue;
        }

        $vistas[$archivo->getRelativePathname()] = File::get($archivo->getPathname());
    }

    return $vistas;
}

it('bloquea el desplazamiento horizontal en el documento base', function () {
    $css = File::get(resource_path('css/app.css'));

    expect($css)
        ->toContain('overflow-x: clip')
        ->toContain('.tabla-apilada')
        ->toContain('content: attr(data-label)');
});

it('no usa contenedores con desplazamiento lateral en las vistas', function () {
    $infractoras = [];

    foreach (vistasDelSitio() as $ruta => $contenido) {
        $tieneScrollHorizontal = Str::contains($contenido, ['overflow-x-auto', 'overflow-x-scroll']);
        $tieneAnchoMinimoFijo = preg_match('/min-w-\[\d+px\]/', $contenido) === 1;

        if ($tieneScrollHorizontal || $tieneAnchoMinimoFijo) {
            $infractoras[] = $ruta;
        }
    }

    expect($infractoras)->toBe([]);
});

it('convierte las tablas de datos en tablas apiladas con etiquetas', function (string $vista) {
    $contenido = File::get(resource_path('views/'.$vista));

    expect($contenido)
        ->toContain('tabla-apilada')
        ->toContain('data-label=');
})->with([
    'livewire/reportesgral/index.blade.php',
    'livewire/rg/index.blade.php',
    'livewire/usuarios/index.blade.php',
    'livewire/people.blade.php',
    'livewire/user-groups/index.blade.php',
]);

it('renderiza el listado de correspondencia como tabla apilada', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('reportgral'))
        ->assertOk()
        ->assertSee('tabla-apilada', false);

    $this->get(route('usuarios'))
        ->assertOk()
        ->assertSee('tabla-apilada', false);
});

it('exporta las tablas apiladas en el CSS compilado', function () {
    $hojas = collect(File::glob(public_path('build/assets/*.css')));

    if ($hojas->isEmpty()) {
        $this->markTestSkipped('No hay compilación de Vite disponible.');
    }

    $css = $hojas->map(fn (string $hoja) => File::get($hoja))->implode("\n");

    expect($css)->toContain('.tabla-apilada');
});
