<?php

namespace Pruebas\Feature;

use DOMDocument;
use Livewire\Component;
use Livewire\Livewire;
use Tests\TestCase;

class EstilosOutlineModalTest extends TestCase
{
    public function test_exporta_componentes_reales_con_dialogo_etiquetado(): void
    {
        $this->app->useStoragePath(base_path('pruebas/.cache/estilos/storage'));
        $html = Livewire::test(MuestraModalOutline::class)->html();
        $this->assertStringContainsString('aria-labelledby="modal-muestra-title"', $html);
        $this->assertStringContainsString('id="modal-muestra-title"', $html);
        $this->assertStringContainsString('aria-label="Cerrar diálogo"', $html);
        $this->assertStringContainsString('x-trap.inert.noscroll="show"', $html);

        $directorio = base_path('pruebas/prototipos/ajustes-modal');
        @mkdir($directorio.'/assets', 0755, true);
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $css = file_get_contents(public_path('build/'.$manifest['resources/css/app.css']['file']));
        $css = str_replace(['/media/img/campechecon.png', '/build/assets/'], ['escudo.png', ''], $css);
        file_put_contents($directorio.'/assets/app.css', $css);
        copy(public_path('media/img/campechecon.png'), $directorio.'/assets/escudo.png');
        copy(base_path('vendor/livewire/livewire/dist/livewire.js'), $directorio.'/assets/livewire.js');
        foreach (glob(public_path('build/assets/*.woff*')) as $fuente) {
            copy($fuente, $directorio.'/assets/'.basename($fuente));
        }

        // Adaptador local: conserva el DOM Blade y las directivas Alpine reales;
        // elimina únicamente transporte Livewire para probar sin servidor ni red.
        $dom = new DOMDocument;
        @$dom->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        foreach ($dom->getElementsByTagName('*') as $elemento) {
            $eliminar = [];
            foreach ($elemento->attributes as $atributo) {
                if (str_starts_with($atributo->name, 'wire:')) {
                    $eliminar[] = $atributo->name;
                }
            }
            foreach ($eliminar as $nombre) {
                $elemento->removeAttribute($nombre);
            }
            if (str_contains($elemento->getAttribute('x-data'), 'entangle')) {
                $elemento->setAttribute('x-data', '{ show: false }');
                $elemento->setAttribute('x-on:abrir-muestra.window', 'show = true');
            }
        }
        $cuerpo = $dom->saveHTML();
        foreach (['light' => '', 'dark' => 'dark'] as $tema => $clase) {
            file_put_contents($directorio.'/'.$tema.'.html', '<!doctype html><html lang="es" class="'.$clase.'"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/app.css"><script defer src="assets/livewire.js"></script><title>Revisión sintética del modal</title></head><body class="sco-ui">'.$cuerpo.'</body></html>');
        }
        $this->assertFileExists($directorio.'/light.html');
        $this->assertFileExists($directorio.'/dark.html');
    }
}

class MuestraModalOutline extends Component
{
    public bool $visible = false;

    public function render(): string
    {
        return <<<'BLADE'
        <div>
          <div class="bg-institucional" aria-hidden="true"><div class="bg-institucional__gradient-base"></div><img src="assets/escudo.png" class="bg-institucional__shield" alt=""><div class="bg-institucional__gradient-overlay"></div></div>
          <main class="relative p-4 max-w-4xl mx-auto">
            <h1 class="text-xl text-primary mb-4">Acciones y diálogos — datos sintéticos</h1>
            <section class="panel-base p-4">
              <div class="flex flex-wrap gap-3" id="acciones-muestra">
                @foreach (['success'=>'Agregar', 'warning'=>'Editar', 'view'=>'Ver', 'danger'=>'Eliminar', 'report-normal'=>'Normal', 'report-special'=>'Especial', 'report-request'=>'Solicitud', 'export-pdf'=>'PDF', 'export-csv'=>'CSV', 'neutral'=>'Volver'] as $variante=>$texto)
                  <x-button type="button" :variant="$variante" data-variante="{{ $variante }}">{{ $texto }}</x-button>
                @endforeach
              </div>
              <button type="button" id="abrir-muestra" class="btn-base btn-info mt-4" x-data x-on:click="$dispatch('abrir-muestra')">Abrir diálogo de prueba</button>
            </section>
          </main>
          <x-dialog-modal id="modal-muestra" wire:model="visible">
            <x-slot name="title">Selección de persona</x-slot>
            <x-slot name="content">
              <p class="identity-name">Persona de ejemplo</p>
              <p class="identity-role">Cargo de ejemplo</p>
              <p class="identity-direction">Dirección de ejemplo</p>
              <p class="identity-email">persona@example.invalid</p>
              <label class="label-base mt-4" for="busqueda-muestra">Buscar</label>
              <input id="busqueda-muestra" class="input-base w-full" placeholder="Nombre o correo" value="Texto sintético">
              <label class="label-base mt-4" for="tipo-muestra">Tipo</label>
              <select id="tipo-muestra" class="input-base w-full"><option>Persona</option><option>Institución</option></select>
              <label class="label-base mt-4" for="fecha-muestra">Fecha</label>
              <input id="fecha-muestra" class="input-base w-full" type="date" value="2026-11-13">
            </x-slot>
            <x-slot name="footer"><x-secondary-button x-on:click="$dispatch('close')">Cancelar</x-secondary-button><x-button type="button">Seleccionar</x-button></x-slot>
          </x-dialog-modal>
        </div>
        BLADE;
    }
}
