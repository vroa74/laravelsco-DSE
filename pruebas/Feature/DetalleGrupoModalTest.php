<?php

namespace Pruebas\Feature;

use App\Livewire\UserGroups\Index;
use App\Models\User;
use App\Models\UserGroup;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DetalleGrupoModalTest extends TestCase
{
    use RefreshDatabase;

    public function test_detalle_encapsula_titulo_datos_y_ambos_cierres_en_un_panel(): void
    {
        $this->app->useStoragePath(base_path('pruebas/.cache/grupo-detalle/storage'));
        $actor = User::factory()->create(['tipo' => 0, 'status' => true, 'name' => 'Responsable sintético']);
        $this->actingAs($actor);
        $grupo = UserGroup::create([
            'name' => 'Grupo de revisión sintética',
            'description' => str_repeat('Descripción sintética del grupo, sin datos personales. ', 25),
            'created_by' => $actor->id,
            'active' => true,
        ]);
        $componente = Livewire::test(Index::class)->call('showGroup', $grupo);
        $dom = new DOMDocument;
        @$dom->loadHTML('<?xml encoding="UTF-8">'.$componente->html());
        $xpath = new DOMXPath($dom);
        $panel = $xpath->query('//*[@data-group-detail-panel]')->item(0);
        $this->assertNotNull($panel);
        $this->assertSame(1, $xpath->query('./header', $panel)->length);
        $this->assertSame(1, $xpath->query('./dl', $panel)->length);
        $this->assertSame(1, $xpath->query('./footer', $panel)->length);
        $this->assertSame(1, $xpath->query('.//*[@id="group-detail-title"]', $panel)->length);
        $this->assertSame(1, $xpath->query('.//*[@aria-label="Cerrar detalle del grupo"]', $panel)->length);
        $this->assertSame(1, $xpath->query('.//*[@aria-label="Cerrar"]', $panel)->length);
        $this->assertSame(1, $xpath->query('//*[@aria-label="Cerrar"]')->length);

        $destino = base_path('pruebas/prototipos/grupo-detalle');
        @mkdir($destino.'/assets', 0755, true);
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $css = file_get_contents(public_path('build/'.$manifest['resources/css/app.css']['file']));
        file_put_contents($destino.'/assets/app.css', str_replace('/build/assets/', '', $css));
        foreach (glob(public_path('build/assets/*.woff*')) as $fuente) {
            copy($fuente, $destino.'/assets/'.basename($fuente));
        }
        copy(base_path('vendor/livewire/livewire/dist/livewire.js'), $destino.'/assets/livewire.js');
        copy(public_path('media/img/campechecon.png'), $destino.'/assets/escudo.png');
        $cuerpo = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
        $cuerpo = preg_replace('~^<body>|</body>$~', '', $cuerpo);
        // Sin transporte Livewire: mantiene el DOM real, adaptando solo el cierre
        // a estado local para inspección de tamaño/teclado sin servidor ni red.
        $cuerpo = preg_replace('~\s(?:wire:id|wire:snapshot|wire:effects)="[^"]*"~', '', $cuerpo);
        $cuerpo = str_replace('x-data x-trap.inert.noscroll="true"', 'x-data="{show: true}" x-show="show" x-trap.inert.noscroll="show"', $cuerpo);
        $cuerpo = str_replace('$wire.closeModal()', 'show = false', $cuerpo);
        foreach (['dark' => 'dark', 'light' => ''] as $tema => $clase) {
            file_put_contents($destino.'/'.$tema.'.html', '<!doctype html><html lang="es" class="'.$clase.'"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/app.css"><link rel="stylesheet" href="../estandar/assets/icons.css"><script defer src="assets/livewire.js"></script><title>Detalle sintético de grupo</title></head><body class="sco-ui"><div class="bg-institucional" aria-hidden="true"><div class="bg-institucional__gradient-base"></div><img class="bg-institucional__shield" src="assets/escudo.png" alt=""></div>'.$cuerpo.'</body></html>');
        }
        $componente->call('closeModal')->assertSet('showModal', false)->assertSet('selectedGroup', null);
    }
}
