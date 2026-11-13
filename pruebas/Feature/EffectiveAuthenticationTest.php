<?php

namespace Pruebas\Feature;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;
use PragmaRX\Google2FA\Google2FA;
use Tests\TestCase;

class EffectiveAuthenticationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app->useStoragePath(base_path('pruebas/.cache/autenticacion/storage'));
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('rfc')->nullable();
            $table->string('password');
            $table->integer('tipo')->nullable();
            $table->boolean('status')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    private function cuenta(array $attributes = []): User
    {
        return User::create(array_merge([
            'name' => 'Cuenta sintética', 'email' => 'cuenta@example.test',
            'rfc' => 'PRUE900101', 'password' => Hash::make('ClaveSintetica123!'),
            'tipo' => 3, 'status' => true,
        ], $attributes));
    }

    private function credenciales(array $overrides = []): array
    {
        return array_merge(['email' => 'cuenta@example.test', 'rfc' => 'PRUE900101', 'password' => 'ClaveSintetica123!'], $overrides);
    }

    private function segundoFactor(User $user, bool $confirmed = true): string
    {
        $secret = (new Google2FA)->generateSecretKey();
        $user->forceFill([
            'two_factor_secret' => Fortify::currentEncrypter()->encrypt($secret),
            'two_factor_recovery_codes' => Fortify::currentEncrypter()->encrypt(json_encode(['recuperacion-sintetica'])),
            'two_factor_confirmed_at' => $confirmed ? now() : null,
        ])->save();

        return $secret;
    }

    public function test_endpoint_efectivo_y_alias_del_formulario_coinciden(): void
    {
        $route = app('router')->getRoutes()->match(Request::create('/login', 'POST'));
        $this->assertSame(LoginController::class.'@login', $route->getActionName());
        $this->assertSame(parse_url(route('login.post'), PHP_URL_PATH), $route->uri() === 'login' ? '/login' : $route->uri());
        $this->assertContains('guest', $route->middleware());
        $this->assertContains('throttle:login', $route->middleware());
    }

    public function test_acceso_valido_regenera_sesion_y_cierre_la_invalida(): void
    {
        $user = $this->cuenta();
        $this->withSession(['marca_sintetica' => 'previa']);
        $previous = session()->getId();
        $this->post('/login', $this->credenciales())->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
        $this->assertNotSame($previous, session()->getId());
        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
        $this->assertFalse(session()->has('marca_sintetica'));
        $this->get('/rg')->assertRedirect('/login');
    }

    public function test_credenciales_incorrectas_no_distinguen_cuenta_contrasena_o_estado(): void
    {
        $user = $this->cuenta();
        foreach ([['password' => 'equivocada'], ['rfc' => 'OTRA900101'], ['email' => 'ausente@example.test']] as $override) {
            $this->postJson('/login', $this->credenciales($override))->assertUnprocessable()->assertJsonValidationErrors('email');
            $this->assertGuest();
        }
        $user->update(['status' => false]);
        $this->postJson('/login', $this->credenciales())->assertUnprocessable()->assertJsonValidationErrors('email');
        $this->assertGuest();
    }

    public function test_cuenta_sin_estado_activo_no_accede(): void
    {
        $this->cuenta(['status' => null]);
        $this->postJson('/login', $this->credenciales())->assertUnprocessable();
        $this->assertGuest();
    }

    public function test_rfc_obligatorio_y_tipos_invalidos_se_rechazan(): void
    {
        $this->cuenta();
        foreach ([null, ['invalido'], 'cadena-no-rfc'] as $rfc) {
            $this->postJson('/login', $this->credenciales(['rfc' => $rfc]))->assertUnprocessable()->assertJsonValidationErrors('rfc');
            $this->assertGuest();
        }
    }

    public function test_sexto_intento_se_limita_en_endpoint_real(): void
    {
        $this->cuenta();
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/login', $this->credenciales(['password' => 'equivocada']))->assertUnprocessable();
        }
        $this->postJson('/login', $this->credenciales())->assertStatus(429)->assertHeader('Retry-After');
        $this->assertGuest();
        $this->postJson('/login', $this->credenciales(['email' => 'otra@example.test']))->assertUnprocessable();
    }

    public function test_mfa_confirmado_no_autentica_antes_del_desafio_y_acepta_totp(): void
    {
        $user = $this->cuenta(['tipo' => 0]);
        $secret = $this->segundoFactor($user);
        $this->post('/login', $this->credenciales())->assertRedirect('/two-factor-challenge')->assertSessionHas('login.id', $user->id);
        $this->assertGuest();
        $this->get('/rg')->assertRedirect('/login');
        // El GET protegido conserva /rg como destino previsto, según Fortify.
        $this->post('/two-factor-challenge', ['code' => (new Google2FA)->getCurrentOtp($secret)])->assertRedirect('/rg');
        $this->assertAuthenticatedAs($user);
        $this->assertFalse(session()->has('login.id'));
    }

    public function test_codigo_mfa_incorrecto_no_autentica_y_se_limita(): void
    {
        $this->segundoFactor($this->cuenta());
        $this->post('/login', $this->credenciales())->assertRedirect('/two-factor-challenge');
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/two-factor-challenge', ['code' => 'invalido'])->assertUnprocessable();
            $this->assertGuest();
        }
        $this->postJson('/two-factor-challenge', ['code' => 'invalido'])->assertStatus(429);
    }

    public function test_recuperacion_mfa_es_de_un_solo_uso(): void
    {
        $user = $this->cuenta();
        $this->segundoFactor($user);
        $this->post('/login', $this->credenciales())->assertRedirect('/two-factor-challenge');
        $this->post('/two-factor-challenge', ['recovery_code' => 'recuperacion-sintetica'])->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
        $this->assertNotContains('recuperacion-sintetica', $user->fresh()->recoveryCodes());
        $this->post('/logout');
        $this->post('/login', $this->credenciales());
        $this->postJson('/two-factor-challenge', ['recovery_code' => 'recuperacion-sintetica'])->assertUnprocessable();
        $this->assertGuest();
    }

    public function test_baja_durante_desafio_no_permite_completar_mfa(): void
    {
        $user = $this->cuenta();
        $secret = $this->segundoFactor($user);
        $this->post('/login', $this->credenciales())->assertRedirect('/two-factor-challenge');
        $user->update(['status' => false]);
        $this->postJson('/two-factor-challenge', ['code' => (new Google2FA)->getCurrentOtp($secret)])->assertForbidden();
        $this->assertGuest();
        $this->assertFalse(session()->has('login.id'));
    }

    public function test_sesion_existente_de_cuenta_inactiva_se_cierra_antes_del_controlador(): void
    {
        $this->actingAs($this->cuenta(['status' => false]));
        $this->getJson('/rg')->assertForbidden();
        $this->assertGuest();
    }

    public function test_mfa_aun_no_confirmado_conserva_politica_actual(): void
    {
        $user = $this->cuenta();
        $this->segundoFactor($user, false);
        $this->post('/login', $this->credenciales())->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
