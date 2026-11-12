<?php

namespace Pruebas\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Integracion de la suite /pruebas con el descubrimiento de PHPUnit y con la
 * guardia que aborta antes de crear la aplicacion.
 *
 * No usa RefreshDatabase ni migraciones: los casos positivos trabajan con una
 * tabla sintetica creada en la propia base SQLite en memoria.
 */
class GuardiaEntornoPruebasTest extends TestCase
{
    public function test_la_suite_hereda_la_base_protegida_y_usa_sqlite_en_memoria(): void
    {
        $this->assertInstanceOf(TestCase::class, $this);
        $this->assertSame('testing', app()->environment());
        $this->assertSame('sqlite', config('database.default'));
        $this->assertSame(':memory:', config('database.connections.sqlite.database'));
    }

    public function test_acepta_un_dato_sintetico_sin_migraciones(): void
    {
        $valor = DB::selectOne('select 1 as valor');
        $this->assertSame(1, (int) $valor->valor);

        DB::statement('create table prueba_sintetica (id integer primary key, texto text not null)');
        DB::insert("insert into prueba_sintetica (id, texto) values (1, 'dato ficticio')");

        $fila = DB::selectOne('select texto from prueba_sintetica where id = 1');
        $this->assertSame('dato ficticio', $fila->texto);
    }

    public function test_phpunit_fuerza_el_entorno_aislado_y_registra_la_suite(): void
    {
        $xml = simplexml_load_file(base_path('phpunit.xml'));
        $this->assertNotFalse($xml);

        $forzadas = [
            'APP_ENV' => 'testing',
            'DB_CONNECTION' => 'sqlite',
            'DB_DATABASE' => ':memory:',
            'DB_URL' => '',
            'CACHE_STORE' => 'array',
            'SESSION_DRIVER' => 'array',
            'MAIL_MAILER' => 'array',
            'QUEUE_CONNECTION' => 'sync',
        ];

        $encontrados = [];
        foreach ($xml->php->env as $entorno) {
            $encontrados[(string) $entorno['name']] = [
                'valor' => (string) $entorno['value'],
                'forzado' => (string) $entorno['force'],
            ];
        }

        foreach ($forzadas as $clave => $valor) {
            $this->assertArrayHasKey($clave, $encontrados, "Falta la variable {$clave} en phpunit.xml.");
            $this->assertSame($valor, $encontrados[$clave]['valor'], "Valor inesperado para {$clave}.");
            $this->assertSame('true', $encontrados[$clave]['forzado'], "{$clave} debe declararse con force=\"true\".");
        }

        $suite = null;
        foreach ($xml->testsuites->testsuite as $definida) {
            if ((string) $definida['name'] === 'Pruebas') {
                $suite = $definida;
            }
        }

        $this->assertNotNull($suite, 'La suite Pruebas no esta registrada en phpunit.xml.');
        $directorios = [];
        foreach ($suite->directory as $directorio) {
            $directorios[] = trim((string) $directorio);
        }
        $this->assertSame(['pruebas/Feature', 'pruebas/Unit'], $directorios);
    }

    public function test_el_arranque_real_se_aborta_antes_del_bootstrap_con_fuentes_contradictorias(): void
    {
        $resultado = $this->ejecutarArranqueAislado();

        $this->assertSame(0, $resultado['codigo'], $resultado['salida']);
        $this->assertStringContainsString('RESULTADO=ABORTADO', $resultado['salida']);
        $this->assertStringContainsString('ORIGEN=guardia', $resultado['salida']);
        $this->assertStringContainsString('DB_CONNECTION', $resultado['salida']);
        $this->assertStringNotContainsString('RESULTADO=APLICACION_CREADA', $resultado['salida']);

        // El proceso hijo corre con `php -n`: sin php.ini ni extensiones, de modo
        // que ningun driver MySQL esta disponible aunque la guardia fallara.
        $this->assertStringContainsString('PDO_MYSQL=no', $resultado['salida']);
        $this->assertStringContainsString('MYSQLI=no', $resultado['salida']);
        $this->assertStringNotContainsString('RESULTADO=ABORTADO_POR_DRIVER', $resultado['salida']);

        // Observables del proceso: sin aplicacion, sin bootstrap/app.php y sin
        // gestor de base de datos cargado, por lo que ningun proveedor se ejecuto
        // ni se abrio una conexion.
        $this->assertStringContainsString('CONTENEDOR_CREADO=no', $resultado['salida']);
        $this->assertStringContainsString('BOOTSTRAP_APP_INCLUIDO=no', $resultado['salida']);
        $this->assertStringContainsString('DB_MANAGER_CARGADO=no', $resultado['salida']);
    }

    /**
     * Ejecuta el fixture aislado en un proceso PHP aparte.
     *
     * @return array{codigo: int, salida: string}
     */
    private function ejecutarArranqueAislado(): array
    {
        $script = realpath(__DIR__.'/../arranque-forzado.php');
        $this->assertNotFalse($script, 'No se encontro pruebas/arranque-forzado.php.');

        $comando = [PHP_BINARY, '-n', $script];
        $descriptores = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $entorno = [
            'SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows',
            'PATH' => getenv('PATH') ?: '',
        ];

        $proceso = proc_open($comando, $descriptores, $tuberias, base_path(), $entorno);
        $this->assertIsResource($proceso, 'No se pudo iniciar el proceso de comprobacion.');

        $salida = (string) stream_get_contents($tuberias[1]);
        $errores = (string) stream_get_contents($tuberias[2]);
        fclose($tuberias[1]);
        fclose($tuberias[2]);

        $codigo = proc_close($proceso);

        return ['codigo' => $codigo, 'salida' => $salida.$errores];
    }
}
