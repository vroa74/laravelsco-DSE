<?php

declare(strict_types=1);

use App\Livewire\People;
use App\Models\Age;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

require dirname(__DIR__, 2).'/vendor/autoload.php';

final class ExportadorPaginasVisualesTest extends TestCase
{
    use RefreshDatabase;

    public function test_exporta_paginas_con_datos_sinteticos(): void
    {
        if (DB::connection()->getDriverName() !== 'sqlite'
            || DB::connection()->getDatabaseName() !== ':memory:') {
            throw new RuntimeException('Exportación rechazada: base no aislada.');
        }

        $user = User::factory()->create([
            'name' => 'Cuenta sintética de revisión',
            'tipo' => 2,
            'status' => true,
            'email' => 'revision@example.invalid',
            'position' => 'Cargo sintético',
            'direction' => 'Dirección de prueba con descripción extensa',
            'profile_photo_path' => null,
        ]);
        $this->actingAs($user);
        DB::table('ages')->insert([
            'nombre' => 'Persona sintética', 'apaterno' => 'Ejemplo',
            'cargo' => 'Cargo de prueba', 'deporg' => 'Institución de prueba',
            'dir' => 'Dirección sintética larga para comprobar ajuste de texto',
        ]);
        DB::table('cos')->insert([
            'nofi' => 'SINT-001', 'ncor' => 'Ordinaria', 'tcor' => 'Correspondencia normal',
            'fcap' => '2026-11-12', 'frec' => '2026-11-12', 'fofi' => '2026-11-11',
            'rem_nombre' => 'Institución sintética', 'tur_nom' => 'Destinatario de prueba',
            'des' => 'Descripción sintética larga para revisar la tabla adaptable.',
            'seguimiento' => 'Seguimiento de ejemplo',
        ]);
        DB::table('user_groups')->insert([
            'name' => 'Grupo sintético', 'description' => 'Descripción de prueba',
            'created_by' => $user->id, 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('legislaturas')->insert(['legislatura' => 'SINT', 'actual' => true]);
        DB::table('ncors')->insert(['ncor' => 'Ordinaria']);
        DB::table('tcors')->insert(['tcor' => 'Correspondencia normal']);
        DB::table('ccors')->insert(['tcor' => '1', 'ccor' => 'Clasificación sintética']);

        $destination = dirname(__DIR__).'/prototipos/estandar';
        foreach (['dashboard', 'catalogos', 'componentes', 'usuario.index', 'agen.index', 'user-groups.index', 'reportgral', 'rg.create'] as $route) {
            $response = $this->get(route($route))->assertOk();
            $html = $response->getContent();
            // Evidencia estática: no JS, peticiones externas, sesión ni datos reales.
            $html = preg_replace('~<script\b[^>]*>.*?</script>~si', '', $html);
            $html = preg_replace('~<link\b[^>]*>~si', '', $html);
            $html = preg_replace('~<meta\b[^>]*name="csrf-token"[^>]*>~i', '', $html);
            $html = preg_replace('~\s(?:wire:snapshot|wire:effects)="[^"]*"~', '', $html);
            $html = preg_replace('~src="[^"]*"~', 'src="assets/escudo.png"', $html);
            $html = str_replace('</head>', '<link rel="stylesheet" href="assets/app.css"><link rel="stylesheet" href="assets/icons.css"></head>', $html);
            foreach (['light' => '', 'dark' => 'dark'] as $theme => $class) {
                $variant = preg_replace('~(<html\b[^>]*class=")[^"]*(")~', '$1'.$class.'$2', $html);
                file_put_contents($destination.'/'.$route.'-'.$theme.'.html', $variant);
            }
            echo $route."=200, datos sintéticos\n";
        }

        // Revisa el encabezado del modal real: un cambio delegado había dejado
        // sus atributos como texto y duplicado la apertura de h3 al editar.
        $age = Age::firstOrFail();
        $edicion = Livewire::test(People::class)
            ->call('editRecord', $age->id)->html();
        $dom = new DOMDocument;
        @$dom->loadHTML('<?xml encoding="UTF-8">'.$edicion);
        $xpath = new DOMXPath($dom);
        $titulos = $xpath->query('//*[@id="edit-modal-title"]');
        $this->assertCount(1, $titulos);
        $this->assertSame('h3', $titulos->item(0)->nodeName);
        $this->assertSame('Editar Registro', trim($titulos->item(0)->textContent));
    }
}
