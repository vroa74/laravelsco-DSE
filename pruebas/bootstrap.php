<?php

declare(strict_types=1);

namespace Pruebas;

use RuntimeException;

/**
 * Guardia previa al arranque de Laravel para la suite de /pruebas.
 *
 * Se evalua antes de parent::createApplication(), es decir, antes de registrar
 * proveedores de servicio y antes de que cualquier conexion pueda abrirse.
 *
 * Orden de fuentes que usa el repositorio efectivo de Laravel:
 * vendor/vlucas/phpdotenv/src/Repository/RepositoryBuilder.php declara
 * ServerConstAdapter antes de EnvConstAdapter, e Illuminate/Support/Env.php
 * agrega PutenvAdapter despues; por tanto $_SERVER tiene prioridad sobre
 * $_ENV y esta sobre getenv()/putenv(). PHPUnit escribe putenv y $_ENV, pero
 * no $_SERVER (vendor/phpunit/phpunit/src/TextUI/Configuration/PhpHandler.php),
 * de modo que un valor heredado en $_SERVER puede prevalecer en Laravel.
 *
 * Para no aceptar una configuracion que Laravel no usaria, la guardia aborta
 * si dos fuentes definidas se contradicen (fail-closed) y valida ademas el
 * valor efectivo con la prioridad real de Laravel. No reescribe el entorno.
 */
final class GuardiaEntorno
{
    /**
     * Valores exigidos por clave. El tercer elemento indica si el valor puede
     * mostrarse en el mensaje de error; nunca se muestran rutas ni URLs.
     *
     * @var array<string, array{0: string, 1: bool}>
     */
    private const EXIGIDOS = [
        'APP_ENV' => ['testing', true],
        'DB_CONNECTION' => ['sqlite', true],
        'DB_DATABASE' => [':memory:', false],
        'DB_URL' => ['', false],
        'CACHE_STORE' => ['array', true],
        'SESSION_DRIVER' => ['array', true],
        'MAIL_MAILER' => ['array', true],
        'QUEUE_CONNECTION' => ['sync', true],
    ];

    /**
     * Aborta si el entorno no garantiza una base de datos aislada en memoria.
     */
    public static function exigirEntornoAislado(): void
    {
        $problemas = [];

        $cache = dirname(__DIR__).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'config.php';

        if (is_file($cache)) {
            $problemas[] = 'existe bootstrap/cache/config.php: la configuracion cacheada puede ignorar el entorno forzado de pruebas';
        }

        foreach (array_keys(self::EXIGIDOS) as $clave) {
            $problemas = array_merge($problemas, self::problemasDeClave($clave));
        }

        if ($problemas !== []) {
            throw new RuntimeException(
                'Prueba abortada antes del arranque, sin crear aplicacion ni abrir conexiones: '
                .implode('; ', $problemas).'.'
            );
        }
    }

    /**
     * Valores definidos por fuente para una clave, sin credenciales.
     *
     * @return array{SERVER: string|null, ENV: string|null, PUTENV: string|null}
     */
    public static function fuentes(string $clave): array
    {
        $servidor = isset($_SERVER[$clave]) ? (string) $_SERVER[$clave] : null;
        $entorno = isset($_ENV[$clave]) ? (string) $_ENV[$clave] : null;
        $proceso = getenv($clave);
        $putenv = $proceso === false ? null : (string) $proceso;

        return [
            'SERVER' => $servidor,
            'ENV' => $entorno,
            'PUTENV' => $putenv,
        ];
    }

    /**
     * Valor que Laravel usaria realmente: $_SERVER, luego $_ENV, luego putenv.
     */
    public static function valorEfectivo(string $clave): ?string
    {
        $fuentes = self::fuentes($clave);

        return $fuentes['SERVER'] ?? $fuentes['ENV'] ?? $fuentes['PUTENV'];
    }

    /**
     * @return list<string>
     */
    private static function problemasDeClave(string $clave): array
    {
        [$esperado, $visible] = self::EXIGIDOS[$clave];
        $problemas = [];
        $fuentes = self::fuentes($clave);

        // DB_URL vacia y DB_URL ausente son equivalentes: ambas significan sin URL.
        $normalizadas = [];
        foreach ($fuentes as $origen => $valor) {
            $normalizadas[$origen] = ($clave === 'DB_URL' && $valor === '') ? null : $valor;
        }

        $definidas = array_filter($normalizadas, static fn (?string $valor): bool => $valor !== null);

        if (count(array_unique($definidas)) > 1) {
            $origenes = array_keys($definidas);
            sort($origenes);
            $efectivo = $normalizadas['SERVER'] ?? $normalizadas['ENV'] ?? $normalizadas['PUTENV'];
            $problemas[] = "conflicto entre fuentes para {$clave} (".implode(' y ', $origenes).'); '
                .($visible
                    ? 'Laravel usaria "'.self::describir($efectivo).'"'
                    : 'Laravel usaria un valor distinto de "'.$esperado.'" y no se muestra por seguridad');

            return $problemas;
        }

        $efectivo = $normalizadas['SERVER'] ?? $normalizadas['ENV'] ?? $normalizadas['PUTENV'];
        $efectivo = $clave === 'DB_URL' ? ($efectivo ?? '') : $efectivo;

        if ($efectivo !== $esperado) {
            $problemas[] = $visible
                ? "{$clave} debe ser \"{$esperado}\"; valor efectivo recibido: ".self::describir($efectivo)
                : "{$clave} debe ser \"{$esperado}\"; el valor efectivo no coincide y no se muestra por seguridad";
        }

        return $problemas;
    }

    private static function describir(?string $valor): string
    {
        if ($valor === null || $valor === '') {
            return '(sin definir)';
        }

        return $valor;
    }
}

/*
 * Modo de comprobacion aislada de la guardia, sin cargar vendor/autoload ni
 * instanciar Laravel. Se usa para verificar el rechazo temprano de la propia
 * guardia; el recorrido real de TestCase::createApplication se cubre en
 * pruebas/arranque-forzado.php.
 */
if (PHP_SAPI === 'cli'
    && isset($_SERVER['SCRIPT_FILENAME'])
    && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__
    && in_array('--verificar-guardia', $_SERVER['argv'] ?? [], true)
) {
    echo 'LARAVEL_CARGADO=', class_exists('Illuminate\Foundation\Application', false) ? 'si' : 'no', PHP_EOL;

    try {
        GuardiaEntorno::exigirEntornoAislado();
        echo 'GUARDIA=ACEPTA', PHP_EOL;

        exit(0);
    } catch (RuntimeException $e) {
        echo 'GUARDIA=ABORTA', PHP_EOL;
        echo 'MENSAJE=', $e->getMessage(), PHP_EOL;

        exit(0);
    }
}
