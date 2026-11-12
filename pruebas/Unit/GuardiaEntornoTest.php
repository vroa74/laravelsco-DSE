<?php

namespace Pruebas\Unit;

use PHPUnit\Framework\TestCase;
use Pruebas\GuardiaEntorno;
use RuntimeException;

require_once __DIR__.'/../bootstrap.php';

/**
 * Logica de la guardia, sin arrancar Laravel ni abrir conexiones.
 *
 * Cada fuente ($_ENV, $_SERVER y getenv/putenv) se guarda y restaura por
 * separado, incluyendo el caso de ausencia, para no contaminar el proceso.
 */
class GuardiaEntornoTest extends TestCase
{
    private const CLAVES = [
        'APP_ENV',
        'DB_CONNECTION',
        'DB_DATABASE',
        'DB_URL',
        'CACHE_STORE',
        'SESSION_DRIVER',
        'MAIL_MAILER',
        'QUEUE_CONNECTION',
    ];

    /**
     * @var array<string, array{SERVER: array{existe: bool, valor: string|null}, ENV: array{existe: bool, valor: string|null}, PUTENV: array{existe: bool, valor: string|null}}>
     */
    private array $previo = [];

    protected function setUp(): void
    {
        parent::setUp();

        foreach (self::CLAVES as $clave) {
            $enProceso = getenv($clave);

            $this->previo[$clave] = [
                'SERVER' => array_key_exists($clave, $_SERVER)
                    ? ['existe' => true, 'valor' => (string) $_SERVER[$clave]]
                    : ['existe' => false, 'valor' => null],
                'ENV' => array_key_exists($clave, $_ENV)
                    ? ['existe' => true, 'valor' => (string) $_ENV[$clave]]
                    : ['existe' => false, 'valor' => null],
                'PUTENV' => $enProceso === false
                    ? ['existe' => false, 'valor' => null]
                    : ['existe' => true, 'valor' => (string) $enProceso],
            ];
        }
    }

    protected function tearDown(): void
    {
        foreach (self::CLAVES as $clave) {
            foreach (['SERVER', 'ENV', 'PUTENV'] as $origen) {
                $estado = $this->previo[$clave][$origen];

                if ($estado['existe']) {
                    $this->fijar($clave, $estado['valor'], $origen);
                } else {
                    $this->borrar($clave, $origen);
                }
            }
        }

        parent::tearDown();
    }

    public function test_acepta_un_entorno_coherente_en_las_tres_fuentes(): void
    {
        $this->fijarTodas('APP_ENV', 'testing');
        $this->fijarTodas('DB_CONNECTION', 'sqlite');
        $this->fijarTodas('DB_DATABASE', ':memory:');
        $this->fijarTodas('DB_URL', '');
        $this->fijarTodas('CACHE_STORE', 'array');
        $this->fijarTodas('SESSION_DRIVER', 'array');
        $this->fijarTodas('MAIL_MAILER', 'array');
        $this->fijarTodas('QUEUE_CONNECTION', 'sync');

        GuardiaEntorno::exigirEntornoAislado();

        $this->assertSame(':memory:', GuardiaEntorno::valorEfectivo('DB_DATABASE'));
        $this->assertSame('sqlite', GuardiaEntorno::valorEfectivo('DB_CONNECTION'));
    }

    public function test_acepta_db_url_ausente_en_todas_las_fuentes(): void
    {
        $this->entornoCompletoSeguro();
        foreach (['SERVER', 'ENV', 'PUTENV'] as $origen) {
            $this->borrar('DB_URL', $origen);
        }

        GuardiaEntorno::exigirEntornoAislado();

        $this->assertNull(GuardiaEntorno::valorEfectivo('DB_URL'));
    }

