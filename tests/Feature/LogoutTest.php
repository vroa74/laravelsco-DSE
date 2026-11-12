<?php

use App\Models\User;

test('cerrar sesion redirige a la pagina de inicio publica', function () {
    $response = $this->actingAs(User::factory()->create())->post(route('logout'));

    $response->assertRedirect(route('welcome'));
    $this->assertGuest();
});

test('la pagina de inicio publica carga sin sesion', function () {
    $this->get(route('welcome'))->assertOk();
});

test('la pagina de inicio publica usa el nombre de la aplicacion y no muestra texto residual', function () {
    $response = $this->get(route('welcome'));

    $response->assertOk()
        ->assertSee('<title>'.config('app.name').'</title>', false)
        ->assertDontSee('++++++');
});

test('abrir logout por GET redirige a la pagina de inicio publica', function () {
    $this->get('/logout')->assertRedirect(route('welcome'));
});
