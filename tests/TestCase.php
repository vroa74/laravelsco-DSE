<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Pruebas\GuardiaEntorno;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Aborta cualquier prueba que no use SQLite en memoria para proteger la base de datos real.
     */
    public function createApplication(): Application
    {
        // Guardia previa al arranque: se ejecuta antes de registrar proveedores y
        // antes de que cualquier conexion pueda abrirse. No sustituye a la
        // comprobacion posterior de la configuracion efectiva.
        require_once __DIR__.'/../pruebas/bootstrap.php';
        GuardiaEntorno::exigirEntornoAislado();

        $app = parent::createApplication();

        $default = $app['config']->get('database.default');
        $database = $app['config']->get("database.connections.{$default}.database");

        if ($default !== 'sqlite' || $database !== ':memory:') {
            throw new RuntimeException(
                "Prueba abortada: la conexión '{$default}' ({$database}) no es SQLite ':memory:'. "
                .'Las pruebas nunca deben tocar la base de datos real.'
            );
        }

        return $app;
    }
}