    public function test_rechaza_conflicto_entre_env_seguro_y_server_no_permitido(): void
    {
        $this->entornoCompletoSeguro();
        $this->fijar('DB_CONNECTION', 'sqlite', 'ENV');
        $this->fijar('DB_CONNECTION', 'sqlite', 'PUTENV');
        $this->fijar('DB_CONNECTION', 'mysql', 'SERVER');

        try {
            GuardiaEntorno::exigirEntornoAislado();
            $this->fail('La guardia debio abortar por fuentes contradictorias.');
        } catch (RuntimeException $e) {
            $this->assertStringContainsString('antes del arranque', $e->getMessage());
            $this->assertStringContainsString('conflicto', $e->getMessage());
            $this->assertStringContainsString('DB_CONNECTION', $e->getMessage());
        }
    }

    public function test_rechaza_el_valor_efectivo_de_server_sin_conflicto_de_fuentes(): void
    {
        $this->entornoCompletoSeguro();
        $this->fijar('DB_CONNECTION', 'mysql', 'SERVER');
        $this->borrar('DB_CONNECTION', 'ENV');
        $this->borrar('DB_CONNECTION', 'PUTENV');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('/DB_CONNECTION/');

        GuardiaEntorno::exigirEntornoAislado();
    }

    public function test_rechaza_db_url_sin_revelarla(): void
    {
        $this->entornoCompletoSeguro();
        $url = 'mysql://usuario_ficticio:clave_ficticia@127.0.0.1/base_ficticia';
        $this->fijarTodas('DB_URL', $url);

        try {
            GuardiaEntorno::exigirEntornoAislado();
            $this->fail('La guardia debio abortar con una URL de conexion configurada.');
        } catch (RuntimeException $e) {
            $this->assertStringContainsString('DB_URL', $e->getMessage());
            $this->assertStringNotContainsString('clave_ficticia', $e->getMessage());
            $this->assertStringNotContainsString('mysql://', $e->getMessage());
        }
    }

    public function test_rechaza_sqlite_apuntando_a_un_archivo_sin_mostrar_la_ruta(): void
    {
        $this->entornoCompletoSeguro();
        $ruta = 'C:\\datos\\base_no_autorizada.sqlite';
        $this->fijarTodas('DB_DATABASE', $ruta);

        try {
            GuardiaEntorno::exigirEntornoAislado();
            $this->fail('La guardia debio abortar con una base SQLite en archivo.');
        } catch (RuntimeException $e) {
            $this->assertStringContainsString('DB_DATABASE', $e->getMessage());
            $this->assertStringNotContainsString('base_no_autorizada', $e->getMessage());
        }
    }

    public function test_rechaza_un_entorno_sin_declarar(): void
    {
        foreach (self::CLAVES as $clave) {
            foreach (['SERVER', 'ENV', 'PUTENV'] as $origen) {
                $this->borrar($clave, $origen);
            }
        }

        $this->expectException(RuntimeException::class);

        GuardiaEntorno::exigirEntornoAislado();
    }

    private function entornoCompletoSeguro(): void
    {
        $this->fijarTodas('APP_ENV', 'testing');
        $this->fijarTodas('DB_CONNECTION', 'sqlite');
        $this->fijarTodas('DB_DATABASE', ':memory:');
        $this->fijarTodas('DB_URL', '');
        $this->fijarTodas('CACHE_STORE', 'array');
        $this->fijarTodas('SESSION_DRIVER', 'array');
        $this->fijarTodas('MAIL_MAILER', 'array');
        $this->fijarTodas('QUEUE_CONNECTION', 'sync');
    }

    private function fijarTodas(string $clave, string $valor): void
    {
        foreach (['SERVER', 'ENV', 'PUTENV'] as $origen) {
            $this->fijar($clave, $valor, $origen);
        }
    }

    private function fijar(string $clave, string $valor, string $origen): void
    {
        if ($origen === 'SERVER') {
            $_SERVER[$clave] = $valor;
        } elseif ($origen === 'ENV') {
            $_ENV[$clave] = $valor;
        } else {
            putenv("{$clave}={$valor}");
        }
    }

    private function borrar(string $clave, string $origen): void
    {
        if ($origen === 'SERVER') {
            unset($_SERVER[$clave]);
        } elseif ($origen === 'ENV') {
            unset($_ENV[$clave]);
        } else {
            putenv($clave);
        }
    }
}
