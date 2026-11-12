**Registro — 12/11/2026, arranque NVIDIA (up000049):** La inferencia y llamada a herramienta funcionaron, pero el primer trabajador falló por compactación. El alias se había limitado a 128000 tokens a partir del catálogo del gateway. Se ajustó únicamente su límite declarado a contexto 262144, entrada 240000 y salida 8192 según la documentación oficial de Nemotron Ultra (contexto nativo 256K; hasta 1M según despliegue), con respaldo SHA-256 y comparación del resto de configuración. No se midió el máximo del endpoint alojado ni se declara resuelto el arranque hasta recibir actividad/informe. Se detuvo con confirmación el intento fallido; reintento de la misma tarea pendiente. DeepSeek backend ya tiene recibo de arranque, todavía sin informe. Sin cambios de producto ni datos.

**Registro — 12/11/2026, límite del gateway NVIDIA (up000050):** El segundo intento confirmó que el rechazo procedía del límite 128000 del gateway, no del alias OpenCode. Se guardó evidencia anterior/posterior sin secretos en pruebas/evidencias/integracion-nvidia y se configuró, mediante la API de administración existente de OmniRoute, una única excepción de contexto 262144 para nvidia/nemotron-3-ultra-550b-a55b, respaldada por documentación oficial. PUT HTTP 200, lectura posterior del override y catálogo /v1/models con contexto 262144 verificados; sin cambios de claves ni otros modelos. Intento fallido detenido con confirmación; siguiente reintento pendiente, no se declara ejecutado el análisis frontend. DeepSeek entregó la matriz de contratos backend en solo lectura. Sin acceso a datos de SCO ni cambios de producto.

**Registro — 12/11/2026, fondo de acceso plateado (up000051):** Por autorización puntual del usuario se aplica solo escudo sin letras, plateado y más grande. resources/views/layouts/guest.blade.php referencia el PNG existente public/media/img/campechecon.png; resources/css/app.css centraliza el fondo, filtro grayscale(100%) brightness(1.35) contrast(1.1), ancho min(94vw,1100px), max-height90svh y object-fit:contain. Conserva opacidad80 y gradientes previos, decoración aria-hidden sin interacción; el original PNG no se edita. Build del trabajador correcto (19.13s); coordinador comprobó CSS compilado, diff check y guardias, y ejecutó regresión sintética SQLite en memoria: 22 pruebas, 45 aserciones, 87.54s. Evidencia y vista previa estática en /pruebas. Pendiente revisión renderizada/móvil y aceptación estética; no equivale a estandarización general. Se integra únicamente el PNG consumido, sin otros archivos nuevos/modificados del usuario. Sin MySQL, backend ni dependencias modificados en esta entrega.

**Registro — 12/11/2026, pausa expresa del usuario (up000053):** Se avisa y detiene la tarea de homogeneización global `task_8d50282dc798` / `ctx_af5970bf42a6`; Orca confirma stopped/closed_agent_terminal. Se conserva el estado local de resources en pruebas/reanudacion/20261112-175516, sin revertir ni commitear producto inconcluso. DOC/sistema/reanudacion.md recoge objetivo, estado, pendientes y pasos de reintento del mismo Task. No se deja ejecución remota ni se traslada el proyecto. Pausa solicitada por el usuario; sin build/pruebas adicionales ni acceso a datos. Estandarización global NO terminada; esperar instrucción de reanudar.

## Superficies translúcidas en todas las páginas — 12/11/2026

