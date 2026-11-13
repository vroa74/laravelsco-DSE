<?php

namespace Pruebas\Feature;

use App\Livewire\Usuarios\Index;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Mockery;
use RuntimeException;
use Tests\TestCase;

/**
 * Ciclo de vida de la fotografia de perfil de /usuario.
 *
 * Causa reproducida: las cargas se guardan en storage/app/public/profile-photos
 * y la vista usaba asset('storage/...'), que apunta a public/storage (un
 * directorio normal, no un enlace simbolico) y por eso devuelve 404.
 *
 * Solo datos y binarios sinteticos: Storage::fake('public') y SQLite en memoria
 * heredado de Tests\TestCase. No se ejecutan migraciones ni se toca MySQL,
 * public/storage ni archivos reales.
 */
class FotosPerfilUsuarioTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Todos los archivos de Storage::fake y Livewire permanecen en /pruebas.
        $this->app->useStoragePath(base_path('pruebas/.cache/fotos/storage'));
        Storage::fake('public');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rfc', 13)->nullable();
            $table->string('curp', 20)->nullable();
            $table->string('direction', 250)->nullable();
            $table->string('position', 35)->nullable();
            $table->string('sex', 20)->nullable();
            $table->string('lvl', 10)->nullable();
            $table->integer('tipo')->default(3);
            $table->boolean('status')->default(true);
            $table->string('theme', 10)->default('dark');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamps();
        });
    }

    /** PNG 1x1 sintetico; evita depender de la extension GD. */
    private function png(): string
    {
        return base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8DwHwAFAAH/q842iQAAAABJRU5ErkJggg=='
        );
    }

    private function imagen(string $nombre = 'foto.png'): UploadedFile
    {
        return UploadedFile::fake()->createWithContent($nombre, $this->png());
    }

    private function usuarioConFoto(string $email = 'sintetico@example.test'): User
    {
        $ruta = 'profile-photos/existente.png';
        Storage::disk('public')->put($ruta, $this->png());

        return User::create([
            'name' => 'Usuario Sintetico',
            'email' => $email,
            'password' => bcrypt('secreta123'),
            'tipo' => 3,
            'status' => true,
            'profile_photo_path' => $ruta,
        ]);
    }

    public function test_alta_con_foto_guarda_el_archivo_y_devuelve_url_servible(): void
    {
        Livewire::test(Index::class)
            ->set('createName', 'Alta Sintetica')
            ->set('createEmail', 'alta@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', $this->imagen())
            ->call('saveCreateRecord')
            ->assertHasNoErrors();

        $user = User::where('email', 'alta@example.test')->firstOrFail();

        $this->assertNotNull($user->profile_photo_path);
        $this->assertStringStartsWith('profile-photos/', $user->profile_photo_path);
        Storage::disk('public')->assertExists($user->profile_photo_path);

        $url = $user->profile_photo_url;
        $this->assertStringStartsWith(route('usuario.foto', ['usuario' => $user->id]), $url);
        // La version no expone el nombre del archivo y es estable entre lecturas.
        $this->assertStringContainsString('v=', $url);
        $this->assertStringNotContainsString(basename($user->profile_photo_path), $url);
        $this->assertSame($url, $user->profile_photo_url);

        $respuesta = $this->actingAs($user)->get($url);
        $respuesta->assertOk();
        $this->assertSame('image/png', $respuesta->headers->get('Content-Type'));
        $this->assertSame($this->png(), $respuesta->streamedContent());
    }

    public function test_segunda_entrada_de_alta_tambien_guarda_la_foto(): void
    {
        Livewire::test(Index::class)
            ->set('newName', 'Insert Sintetico')
            ->set('newEmail', 'insert@example.test')
            ->set('newPassword', 'secreta123')
            ->set('newPasswordConfirmation', 'secreta123')
            ->set('newProfilePhoto', $this->imagen('insert.png'))
            ->call('saveNewRecord')
            ->assertHasNoErrors();

        $user = User::where('email', 'insert@example.test')->firstOrFail();
        Storage::disk('public')->assertExists($user->profile_photo_path);
        $this->assertNotNull($user->profile_photo_url);
    }

    public function test_listado_y_detalle_usan_la_url_persistida(): void
    {
        $user = $this->usuarioConFoto();
        $esperada = $user->profile_photo_url;

        $this->assertNotNull($esperada);
        // Es la misma expresion que consumen lista y detalle, y no cambia entre renders.
        $this->assertSame($esperada, $user->profile_photo_url);

        $componente = Livewire::test(Index::class)->call('showRecord', $user->id);
        $this->assertSame($esperada, $componente->get('selectedRecord')->profile_photo_url);
        $this->assertStringContainsString('src="'.$esperada.'"', $componente->html());
    }

    public function test_edicion_carga_la_url_del_registro_actual(): void
    {
        $user = $this->usuarioConFoto();

        $componente = Livewire::test(Index::class)->call('editRecord', $user->id);

        $this->assertSame($user->profile_photo_url, $componente->get('editProfilePhotoUrl'));
        $this->assertStringContainsString('src="'.$user->profile_photo_url.'"', $componente->html());
    }

    public function test_perfil_propio_guarda_y_muestra_foto_tras_la_redireccion_efectiva(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;
        $this->actingAs($user);

        $componente = Livewire::test('profile.update-profile-information-form')
            ->set('photo', $this->imagen('propia.png'))
            ->call('updateProfileInformation')
            ->assertHasNoErrors()
            ->assertRedirect(route('profile.show'));

        $actual = $user->fresh();
        $this->assertNotSame($anterior, $actual->profile_photo_path);
        Storage::disk('public')->assertMissing($anterior);
        Storage::disk('public')->assertExists($actual->profile_photo_path);
        $pagina = $this->get(route('profile.show'))->assertOk()->getContent();
        $this->assertStringContainsString('src="'.$actual->profile_photo_url.'"', $pagina);
        $this->assertStringContainsString('x-ref="photo"', $pagina);
        $this->assertStringContainsString('src="'.$actual->profile_photo_url.'"', view('navigation-menu')->render());
    }

    public function test_perfil_propio_conserva_foto_anterior_si_el_registro_no_se_guarda(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;
        $this->actingAs($user);
        User::updating(fn () => false);

        Livewire::test('profile.update-profile-information-form')
            ->set('photo', $this->imagen('fallida.png'))
            ->call('updateProfileInformation')
            ->assertHasErrors('photo')
            ->assertNotDispatched('saved');

        $this->assertSame($anterior, $user->fresh()->profile_photo_path);
        Storage::disk('public')->assertExists($anterior);
        $this->assertCount(1, Storage::disk('public')->allFiles('profile-photos'));
    }

    public function test_perfil_propio_no_borra_archivo_si_no_puede_quitar_su_referencia(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;
        $this->actingAs($user);
        User::updating(fn () => false);

        Livewire::test('profile.update-profile-information-form')
            ->call('deleteProfilePhoto')->assertHasErrors('photo');

        $this->assertSame($anterior, $user->fresh()->profile_photo_path);
        Storage::disk('public')->assertExists($anterior);
    }

    public function test_perfil_propio_rechaza_una_escritura_de_archivo_fallida(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;
        $photo = Mockery::mock(UploadedFile::class);
        $photo->shouldReceive('storePublicly')->once()->andReturn(false);

        try {
            $user->updateProfilePhoto($photo);
            $this->fail('La escritura fallida debe producir un error de campo.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('photo', $e->errors());
        }
        $this->assertSame($anterior, $user->fresh()->profile_photo_path);
        Storage::disk('public')->assertExists($anterior);
    }

    public function test_perfil_propio_quita_foto_y_actualiza_navegacion(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;
        $this->actingAs($user);

        Livewire::test('profile.update-profile-information-form')
            ->call('deleteProfilePhoto')->assertHasNoErrors()
            ->assertDispatched('refresh-navigation-menu');

        $this->assertNull($user->fresh()->profile_photo_path);
        Storage::disk('public')->assertMissing($anterior);
    }

    public function test_perfil_propio_muestra_fallback_cuando_falta_el_archivo(): void
    {
        $user = $this->usuarioConFoto();
        Storage::disk('public')->delete($user->profile_photo_path);
        $this->actingAs($user)->get(route('profile.show'))->assertOk()
            ->assertSee('Fotografía no disponible')->assertDontSee('src=""', false);
    }

    public function test_sustitucion_exitosa_borra_la_foto_anterior(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;

        Livewire::test(Index::class)
            ->call('editRecord', $user->id)
            ->set('editName', 'Usuario Sintetico Renombrado')
            ->set('editProfilePhoto', $this->imagen('nueva.png'))
            ->call('updateRecord')
            ->assertHasNoErrors();

        $nueva = $user->fresh()->profile_photo_path;

        $this->assertNotSame($anterior, $nueva);
        Storage::disk('public')->assertExists($nueva);
        Storage::disk('public')->assertMissing($anterior);
    }

    public function test_fallo_al_guardar_conserva_la_foto_anterior_y_no_deja_huerfanos(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;

        User::updating(function (): void {
            throw new RuntimeException('fallo simulado de escritura');
        });

        Livewire::test(Index::class)
            ->call('editRecord', $user->id)
            ->set('editName', 'Nombre Que No Debe Guardarse')
            ->set('editProfilePhoto', $this->imagen('nueva.png'))
            ->call('updateRecord')
            ->assertHasErrors('editProfilePhoto');

        $recargado = $user->fresh();

        $this->assertSame($anterior, $recargado->profile_photo_path);
        $this->assertSame('Usuario Sintetico', $recargado->name);
        Storage::disk('public')->assertExists($anterior);
        // La foto nueva se descarta: solo queda el archivo original.
        $this->assertCount(1, Storage::disk('public')->allFiles('profile-photos'));
    }

    public function test_archivo_inexistente_no_inventa_url(): void
    {
        $user = $this->usuarioConFoto();
        Storage::disk('public')->delete($user->profile_photo_path);

        $this->assertNull($user->fresh()->profile_photo_url);
        $this->actingAs($user)->get(route('usuario.foto', ['usuario' => $user->id]))->assertNotFound();
    }

    public function test_ruta_no_sirve_archivos_fuera_de_profile_photos(): void
    {
        Storage::disk('public')->put('fuera.png', $this->png());
        $user = $this->usuarioConFoto();

        foreach (['../fuera.png', 'fuera.png', ''] as $ruta) {
            $user->forceFill(['profile_photo_path' => $ruta])->save();
            $this->actingAs($user)
                ->get(route('usuario.foto', ['usuario' => $user->id]))
                ->assertNotFound();
        }
    }

    public function test_url_compatible_storage_sirve_la_foto_sin_enlace_simbolico(): void
    {
        $user = $this->usuarioConFoto();
        Storage::disk('public')->put('profile-photos/otra.png', $this->png());

        $this->actingAs($user)->get('/storage/profile-photos/otra.png')->assertOk();
        $this->actingAs($user)->get('/storage/profile-photos/no-existe.png')->assertNotFound();
        $this->actingAs($user)->get('/storage/profile-photos/otra.txt')->assertNotFound();
        // Intento de salir del directorio: nunca debe devolver la imagen.
        $this->assertNotSame(200, $this->actingAs($user)->get('/storage/profile-photos/..%2Fotra.png')->getStatusCode());
    }

    public function test_la_ruta_de_foto_exige_autenticacion(): void
    {
        $user = $this->usuarioConFoto();

        $this->get(route('usuario.foto', ['usuario' => $user->id]))->assertRedirect();
    }

    public function test_foto_invalida_no_crea_usuario(): void
    {
        Livewire::test(Index::class)
            ->set('createName', 'Alta Invalida')
            ->set('createEmail', 'invalida@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', UploadedFile::fake()->create('nota.txt', 4, 'text/plain'))
            ->call('saveCreateRecord')
            ->assertHasErrors('createProfilePhoto');

        $this->assertNull(User::where('email', 'invalida@example.test')->first());
    }

    public function test_version_de_la_url_cambia_al_sustituir_la_foto(): void
    {
        $user = $this->usuarioConFoto();
        $urlAnterior = $user->profile_photo_url;

        Livewire::test(Index::class)
            ->call('editRecord', $user->id)
            ->set('editName', 'Usuario Renombrado')
            ->set('editProfilePhoto', $this->imagen('otra.png'))
            ->call('updateRecord')
            ->assertHasNoErrors();

        $urlNueva = $user->fresh()->profile_photo_url;

        $this->assertNotNull($urlAnterior);
        $this->assertNotSame($urlAnterior, $urlNueva);
        $this->assertStringNotContainsString(basename($user->fresh()->profile_photo_path), $urlNueva);
    }

    public function test_store_false_en_alta_no_crea_usuario_ni_anuncia_exito(): void
    {
        // Livewire escribe con put() y devuelve la ruta aunque el put falle
        // (el disco public tiene throw=false): la comprobacion es exists().
        $disco = Mockery::mock(FilesystemAdapter::class);
        $disco->shouldReceive('put')->once()->andReturn(false);
        $disco->shouldReceive('exists')->andReturn(false);
        $disco->shouldNotReceive('delete');
        Storage::set('public', $disco);

        $componente = Livewire::test(Index::class)
            ->set('createName', 'Alta Sin Disco')
            ->set('createEmail', 'sindisco@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', $this->imagen())
            ->call('saveCreateRecord');

        $componente->assertHasErrors('createProfilePhoto');

        $this->assertNull(User::where('email', 'sindisco@example.test')->first());
    }

    public function test_store_false_en_edicion_conserva_la_foto_anterior(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;

        $componente = Livewire::test(Index::class)->call('editRecord', $user->id);

        $disco = Mockery::mock(FilesystemAdapter::class);
        $disco->shouldReceive('put')->once()->andReturn(false);
        $disco->shouldReceive('exists')->andReturn(false);
        $disco->shouldNotReceive('delete');
        Storage::set('public', $disco);

        $componente
            ->set('editName', 'Nombre No Guardado')
            ->set('editProfilePhoto', $this->imagen('nueva.png'))
            ->call('updateRecord')
            ->assertHasErrors('editProfilePhoto');

        $recargado = $user->fresh();

        $this->assertSame($anterior, $recargado->profile_photo_path);
        $this->assertSame('Usuario Sintetico', $recargado->name);
    }

    public function test_evento_cancelado_no_borra_la_foto_anterior(): void
    {
        $user = $this->usuarioConFoto();
        $anterior = $user->profile_photo_path;

        // save()/update() devuelven false sin excepción cuando un evento lo cancela.
        User::updating(fn (): bool => false);

        Livewire::test(Index::class)
            ->call('editRecord', $user->id)
            ->set('editName', 'Nombre Cancelado')
            ->set('editProfilePhoto', $this->imagen('nueva.png'))
            ->call('updateRecord')
            ->assertHasErrors('editProfilePhoto');

        $recargado = $user->fresh();

        $this->assertSame($anterior, $recargado->profile_photo_path);
        $this->assertSame('Usuario Sintetico', $recargado->name);
        Storage::disk('public')->assertExists($anterior);
        $this->assertCount(1, Storage::disk('public')->allFiles('profile-photos'));
    }

    public function test_creacion_cancelada_no_anuncia_exito_ni_deja_archivo(): void
    {
        User::creating(fn (): bool => false);

        Livewire::test(Index::class)
            ->set('createName', 'Alta Cancelada')
            ->set('createEmail', 'cancelada@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', $this->imagen())
            ->call('saveCreateRecord')
            ->assertHasErrors('createProfilePhoto');

        $this->assertNull(User::where('email', 'cancelada@example.test')->first());
        // El archivo escrito antes del alta se descarta.
        $this->assertCount(0, Storage::disk('public')->allFiles('profile-photos'));
    }

    public function test_accessor_rechaza_rutas_invalidas_sin_consultar_el_disco(): void
    {
        $disco = Mockery::mock(FilesystemAdapter::class);
        $disco->shouldNotReceive('exists');
        Storage::set('public', $disco);

        $user = new User(['name' => 'Sin Ruta', 'email' => 'ruta@example.test', 'password' => 'x']);

        foreach ([
            '../fuera.png',
            'profile-photos/../fuera.png',
            'profile-photos/sub/foto.png',
            'profile-photos/foto.svg',
            'profile-photos/foto.php',
            'otra/foto.png',
            '/etc/passwd',
        ] as $ruta) {
            $user->profile_photo_path = $ruta;
            $this->assertNull($user->profile_photo_url, "Ruta aceptada por error: {$ruta}");
        }
    }

    public function test_formatos_no_servibles_se_rechazan_en_la_carga(): void
    {
        Livewire::test(Index::class)
            ->set('createName', 'Alta Svg')
            ->set('createEmail', 'svg@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', UploadedFile::fake()->createWithContent(
                'foto.svg',
                '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>'
            ))
            ->call('saveCreateRecord')
            ->assertHasErrors('createProfilePhoto');

        $this->assertNull(User::where('email', 'svg@example.test')->first());
    }

    public function test_el_controlador_rechaza_formatos_no_servibles_aunque_el_archivo_exista(): void
    {
        $user = $this->usuarioConFoto();
        Storage::disk('public')->put('profile-photos/foto.svg', '<svg/>');

        $user->forceFill(['profile_photo_path' => 'profile-photos/foto.svg'])->save();

        $this->actingAs($user)->get(route('usuario.foto', ['usuario' => $user->id]))->assertNotFound();
        $this->actingAs($user)->get('/storage/profile-photos/foto.svg')->assertNotFound();
    }

    public function test_conserva_compatibilidad_con_imagen_bmp_valida(): void
    {
        $contenido = base64_decode('Qk06AAAAAAAAADYAAAAoAAAAAQAAAAEAAAABABgAAAAAAAQAAAATCwAAEwsAAAAAAAAAAAAAAAD/AA==');
        Livewire::test(Index::class)
            ->set('createName', 'Alta BMP Sintetica')
            ->set('createEmail', 'bmp@example.test')
            ->set('createPassword', 'secreta123')
            ->set('createPasswordConfirmation', 'secreta123')
            ->set('createProfilePhoto', UploadedFile::fake()->createWithContent('foto.bmp', $contenido))
            ->call('saveCreateRecord')
            ->assertHasNoErrors();

        $usuario = User::where('email', 'bmp@example.test')->firstOrFail();
        $this->assertNotNull($usuario->profile_photo_url);
        $respuesta = $this->actingAs($usuario)->get($usuario->profile_photo_url)->assertOk();
        $this->assertSame($contenido, $respuesta->streamedContent());
    }

    public function test_sustituir_foto_no_borra_una_ruta_historica_ajena(): void
    {
        $usuario = $this->usuarioConFoto();
        $rutaAjena = 'documentos/conservar.txt';
        Storage::disk('public')->put($rutaAjena, 'Contenido sintetico ajeno al perfil');
        $usuario->forceFill(['profile_photo_path' => $rutaAjena])->save();

        Livewire::test(Index::class)
            ->call('editRecord', $usuario->id)
            ->set('editProfilePhoto', $this->imagen('sustituta.png'))
            ->call('updateRecord')
            ->assertHasNoErrors();

        Storage::disk('public')->assertExists($rutaAjena);
        $this->assertSame('Contenido sintetico ajeno al perfil', Storage::disk('public')->get($rutaAjena));
        $this->assertNotSame($rutaAjena, $usuario->fresh()->profile_photo_path);
    }
}
