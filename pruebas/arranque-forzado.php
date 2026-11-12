<?php

declare(strict_types=1);
use Illuminate\Container\Container;
use Illuminate\Database\DatabaseManager;
use Tests\TestCase;

/**
 * Fixture aislado: recorre Tests\TestCase::createApplication() bajo un entorno
 * que la guardia debe rechazar, y publica solo hechos observables del proceso.
 *
 * Escenario reproducido: PHPUnit escribe putenv() y $_ENV, pero no $_SERVER
 * (vendor/phpunit/phpunit/src/TextUI/Configuration/PhpHandler.php). Un valor
 * heredado en $_SERVER es el que Laravel leeria primero, porque
 * RepositoryBuilder declara ServerConstAdapter antes de EnvConstAdapter.
 *
 * No ejecuta consultas: si la guardia fallara, solo se crearia la aplicacion y
 * el test que invoca este fixture fallaria al leer los marcadores.
 */

require __DIR__.'/../vendor/autoload.php';

/**
 * Subclase concreta minima: hereda la implementacion real de createApplication
 * sin pasar por el constructor final de PHPUnit.
 */
final class CasoForzado extends TestCase {}

$coincidentes = [
    'APP_ENV' => 'testing',
    'CACHE_STORE' => 'array',
    'SESSION_DRIVER' => 'array',
    'MAIL_MAILER' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'DB_URL' => '',
];

foreach ($coincidentes as $clave => $valor) {
    $_SERVER[$clave] = $valor;
    $_ENV[$clave] = $valor;
    putenv("{$clave}={$valor}");
}

// Conflicto deliberado: putenv/$_ENV seguros, $_SERVER no permitido.
$_ENV['DB_CONNECTION'] = 'sqlite';
putenv('DB_CONNECTION=sqlite');
$_SERVER['DB_CONNECTION'] = 'mysql';

$_ENV['DB_DATABASE'] = ':memory:';
putenv('DB_DATABASE=:memory:');
$_SERVER['DB_DATABASE'] = 'base_ficticia_inexistente';

// El proceso debe ejecutarse con `php -n` (sin php.ini ni extensiones). Se
// comprueba antes de arrancar: si un driver MySQL estuviera disponible, el
// fixture se detiene sin recorrer createApplication, para que una regresion de
// la guardia no pueda abrir una conexion real en esta prueba.
$pdoMysql = extension_loaded('pdo_mysql');
$mysqli = extension_loaded('mysqli');
echo 'PDO_MYSQL=', $pdoMysql ? 'si' : 'no', PHP_EOL;
echo 'MYSQLI=', $mysqli ? 'si' : 'no', PHP_EOL;

if ($pdoMysql || $mysqli) {
    echo 'RESULTADO=ABORTADO_POR_DRIVER', PHP_EOL;

    exit(0);
}

$caso = (new ReflectionClass(CasoForzado::class))->newInstanceWithoutConstructor();

try {
    $caso->createApplication();
    echo 'RESULTADO=APLICACION_CREADA', PHP_EOL;
} catch (RuntimeException $e) {
    echo 'RESULTADO=ABORTADO', PHP_EOL;
    echo 'EXCEPCION=', $e::class, PHP_EOL;
    echo 'ORIGEN=', str_contains(str_replace('\\', '/', $e->getFile()), 'pruebas/bootstrap.php') ? 'guardia' : 'otro', PHP_EOL;
    echo 'MENSAJE=', $e->getMessage(), PHP_EOL;
}

$propiedad = new ReflectionProperty(Container::class, 'instance');
echo 'CONTENEDOR_CREADO=', $propiedad->getValue() === null ? 'no' : 'si', PHP_EOL;

$bootstrapIncluido = false;
foreach (get_included_files() as $archivo) {
    if (str_ends_with(str_replace('\\', '/', $archivo), 'bootstrap/app.php')) {
        $bootstrapIncluido = true;
    }
}
echo 'BOOTSTRAP_APP_INCLUIDO=', $bootstrapIncluido ? 'si' : 'no', PHP_EOL;

echo 'DB_MANAGER_CARGADO=', class_exists(DatabaseManager::class, false) ? 'si' : 'no', PHP_EOL;