- Aclaración expresa del usuario, con captura de `/dashboard`: el escudo plateado, grande y sin letras debe verse como fondo detrás del contenido en todas las páginas, no solo en acceso. Usar `public/media/img/campechecon.png`, sin alterar el PNG original.
- Paneles principales, vistas y contenedores de tablas usan **80% de opacidad del color de fondo** (alfa0.8). Texto, iconos, controles y contenido permanecen al100%. Prohibido aplicar `opacity:0.8` a todo el contenedor y desvanecer sus descendientes.
- Una sola superficie translúcida por panel principal; evitar capas opacas o fondos semitransparentes anidados que acumulen opacidad y oculten el escudo. Las celdas/filas y envoltorios internos se armonizan con el panel común sin eliminar etiquetas, selección, errores ni jerarquía de tabla.
- Definir pares de superficie/texto para claro y oscuro y medir contraste contra la composición real con el escudo, no solo contra un fondo plano. Mantener como mínimo4.5:1 para texto normal,3:1 para grande y elementos aplicables; preservar foco, teclado y objetivos táctiles.
- Aplicar mediante componentes/tokens compartidos al contenido principal de dashboard, correspondencia, directorio, usuarios, grupos, catálogos y demás vistas. Conservar navegación, formularios, validación y acciones. No introducir selector/persistencia de tema ni migrar el frontend por este cambio de presentación. Responsive móvil/tableta/escritorio, sin desplazamiento lateral ni recorte de información.
- El fondo debe ser decorativo, sin capturar eventos ni aparecer en el árbol accesible. No extender este tratamiento a PDF o correo de servidor por inferencia.

**Registro — 12/11/2026, alcance visual global (up000052):** Se documenta la aclaración del usuario en AGENTS.md y DOC/sistema/estandar-visual.md y se registra en README.md. El fondo de acceso está implementado en up000051; el fondo global, superficies alfa0.8 y homogeneización general siguen pendientes de implementación y revisión. Validación de esta entrega solo documental; sin código, datos o dependencias modificados.

## Reparto de trabajo NVIDIA/DeepSeek — 12/11/2026

- Por instrucción expresa del usuario, el frontend y sus detalles visuales se asignan a NVIDIA NIM mediante OmniRoute; el backend a DeepSeek mediante OmniRoute. El coordinador conserva arquitectura, revisión, documentación, seguridad, costos e integración. Esta distribución sustituye la atribución anterior de todo desarrollo a DeepSeek; no cambia los límites de datos ni la prioridad visual.
- Modelo frontend comprobado: `nvidia/nvidia/nemotron-3-ultra-550b-a55b`; alias compartido de OpenCode `omniroute/frontend-nvidia-ultra`. Modelo backend existente: `omniroute/deepseek-v4.1-flash-1017`. No afirmar ejecución del trabajador por una prueba de inferencia ni actividad por haber enviado un mensaje.
- Primero entregar diagnóstico y estándar visual contra `/agen` antes de implementar. Mientras tanto, el backend revisa contratos y compatibilidad con la UI en solo lectura; no adelanta correcciones funcionales. No modificar archivos compartidos simultáneamente.
- **Registro de validación:** metadatos técnicos de OmniRoute leídos sin cuerpos de conversación; prueba autenticada del modelo NVIDIA con HTTP 200 y llamada `report_ready`. Se agregó un único alias a la configuración compartida de OpenCode, con respaldo SHA-256 comprobado y comparación del resto de la configuración sin cambios. Sin claves expuestas ni configuración de SCO modificada. La ruta sirve a trabajadores OpenCode/Orca y su CLI; no equivale a cambiar el modelo coordinador ni a configurar o probar NVIDIA en Codex Desktop/CLI. No se incorporó MCP, plugin ni skill nuevos.
- **Pendientes:** recepción de informes, revisión del coordinador y aplicación/verificación visual. Tres asignaciones visuales anteriores detenidas con confirmación para consolidar el trabajo, sin revertir sus archivos locales. Esta actualización documental se registra en `README.md` §15 como up000048; sin pruebas de aplicación, MySQL ni cambios de producto.

## Prioridad y estándar visual obligatorio — 12/11/2026

