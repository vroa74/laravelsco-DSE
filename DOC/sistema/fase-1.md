# Fase 1: arquitectura y preparación de pruebas

Fecha: 12/11/2026. Estado: fase 1 de preparación técnica cerrada. F1.1/F1.2 documentadas y revisadas; F1.3 implementada y verificada. El stack objetivo y el esquema nuevo todavía no están instalados/aplicados.

## F1.3: primera entrega recibida

- DeepSeek modificó phpunit.xml y tests/TestCase.php, y creó pruebas/bootstrap.php, pruebas/Feature/GuardiaEntornoPruebasTest.php, pruebas/Unit/GuardiaEntornoTest.php y pruebas/evidencias/fase-1/verificacion-f1.3.txt.
- Reporta 10 pruebas correctas y 56 aserciones con Pest y PHPUnit, sintaxis PHP correcta y Pint aplicado. Son resultados del desarrollador, no aceptación del coordinador.
- Duración comunicada de la tarea: 4 min 42 s (13:02:46–13:07:28). El archivo de evidencia termina antes y recoge 4 min 28 s; esa diferencia de cierre no es una medición de toda la fase. Tokens/costo no disponibles.
- El coordinador revisó código, diferencias y la evidencia. No arrancó pruebas de aplicación durante esta revisión.

## Historial de correcciones exigidas y resueltas

- pruebas/bootstrap.php prioriza $_ENV antes de $_SERVER/getenv. En las fuentes instaladas, RepositoryBuilder de phpdotenv usa ServerConstAdapter antes de EnvConstAdapter; Illuminate/Support/Env añade PutenvAdapter después. La guardia debe rechazar valores contradictorios o garantizar la misma lectura efectiva antes del arranque, sin reescribir silenciosamente el entorno.
- Debe existir una prueba de regresión sin conexión que simule $_ENV permitido y $_SERVER no permitido, y demuestre el rechazo previo al arranque. DB_URL nunca debe imprimirse; evitar mostrar valores privados de otras variables.
- La prueba de orden basada en buscar cadenas de código no sustituye una comprobación conductual del arranque real. Un texto fijo CONEXION_ABIERTA=no no es por sí solo una medición de conexiones; se requiere evidencia del flujo anterior al bootstrap.
- Las pruebas Unit deben guardar/restaurar por separado $_ENV, $_SERVER y getenv, preservando ausencia y valores originales para no contaminar otras pruebas.
- Revisar el aislamiento forzado de sesión, caché, correo y cola en phpunit.xml. Mantener la guardia posterior actual y el bloqueo por config.php cacheado; no tocar .env ni limpiar cachés.

## Resto de la fase

- F1.1: contrato físico del primer recorrido y registro único de migraciones revisados en [diccionario](diccionario-primer-recorrido.md); el mapeo completo del origen continúa en el plan. No se ejecutó DDL.
- F1.2: combinación objetivo, consumidores y orden de transición revisados en [matriz](compatibilidad-y-transicion.md). Resolver dependencias y comprobar el build corresponde a la implementación posterior; no se declara compatibilidad integral.
- Diseño: el actual admite mejoras estéticas; no alterar funcionalidad ni flujos por decisiones visuales. Responsive obligatorio en todas las pantallas/estados. No se requiere otra maqueta alternativa.
- F1.3 aceptada para el commit up000045 tras revisión y regresión. Las modificaciones previas de AGENTS.md, my_proyect.md y los archivos privados/locales se conservan fuera de esta entrega de código.


## Revisión final del coordinador

- Revisión de fuentes: guardia previa conserva la posterior, rechaza contradicciones entre fuentes y servicios no aislados, y oculta rutas/URLs. Las pruebas restauran cada fuente por separado.
- El fixture negativo usa PHP_BINARY -n y comprueba ausencia de pdo_mysql/mysqli antes de llamar al createApplication real. El coordinador observó el aborto antes del contenedor/bootstrap/gestor de BD; no se interpreta un marcador fijo como un conteo real de conexiones.
- Pint con --dirty --format agent: passed.
- Regresión completa: php artisan test --compact --cache-directory=pruebas/.cache/phpunit; 62 passed, 8 skipped, 163 assertions, 74.27 s. Registro: pruebas/evidencias/fase-1/regresion-coordinador.txt.
- Preparación: entorno testing, SQLite :memory:, URL vacía, sesión/caché/correo en array y cola sync; vistas, caché de PHPUnit y manifiestos temporales bajo /pruebas. No se modificó .env ni se accedió a MySQL.
- Primer intento de regresión del coordinador: se detuvo por una ruta temporal de caché absoluta de Windows, no por una prueba fallida. Se revisó normalizeCachePath de Laravel, se usaron rutas relativas al proyecto y se repitió la regresión completa con resultado correcto.
- Sin frontend de producto modificado: no corresponde build. La maqueta alternativa y sus imágenes no se incluyen en el commit de F1.3.
- F1.1 corregida y documentada: Cos aún tiene tres consumidores en User.php (relaciones en líneas 124, 132 y 140). Co será canónico; Cos se conserva hasta migrarlos.
- F1.2: el coordinador confirmó en manifiestos oficiales que inertia-laravel 3.x admite Laravel 11.35/12/13; vite-plugin-svelte 7.3.1 declara Svelte >=5.46.4 y Vite 8; @inertiajs/svelte 3.x declara Svelte 5; @tailwindcss/vite 4.x declara Vite 5.2/6/7/8. Son restricciones declaradas, no una instalación o compilación comprobada.
- Fuentes técnicas: https://raw.githubusercontent.com/inertiajs/inertia-laravel/3.x/composer.json ; https://raw.githubusercontent.com/sveltejs/vite-plugin-svelte/main/packages/vite-plugin-svelte/package.json ; https://raw.githubusercontent.com/inertiajs/inertia/3.x/packages/svelte/package.json ; https://raw.githubusercontent.com/tailwindlabs/tailwindcss/main/packages/@tailwindcss-vite/package.json .
- Validación futura del stack: resolución de dependencias, adaptaciones de Tailwind/Flowbite/WireUI y build bajo paridad visual/funcional; no se hizo instalación ni se afirmó compatibilidad integral.

## Cierre de preparación y reglas nuevas

- La puerta de fase 1 se cierra como diseño, compatibilidad declarada y preparación de pruebas, no como actualización ya instalada o migración real.
- Reglas expresas incorporadas: cuentas desde los 18 años cumplidos; adjuntos durante 15 días naturales desde publicación, con metadatos/historial permanentes. Ver [reglas funcionales](reglas-funcionales.md).
- F1.3 está registrada en c35dff8, up000045; el cierre documental de F1.1/F1.2 y estas reglas corresponde a up000046.
- No hubo cambios de interfaz: se mantiene el diseño actual, con mejoras estéticas permitidas sin cambiar funcionalidad, y responsive obligatorio.
- Siguiente fase: autorización/autenticación y edad mínima, con migraciones y pruebas exclusivamente sintéticas según el alcance autorizado. No aplicar cambios sobre usuarios reales sin la autorización de datos correspondiente.
- Tiempo técnico consolidado de toda la fase y costo/tokens no medidos; no se declara cumplimiento de dos horas por sumar ventanas parciales del trabajador.
