<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

require dirname(__DIR__, 2).'/vendor/autoload.php';

// Exportación de componentes reales con contenido sintético, sin servidor Laravel.
final class ExportadorVisual extends TestCase {}

$runner = (new ReflectionClass(ExportadorVisual::class))->newInstanceWithoutConstructor();
$app = $runner->createApplication(); // Conserva guardia anterior y posterior de Tests\TestCase.

if ($app['config']->get('database.default') !== 'sqlite'
    || $app['config']->get('database.connections.sqlite.database') !== ':memory:') {
    throw new RuntimeException('Exportación rechazada: entorno no aislado.');
}

$root = dirname(__DIR__, 2);
$destination = $root.'/pruebas/prototipos/estandar';
if (! is_dir($destination)) {
    mkdir($destination, 0755, true);
}

$sample = <<<'BLADE'
<div class="bg-institucional" aria-hidden="true">
  <div class="bg-institucional__gradient-base"></div>
  <img src="assets/escudo.png" alt="" class="bg-institucional__shield">
  <div class="bg-institucional__gradient-overlay"></div>
</div>
<main class="relative z-10 p-4 max-w-7xl mx-auto">
  <h1 class="text-xl text-primary mb-4">Componentes con datos sintéticos</h1>
  <section class="panel-base p-6 mb-4" data-evidence="panel">
    <h2 class="text-lg text-primary mb-4">Captura de correspondencia</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div><x-label for="nombre" value="Remitente" /><x-input id="nombre" value="Persona de ejemplo" /></div>
      <div><x-label for="direccion" value="Dirección" /><x-input id="direccion" placeholder="Dirección de ejemplo" /></div>
      <div><label class="label-base" for="tipo">Tipo</label><select class="input-base" id="tipo"><option>Oficio</option><option>Solicitud</option></select></div>
      <div><x-label for="sin-permiso" value="Campo deshabilitado" /><x-input id="sin-permiso" value="Solo consulta" disabled /></div>
    </div>
    <div class="mt-4 flex flex-wrap gap-2">
      <x-button type="button">Guardar</x-button>
      <x-secondary-button type="button">Cancelar</x-secondary-button>
      @foreach (['success', 'view', 'warning', 'danger', 'report-normal', 'report-special', 'report-request', 'export-pdf', 'export-csv', 'neutral'] as $variant)
        <x-icon-action :variant="$variant" icon="fa-solid fa-circle" :label="$variant" />
      @endforeach
    </div>
    <div class="mt-4"><x-label for="fecha" value="Fecha" /><x-input id="fecha" type="date" value="2026-11-12" /></div>
  </section>
  <section class="panel-base p-4" data-evidence="tabla">
    <h2 class="text-lg text-primary mb-4">Consulta de ejemplo</h2>
    <table class="tabla-apilada text-primary">
      <thead><tr><th>Folio</th><th>Remitente</th><th>Estado</th><th>Acciones</th></tr></thead>
      <tbody>
        <tr><td data-label="Folio">SINT-001</td><td data-label="Remitente">Institución de ejemplo con nombre largo</td><td data-label="Estado">Publicado</td><td data-label="Acciones"><x-icon-action variant="view" icon="fa-solid fa-eye" label="Ver ejemplo" /></td></tr>
        <tr><td data-label="Folio">SINT-002</td><td data-label="Remitente">Persona de ejemplo</td><td data-label="Estado">Disponible</td><td data-label="Acciones"><x-icon-action variant="report-normal" icon="fa-solid fa-file" label="Reporte de ejemplo" /></td></tr>
      </tbody>
    </table>
  </section>
</main>
BLADE;

$body = Blade::render($sample);
foreach (['light' => '', 'dark' => 'dark'] as $theme => $class) {
    $html = '<!doctype html><html lang="es" class="'.$class.'"><head><meta charset="utf-8">'
        .'<meta name="viewport" content="width=device-width,initial-scale=1">'
        .'<title>Componentes sintéticos · '.$theme.'</title><link rel="stylesheet" href="assets/app.css"><link rel="stylesheet" href="assets/icons.css">'
        .'</head><body class="sco-ui min-h-screen">'.$body.'</body></html>';
    file_put_contents($destination.'/'.$theme.'.html', $html);
}

echo "EXPORTACION=componentes_reales_con_datos_sinteticos\nVISTAS=light.html,dark.html\n";