- **Prioridad expresa del usuario:** realizar primero la homogeneización visual y sus reglas; posponer nuevas correcciones funcionales. Los parches RG/grupos ya recibidos permanecen pendientes de revisión e integración; esta instrucción no autoriza revertirlos ni mezclarlos con la entrega visual.
- **Fuente única:** todos los CRUD y pantallas siguen [DOC/sistema/estandar-visual.md](DOC/sistema/estandar-visual.md). `/agen` es la referencia aprobada. Conservar navegación, información, acciones y flujos existentes; uniformar presentación sin introducir funciones por iniciativa estética.
- **Colores y contraste:** definir pares compartidos de fondo/texto para claro y oscuro. Fondo claro con texto oscuro y fondo oscuro con texto claro; verificar valores, etiquetas, opciones, placeholder, autofill, errores, foco y hover. Contraste mínimo de 4.5:1 para texto normal y 3:1 para texto grande y elementos no textuales aplicables. Prohibido combinar fondo oscuro con texto negro fijo o depender de una herencia sin verificarla.
- **Medidas comunes:** mismos tamaños y variantes por función para inputs, botones, iconos, tablas, imágenes, paneles y diálogos. Mismo significado implica misma apariencia en cualquier sección. Reutilizar componentes/tokens; no definir una paleta ni copiar clases contradictorias por CRUD.
- **Responsive y temas:** aplicar el estándar en móvil, tableta y escritorio, en claro y oscuro y en todos los estados. Ajustar contenido sin desplazamiento horizontal ni recorte de información; no usar ocultación global del desborde como prueba de cumplimiento.
- **Equipo de diseño permanente:** Taste (`design-taste-frontend`) dirige identidad y criterio estético; `ui-ux-pro-max` fundamenta tokens, medidas y accesibilidad; `impeccable` audita consistencia, contraste y acabado. Leer el SKILL.md aplicable, identificar su versión y registrar instrucciones aplicadas y herramientas realmente ejecutadas. Las preferencias del usuario y el stack real prevalecen sobre defaults incompatibles de una skill.
- **Skills/plugins:** comprobar disponibilidad y capacidades reales. Estas tres referencias son skills: no afirmar que son plugins instalados. No instalar dependencias, activar hooks ni modificar configuración por inferencia. Toda incorporación autorizada conserva descubrimiento compatible en Codex Desktop y CLI, con verificación de ambas interfaces y límites expresos.
- **Aceptación:** el análisis visual y su informe preceden a implementar el estándar. Antes de anunciar uniformidad, verificar render, contraste y teclado en ambos temas y los tres tamaños, incluidos vacío, carga, error y deshabilitado. Una lectura de código, build o prueba de cadenas no acredita revisión visual.

**Registro — 12/11/2026, normativa visual (up000047):** Se incorporan esta prioridad y reglas, se crea DOC/sistema/estandar-visual.md y se enlaza en README.md §15. Motivo: unificar apariencia entre CRUD antes de continuar correcciones. Validación documental y enlaces locales; sin cambios de interfaz, datos, plugins ni configuración en esta entrega. Pendientes: informe de diseño, aplicación y verificación visual del estándar; foto de usuario y cierre de parches RG/grupos aplazados.

<laravel-boost-guidelines>
=== reglas base ===

# Pruebas y archivos de pruebas
Todos los archivos generados para las pruebas estaran ubicados en
la carpeta /pruebas si execpcion.

# Commits y bitácora (regla obligatoria)

- Toda modificación terminada que sume **más de 10 líneas** (altas + bajas) se cierra con un commit inmediato, sin esperar a que el usuario lo pida.
- El mensaje sigue la serie existente: `upNNNNNN - Título corto en español` con el **siguiente consecutivo** (`up000042`, `up000043`, …). El cuerpo enumera los cambios generados: archivos o grupos tocados y el efecto de cada uno.
- El mismo cambio se registra en `README.md` §15 con una subsección `### Título ("upNNNNNN")`, una tabla `Archivo | Cambio` y la línea **Validación**; así queda documentado el post al que pertenece el commit.
- Antes de commitear: `vendor/bin/pint --dirty --format agent`, `npm run build` si hubo cambios de frontend y `php artisan test --compact`.
- Nunca se incluyen en el commit `public/build`, `.env`, credenciales, respaldos `sql/` ni la carpeta `.agents/` sin autorización.

# Guía de Laravel Boost

Las directrices de Laravel Boost están especialmente curadas por los mantenedores de Laravel para esta aplicación. Estas reglas deben seguirse de cerca para asegurar la mejor experiencia al construir aplicaciones Laravel.

