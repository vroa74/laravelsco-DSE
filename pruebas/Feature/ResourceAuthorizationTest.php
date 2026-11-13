<?php

namespace Pruebas\Feature;

use App\Livewire\Cc;
use App\Livewire\FileManager;
use App\Livewire\Leg;
use App\Livewire\Nc;
use App\Livewire\People;
use App\Livewire\Reportesgral\Create;
use App\Livewire\Reportesgral\Edit;
use App\Livewire\Reportesgral\Index as CorrespondenceIndex;
use App\Livewire\Tc;
use App\Livewire\UserGroups\Index;
use App\Livewire\Usuarios\Index as UsersIndex;
use App\Models\Co;
use App\Models\CosFile;
use App\Models\User;
use App\Models\UserGroup;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;

class ResourceAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->useStoragePath(base_path('pruebas/.cache/permisos/storage'));
        Storage::fake('public');
    }

    private function actor(int $tipo = 3): User
    {
        $user = User::factory()->create(['tipo' => $tipo, 'status' => true]);
        $this->actingAs($user);

        return $user;
    }

    private function documento(?User $recipient = null, string $marker = 'PROPIO'): Co
    {
        $co = new Co;
        $co->forceFill(['tur_type' => 'user', 'tur_id' => $recipient?->id, 'des' => $marker, 'nofi' => $marker,
            'ncor' => 'Ordinaria', 'tcor' => 'Correspondencia normal', 'nhoj' => 1])->save();

        return $co;
    }

    private function archivo(Co $co, string $name = 'sintetico'): CosFile
    {
        $path = 'cos-files/'.$name.'.pdf';
        Storage::disk('public')->put($path, '%PDF-archivo-sintetico');

        return CosFile::create(['cos_id' => $co->id, 'original_name' => $name.'.pdf', 'file_name' => $name.'.pdf',
            'file_path' => $path, 'file_type' => 'pdf', 'file_size' => 23]);
    }

    public function test_tipos_0_1_2_administran_recursos_y_tipo_3_no(): void
    {
        foreach ([0, 1, 2] as $tipo) {
            $this->actor($tipo);
            $this->assertTrue(Gate::allows('administrar-sistema'));
            foreach (['/usuario', '/agen', '/user-groups', '/catalogos'] as $uri) {
                $this->get($uri)->assertOk();
            }
        }
        $this->actor();
        foreach (['/usuario', '/agen', '/user-groups', '/catalogos', '/componentes', '/usuarios', '/temp'] as $uri) {
            $this->get($uri)->assertForbidden();
        }
        $this->post('/user-groups', ['name' => 'No debe crearse'])->assertForbidden();
        $this->assertDatabaseMissing('user_groups', ['name' => 'No debe crearse']);
    }

    public function test_livewire_deniega_montaje_directo_de_componentes_administrativos(): void
    {
        $this->actor();
        foreach ([UsersIndex::class, People::class, Index::class,
            Leg::class, Nc::class, Tc::class, Cc::class,
            \App\Livewire\Catalogo\Nc::class, Create::class, Edit::class] as $component) {
            Livewire::test($component)->assertForbidden();
        }
    }

    public function test_autorizacion_se_repite_en_actualizaciones_livewire(): void
    {
        $actor = $this->actor(2);
        $component = Livewire::test(UsersIndex::class);
        $actor->forceFill(['tipo' => 3])->save();
        $component->call('openCreateModal')->assertForbidden();
    }

    public function test_tipo_desconocido_no_se_convierte_en_superadministrador(): void
    {
        foreach ([null, '', 'invalido', 4, false] as $tipo) {
            $user = new User;
            $user->forceFill(['id' => 500, 'status' => true, 'tipo' => $tipo]);
            $this->assertNull($user->tipoVigente());
            $this->assertFalse($user->administraSistema());
            $this->assertFalse(Gate::forUser($user)->allows('viewAny', Co::class));
            $this->assertSame(0, Co::visibleTo($user)->count());
        }
    }

    public function test_listado_conteo_busqueda_y_csv_comparten_alcance_individual(): void
    {
        $actor = $this->actor();
        $own = $this->documento($actor, 'SOLO_PROPIO');
        $this->documento(User::factory()->create(), 'SECRETO_AJENO');
        $this->documento(null, 'LEGADO_AMBIGUO');
        $this->get('/rg')->assertOk()->assertSee('SOLO_PROPIO')->assertDontSee('SECRETO_AJENO')
            ->assertDontSee('LEGADO_AMBIGUO')->assertDontSee('Agregar registro')->assertDontSee('select * from')
            ->assertDontSee('href="'.route('catalogos').'"', false);
        $component = Livewire::test(CorrespondenceIndex::class);
        $this->assertSame(1, $component->instance()->getFilteredCount());
        $component->set('des', 'SECRETO_AJENO');
        $this->assertSame(0, $component->instance()->getFilteredCount());
        $component->set('des', '');
        $response = $component->instance()->exportCSV();
        ob_start();
        $response->sendContent();
        $csv = ob_get_clean();
        $this->assertStringContainsString('SOLO_PROPIO', $csv);
        $this->assertStringNotContainsString('SECRETO_AJENO', $csv);
        $this->assertStringNotContainsString('LEGADO_AMBIGUO', $csv);
        $this->get('/rg/'.$own->id)->assertOk()->assertDontSee('Editar registro');
    }

    public function test_rem_id_nombres_y_membresia_actual_no_otorgan_acceso_historico(): void
    {
        $actor = $this->actor();
        $legacy = $this->documento(null, 'LEGADO');
        // rem_id apunta a ages: preservar literalmente, aunque coincida con User::id.
        DB::table('ages')->insert(['id' => $actor->id, 'nombre' => 'Directorio sintético']);
        $legacy->forceFill(['rem_id' => $actor->id, 'tur_nom' => $actor->name])->save();
        $group = UserGroup::create(['name' => 'Grupo sintético', 'created_by' => $actor->id, 'active' => true]);
        $group->members()->attach($actor->id);
        $groupDoc = $this->documento($actor, 'GRUPO_SIN_SNAPSHOT');
        $groupDoc->forceFill(['tur_type' => 'group', 'tur_group_id' => $group->id])->save();
        foreach ([$legacy, $groupDoc] as $co) {
            $this->assertFalse(Gate::allows('view', $co));
            $this->get('/rg/'.$co->id)->assertNotFound();
        }
        $this->assertSame(0, Co::visibleTo($actor)->count());
    }

    public function test_usuario_no_crea_edita_borra_o_consulta_documento_ajeno(): void
    {
        $actor = $this->actor();
        $own = $this->documento($actor);
        $other = $this->documento(User::factory()->create(), 'AJENO');
        $this->get('/rg/create')->assertForbidden();
        $this->get('/rg/'.$own->id.'/edit')->assertForbidden();
        $this->delete('/rg/'.$own->id)->assertForbidden();
        $this->get('/rg/'.$other->id)->assertNotFound();
        $this->assertDatabaseHas('cos', ['id' => $own->id]);
        $this->assertDatabaseHas('cos', ['id' => $other->id]);
    }

    public function test_los_tres_reportes_individuales_rechazan_oficio_ajeno_antes_de_dompdf(): void
    {
        $this->actor();
        $other = $this->documento(User::factory()->create());
        Pdf::shouldReceive('loadView')->never();
        foreach (['normal', 'especial', 'solicitud'] as $type) {
            $this->get('/reporte-'.$type.'/'.$other->id.'/reporte1')->assertNotFound();
        }
    }

    public function test_exportacion_pdf_solo_envia_registros_autorizados_al_motor(): void
    {
        $actor = $this->actor();
        $own = $this->documento($actor);
        $this->documento(User::factory()->create(), 'AJENO');
        $pdf = Mockery::mock(\Barryvdh\DomPDF\PDF::class);
        $pdf->shouldReceive('setPaper')->once()->with('a4', 'portrait')->andReturnSelf();
        $pdf->shouldReceive('output')->once()->andReturn('%PDF-fixture-sintetico');
        Pdf::shouldReceive('loadView')->once()->with('reports.reporte', Mockery::on(function ($data) use ($own) {
            return $data['registros']->pluck('id')->all() === [$own->id];
        }))->andReturn($pdf);
        $response = Livewire::test(CorrespondenceIndex::class)->instance()->exportPDF();
        ob_start();
        $response->sendContent();
        $this->assertSame('%PDF-fixture-sintetico', ob_get_clean());
    }

    public function test_archivos_exigen_documento_visible_y_pertenencia_del_archivo(): void
    {
        $actor = $this->actor();
        $own = $this->documento($actor);
        $other = $this->documento(User::factory()->create(), 'AJENO');
        $file = $this->archivo($own);
        $foreignFile = $this->archivo($other, 'ajeno');
        $this->get($file->url)->assertOk()->assertHeader('X-Content-Type-Options', 'nosniff')->assertStreamedContent('%PDF-archivo-sintetico');
        $this->get($foreignFile->url)->assertNotFound();
        $this->get(route('correspondencia.archivo', [$own->id, $foreignFile->id]))->assertNotFound();
        Livewire::test(FileManager::class, ['cosId' => $own->id])->call('deleteFile', $file->id)->assertForbidden();
        $this->assertDatabaseHas('cos_files', ['id' => $file->id]);
        Storage::disk('public')->assertExists($file->file_path);
    }

    public function test_componente_de_archivos_no_carga_documento_ajeno(): void
    {
        $this->actor();
        $other = $this->documento(User::factory()->create(), 'AJENO');
        $this->expectException(ModelNotFoundException::class);
        Livewire::test(FileManager::class, ['cosId' => $other->id]);
    }

    public function test_ruta_de_archivo_fuera_del_directorio_admitido_no_se_sirve(): void
    {
        $actor = $this->actor();
        $file = $this->archivo($this->documento($actor));
        $file->update(['file_path' => 'profile-photos/privada.png']);
        Storage::disk('public')->put('profile-photos/privada.png', 'NO_SERVIR');
        $this->get($file->url)->assertNotFound();
    }

    public function test_supervisor_no_puede_asignar_tipo_cero_ni_modificar_superadministrador(): void
    {
        $this->actor(2);
        $super = User::factory()->create(['tipo' => 0, 'status' => true]);
        Livewire::test(UsersIndex::class)->set('createTipo', 0)->call('saveCreateRecord')->assertForbidden();
        Livewire::test(UsersIndex::class)->call('editRecord', $super->id)->assertForbidden();
        Livewire::test(UsersIndex::class)->set('deleteRecordId', $super->id)->call('deleteRecord')->assertForbidden();
        $this->assertDatabaseHas('users', ['id' => $super->id, 'tipo' => 0]);
        $this->actingAs($super);
        $this->assertTrue(Gate::allows('assignType', [User::class, 0]));
    }
}
