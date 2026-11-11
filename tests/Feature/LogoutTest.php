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

test('abrir logout por GET redirige a la pagina de inicio publica', function () {
    $this->get('/logout')->assertRedirect(route('welcome'));
});