## Contexto fundamental

Esta aplicación es un proyecto Laravel y los principales paquetes del ecosistema con sus versiones están listados a continuación. Eres un experto en todos ellos. Asegúrate de cumplir con estos paquetes y versiones específicos.

- php - 8.5 (Composer fija `config.platform.php` en 8.4.0)
- laravel/framework (LARAVEL) - v12
- laravel/jetstream (JETSTREAM) - v5
- laravel/fortify (FORTIFY) - v1
- laravel/sanctum (SANCTUM) - v4
- livewire/livewire (LIVEWIRE) - v3
- laravel/prompts (PROMPTS) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v3
- vite - v8

## Techo de versiones verificado

Estas son las versiones máximas que la aplicación admite hoy sin romper el código; no las subas por encima sin resolver antes el bloqueo indicado.

- **Laravel 12** es el límite: `laravel/jetstream` 5.5 exige `illuminate/support ^11.0|^12.0`, por lo que Laravel 13 falla al resolver dependencias.
- **Livewire 3** es el límite: Jetstream 5.5 exige `livewire/livewire ^3.3` y WireUI 2.6 exige `^3.6`.
- **Tailwind 3** es el límite: `wireui/wireui` aporta el preset de Tailwind v3 en `tailwind.config.js` y `flowbite` 2 usa el plugin de v3.
- **Flowbite 2** es el límite: `flowbite` 4 depende de `tailwindcss ^4.1`, lo que obliga a migrar el preset de WireUI y revisar todos los estilos.
- `endroid/qr-code` se mantiene en 6.1 porque la rama 6.2 exige PHP `^8.5` y la plataforma de Composer es 8.4.

## Activación de habilidades

Este proyecto tiene habilidades específicas de dominio disponibles en `**/skills/**`. DEBES activar la habilidad relevante siempre que trabajes en ese dominio; no esperes hasta estar atascado.

## Convenciones

- Debes seguir todas las convenciones de código existentes usadas en esta aplicación. Al crear o editar un archivo, revisa archivos hermanos para la estructura, el enfoque y la nomenclatura correctos.
- Todas las rutas, adiciones, anexiones y modificaciones deben seguir la guía de estilo observada en el proyecto.
- Usa nombres descriptivos para variables y métodos. Por ejemplo, `isRegisteredForDiscounts`, no `discount()`.
- Revisa si ya existe un componente reutilizable antes de escribir uno nuevo.
- Cuando se solicite una modificación de una ruta o de una acción específica, realiza únicamente esa acción solicitada y verifica que no repercuta en las demás acciones de esa misma ruta ni en ninguna otra ruta.
- Todas las vistas deben estar escritas en español.

## Guía de estilo del proyecto

- Idioma: todo texto visible en interfaz (títulos, etiquetas, mensajes, botones, validaciones y ayudas) debe estar en español.
- Rutas: usa rutas con nombre y `route()` para generar enlaces; conserva la convención actual de recursos y alias de nombres existentes.
- Controladores: mantén clases en `App\Http\Controllers` con sufijo `Controller` y nombres en PascalCase.
- Livewire: organiza componentes por dominio y acción (por ejemplo `App\Livewire\Service\Index`), con propiedades en camelCase y bindings `wire:model.live` cuando se requiera filtrado en tiempo real.
- Modelos y base de datos: respeta los nombres de columnas heredadas existentes (incluyendo `snake_case` y campos legacy como `id_s`, `F_serv`), sin renombrar campos salvo solicitud explícita.
- Blade: prioriza componentes reutilizables (`x-...`) antes de duplicar bloques; conserva estructuras existentes de layout y slots.
- Estilos: usa Tailwind CSS como primera opción, manteniendo coherencia visual con la paleta y patrones ya presentes en cada módulo.
- Coherencia visual: conserva el mismo estilo visual en todo el proyecto; reutiliza los patrones existentes en lugar de inventar variantes.
- Sin desplazamiento lateral (regla obligatoria): ninguna vista debe desplazarse en horizontal; solo se permite desplazamiento vertical. Prohibido `overflow-x-auto`, `overflow-x-scroll` y anchos mínimos fijos como `min-w-[960px]`. Las tablas de datos usan la clase `tabla-apilada` (definida en `resources/css/app.css`): en móvil cada fila se muestra como tarjeta con etiqueta `data-label` y desde 768px vuelve a ser tabla normal. Usa anchos fijos solo con prefijo responsive (`md:w-40`), nunca en móvil.
- Campos de contraseña: todo input de contraseña debe incluir el botón de mostrar/ocultar con el estilo del login (icono de ojo SVG, `text-gray-400 hover:text-gray-600`, posicionado a la derecha). En Livewire/Blade usa el componente `<x-password-toggle-button />` dentro de un contenedor `relative` con `x-data="{ show: false }"` y `x-bind:type="show ? 'text' : 'password'"` en el input.
- Mensajes de sesión: conserva claves estándar observadas (`message`, `error`) y textos claros en español.
- Comentarios: usa comentarios breves y útiles, preferentemente en español, solo cuando aporten contexto no obvio.
- El diseño de esta web ap debe ser responsivo.

## Scripts de verificación

- No crees scripts de verificación ni uses tinker cuando las pruebas cubran esa funcionalidad y demuestren que funciona. Las pruebas unitarias y de características son más importantes.

## Protección de los datos de la base de datos (PRIORIDAD MÁXIMA)

- Protege los datos de la base de datos a toda costa; esta regla prevalece sobre cualquier otra.
- **Está prohibido tocar la base de datos (leer, escribir, migrar, sembrar, consultar o ejecutar pruebas que la usen) a menos que el usuario lo pida expresamente en ese mensaje.** Una petición de código, vistas o pruebas no cuenta como autorización.
- Antes de ejecutar cualquier prueba, verifica que `phpunit.xml` fuerce `DB_CONNECTION=sqlite` y `DB_DATABASE=:memory:` y que `tests/TestCase.php` conserve su guardia que aborta si la conexión no es SQLite en memoria. Nunca quites ni debilites esas protecciones.
- Si `bootstrap/cache/config.php` existe, la configuración en caché puede ignorar `phpunit.xml`; si la guardia aborta una prueba, pregunta al usuario antes de ejecutar `php artisan config:clear`.
- `AppServiceProvider` bloquea los comandos destructivos de Artisan (`migrate:fresh`, `migrate:refresh`, `migrate:reset`, `db:wipe`) fuera de las pruebas; no lo desactives ni lo evites con `--force` u otros rodeos.
- Nunca ejecutes comandos destructivos contra la base de datos real: `migrate:fresh`, `migrate:refresh`, `migrate:reset`, `db:wipe`, `db:seed` sobre datos existentes, `DROP`, `TRUNCATE` ni `DELETE`/`UPDATE` masivos o sin `WHERE`.
- No modifiques ni borres usuarios, servicios, inventarios u otros registros existentes sin aprobación explícita del usuario.
- Antes de cualquier cambio de datos o esquema autorizado, haz un respaldo y avisa al usuario.
- Usa solo consultas de solo lectura por defecto, y solo cuando el usuario las haya pedido expresamente.
- Las pruebas deben correr únicamente con la base de datos de pruebas (SQLite `:memory:` de `phpunit.xml`), nunca con `RefreshDatabase` apuntando a MySQL real.
- No restaures ni sobrescribas respaldos (`sql/`) sin confirmación explícita.
- No cambies las credenciales ni la conexión de base de datos en `.env`.

## Estructura y arquitectura de la aplicación

- Mantente en la estructura de directorios existente; no crees nuevas carpetas base sin aprobación.
- No cambies las dependencias de la aplicación sin aprobación.

## Empaquetado de frontend

- Si el usuario no ve un cambio de frontend reflejado en la interfaz, puede significar que necesita ejecutar `npm run build`, `npm run dev` o `composer run dev`. Pregúntale.

## Archivos de documentación

- Solo debes crear archivos de documentación si el usuario lo solicita explícitamente.

## Respuestas

- Sé conciso en tus explicaciones: enfócate en lo importante en lugar de explicar detalles obvios.

=== reglas boost ===

# Laravel Boost

## Herramientas

- Laravel Boost es un servidor MCP con herramientas diseñadas específicamente para esta aplicación. Prefiere las herramientas de Boost sobre alternativas manuales como comandos de shell o lectura de archivos.
- Usa `database-query` para ejecutar consultas de solo lectura en la base de datos en lugar de escribir SQL crudo en tinker.
- Usa `database-schema` para inspeccionar la estructura de tablas antes de escribir migraciones o modelos.
- Usa `get-absolute-url` para resolver el esquema, dominio y puerto correctos de las URLs del proyecto. Siempre úsalo antes de compartir una URL con el usuario.
- Usa `browser-logs` para leer registros del navegador, errores y excepciones. Solo los registros recientes son útiles; ignora las entradas antiguas.

## Búsqueda de documentación (IMPORTANTE)

- Siempre usa `search-docs` antes de hacer cambios en el código. No omitas este paso. Devuelve documentación específica de la versión basada en los paquetes instalados.
- Pasa un arreglo `packages` para limitar los resultados cuando sepas qué paquetes son relevantes.
- Usa múltiples consultas amplias basadas en temas: `['rate limiting', 'routing rate limiting', 'routing']`. Espera que los resultados más relevantes aparezcan primero.
- No agregues nombres de paquetes a las consultas porque la información del paquete ya se comparte. Usa `test resource table`, no `filament 4 test resource table`.

### Sintaxis de búsqueda

1. Usa palabras para lógica AND automática: `rate limit` coincide con "rate" Y "limit".
2. Usa `"frases entre comillas"` para coincidencias exactas de posición: `"infinite scroll"` requiere palabras adyacentes en ese orden.
3. Combina palabras y frases para consultas mixtas: `middleware "rate limit"`.
4. Usa múltiples consultas para lógica OR: `queries=["authentication", "middleware"]`.

## Artisan

- Ejecuta comandos Artisan directamente desde la línea de comandos (por ejemplo, `php artisan route:list`). Usa `php artisan list` para descubrir comandos disponibles y `php artisan [command] --help` para revisar parámetros.
- Inspecciona rutas con `php artisan route:list`. Filtra con: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Lee valores de configuración usando notación de puntos: `php artisan config:show app.name`, `php artisan config:show database.default`. O lee archivos de configuración directamente en el directorio `config/`.

## Tinker

- Ejecuta PHP en el contexto de la aplicación para depuración y pruebas. No crees modelos sin aprobación del usuario; prefiere pruebas con fábricas. Prefiere comandos Artisan existentes en lugar de código tinker personalizado.
- Usa siempre comillas simples para evitar la expansión del shell: `php artisan tinker --execute 'Your::code();'`
  - Usa comillas dobles dentro de las cadenas PHP: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== reglas php ===

# PHP

- Siempre usa llaves `{}` para estructuras de control, incluso en cuerpos de una sola línea.
- Usa promoción de propiedades del constructor de PHP 8: `public function __construct(public GitHub $github) { }`. No dejes métodos `__construct()` vacíos sin parámetros a menos que el constructor sea privado.
- Usa declaraciones de tipo de retorno explícitas y tipos en los parámetros de todos los métodos: `function isAccessible(User $user, ?string $path = null): bool`
- Usa TitleCase para las claves de Enum: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefiere bloques PHPDoc sobre comentarios en línea. Solo agrega comentarios en línea para lógica excepcionalmente compleja.
- Usa definiciones de forma de arreglo (`array shape`) en los PHPDoc.

=== reglas de despliegue ===

# Despliegue

- Laravel se puede desplegar usando [Laravel Cloud](https://cloud.laravel.com/), que es la forma más rápida de desplegar y escalar aplicaciones Laravel.

=== reglas de pruebas ===

# Aplicación de pruebas

- Cada cambio debe ser probado programáticamente. Crea una prueba nueva o actualiza una prueba existente, luego ejecuta las pruebas afectadas para asegurarte de que pasen.
- Ejecuta la menor cantidad de pruebas necesaria para asegurar la calidad y la velocidad. Usa `php artisan test --compact` con un nombre de archivo o filtro específico.

=== reglas laravel/core ===

# Haz las cosas a la manera de Laravel

- Usa los comandos `php artisan make:` para crear nuevos archivos (por ejemplo, migraciones, controladores, modelos, jobs, etc.). Puedes listar los comandos disponibles con `php artisan list` y revisar los parámetros con `php artisan [command] --help`.
- Si vas a crear una clase PHP genérica, usa `php artisan make:class`.
- Pasa `--no-interaction` a todos los comandos Artisan para asegurarte de que no requieran entrada del usuario. También debes pasar las `--options` correctas para asegurar el comportamiento esperado.

### Creación de modelos

- Cuando crees nuevos modelos, crea factories y seeders útiles también. Pregunta al usuario si necesita algo más, usando `php artisan make:model --help`.

## APIs y recursos Eloquent

- Para APIs, usa por defecto recursos Eloquent API y versionado de API a menos que las rutas existentes no lo hagan; en ese caso, sigue la convención actual de la aplicación.

## Generación de URL

- Al generar enlaces a otras páginas, prefiere rutas con nombre y la función `route()`.

## Pruebas

- Al crear modelos para pruebas, usa las factories. Revisa si la factory tiene estados personalizados antes de configurar manualmente el modelo.
- Faker: usa métodos como `$this->faker->word()` o `fake()->randomDigit()`. Sigue las convenciones existentes respecto a si usas `$this->faker` o `fake()`.
- Al crear pruebas, usa `php artisan make:test [options] {name}` para una prueba de características y pasa `--unit` para una prueba unitaria. La mayoría de las pruebas deben ser de características.

## Error de Vite

- Si recibes un error `Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest`, puedes ejecutar `npm run build` o preguntar al usuario que ejecute `npm run dev` o `composer run dev`.

=== reglas livewire/core ===

# Livewire

- Livewire permite construir interfaces dinámicas y reactivas en PHP sin escribir JavaScript.
- Puedes usar Alpine.js para interacciones del lado del cliente en lugar de frameworks JavaScript.
- Mantén el estado en el servidor para que la interfaz refleje los datos. Valida y autoriza en las acciones como lo harías en solicitudes HTTP.

=== reglas pint/core ===

# Formateador Laravel Pint

- Si has modificado archivos PHP, debes ejecutar `vendor/bin/pint --dirty --format agent` antes de finalizar los cambios para asegurar que tu código coincida con el estilo del proyecto.
- No ejecutes `vendor/bin/pint --test --format agent`; simplemente ejecuta `vendor/bin/pint --format agent` para corregir problemas de formato.

=== reglas pest/core ===

## Pest

- Este proyecto usa Pest para pruebas. Crea pruebas con `php artisan make:test --pest {name}`.
- El argumento `{name}` no debe incluir el directorio de la suite de pruebas. Usa `php artisan make:test --pest SomeFeatureTest` en lugar de `php artisan make:test --pest Feature/SomeFeatureTest`.
- Ejecuta pruebas con `php artisan test --compact` o con el filtro `php artisan test --compact --filter=testName`.
- NO elimines pruebas sin aprobación.

## Inventario de componentes, plugins e iconos

- Mantén el inventario visible en `resources/views/componentes/index.blade.php` sincronizado con las dependencias directas de `composer.json` y `package.json`, los componentes Blade de `resources/views/components`, las clases Livewire de `app/Livewire`, las integraciones/plugins frontend y los iconos de las vistas.
- Al agregar, retirar o cambiar una dependencia, componente, plugin o icono, actualiza ese inventario en el mismo cambio. Distingue las dependencias instaladas de las integraciones realmente cargadas y registra las fuentes de los SVG en línea.
- Basa el inventario en archivos fuente del proyecto; no incluyas artefactos generados de `storage/`, archivos compilados de `public/build/` ni código de `vendor/`.

</laravel-boost-guidelines>
