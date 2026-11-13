# Fase2 — identidad, autenticación y permisos

Estado: en curso; no cerrada. Inicio autorizado expresamente por el CEO tras aclarar el cierre visual. Se continúa el plan de my_proyect.md sin ejecutar operaciones sobre datos reales. Preservar diseño aprobado y credenciales.

## Contrato de roles confirmado

| Tipo | Nombre | Alcance decidido |
| --- | --- | --- |
| 0 | Superadministrador | Acceso total; conservar el valor legado por decisión expresa. |
| 1 | Administrador | Administración y operación general. |
| 2 | Supervisor | Capturar/editar/consultar y administrar también usuarios, grupos y catálogos. |
| 3 | Usuario | Solo consultar los oficios que le turnaron; mismo alcance en búsquedas, conteos, detalle, reportes y descargas. |

Estos permisos son contrato de negocio, todavía no aplicación completa acreditada. El tipo2 se llamó Editor en una pregunta del coordinador; el código del formulario dice Supervisor y se conserva ese nombre. Evitar convertir null/desconocido en0. No basar acceso en nombres parecidos ni rem_id ambiguo. La conciliación histórica y las entregas a grupos requieren identidad fiable, preservando originales y dependencias del plan.

## Identidad/perfil — up000066

El alias efectivo de Livewire lo registra Jetstream. Su clase usa el actualizador Fortify y la vista profile/update-profile-information-form; la clase App/Livewire/Profile homónima no es el consumidor efectivo y no se modifica. Se conserva redirección tras cargar foto y los eventos nativos para otras acciones.

- User actualiza archivo/referencia de foto comprobando ambos antes de retirar el anterior. Al quitar foto guarda primero la referencia nula y después retira únicamente una ruta de profile-photos válida.
- Fortify fuerza datos y foto antes de una única escritura de usuario, evitando dos guardados parciales; mantiene validación y verificación de correo existente.
- Lista, detalle, edición y navegación consumen la URL autenticada/versionada del backend previo. El formulario efectivo usa fallback si el archivo falta.
- Diálogos de usuarios reciben títulos/cierres del estándar y no se marcan aria-hidden estando abiertos.

Verificación:27 pruebas/129 aserciones,7.668s; Pint y build8.99s. SQLite :memory:, cache/Storage::fake y temporales bajo /pruebas; BCRYPT_ROUNDS4 únicamente en el proceso sintético. Tests incluyen la ruta efectiva del perfil, redirect, descarga de bytes, HTML con URL correcta, sustitución, fallos de archivo/DB, bajas y fallback. La expectativa inicial de evento saved tras cargar foto fue corregida porque el componente efectivo redirige; no atribuirla como fallo del producto.

Evidencia: pruebas/evidencias/ajustes-20261113/fotos/{perfil-efectivo,reproduccion-perfil,build-perfil}.txt. La aplicación/servidor con datos reales no se verificó. Sin vendor, esquema, dependencias, .env o MySQL modificados.

## Siguiente trabajo de la fase

- F2.1: fronteras de recursos implementadas en up000069; pendientes identidades de entrega históricas/grupos y cierre integral con F4/F5. Matriz confirmada, no volver a preguntar.
- F2.2: implementado y probado en up000068 según el bloque siguiente; validación del servidor real pendiente.
- F2.3: auditoría mínima sin secretos, conservando actor e historia.
- Mantener pendientes de fotos/servidor y PDF visibles; no cerrar fase por una lectura estática o un build.

## Ajuste menor de grupos — up000067

El detalle ya mantiene encabezado, datos y ambos cierres dentro del panel, con texto largo desplazable y cierre accesible. Una prueba/10 aserciones comprueba DOM y closeModal; seis casos offline en ambos temas y375/768/1366 sin desbordes. Build11.69s y Pint. Evidencia: pruebas/evidencias/ajustes-20261113/grupo-detalle. No altera permisos o membresías, no acredita servidor real y no cierra Fase2.

## Autenticación efectiva — up000068

POST/login efectivo es Auth/LoginController@login y login.post apunta a esa URI. El controlador conserva el LoginRequest propio (ahora subtipo de Fortify) y usa el pipeline del paquete para desafío MFA, autenticación y regeneración. El proveedor enlaza el mismo request a Fortify, evitando un recorrido alterno sin RFC. AuthenticateUser verifica email, RFC, contraseña y estado1 explícito; devuelve fallo genérico y utiliza Timebox del framework. No altera cuentas ni formato de RFC.

Se activan los limitadores ya declarados:5/minuto por correo+IP y por desafío+IP, claves SHA-256 sin identidad legible. El middleware web rechaza sesiones inactivas antes del controlador y comprueba de nuevo el estado al completar MFA; invalida sesión/token y limpia la caché del guard actual. No se habilita correo verificado obligatorio ni MFA obligatorio para cuentas sin confirmación existente.

Pruebas:12/102 en5.976s; regresión fotos27/129 y autenticación anterior3/5; Pint limpio. Antes del parche9 fallos reproducidos: cuenta inactiva admitida, MFA omitido, sin throttling/guest, error diferente para contraseña. El acceso indebidamente permitido llegó a una tabla ausente del fixture; ese500 no se presenta como defecto de la base real. Un test posterior se ajustó al destino intended /rg y se corrigió la caché Sanctum tras logout.

Fronteras: credenciales HTTP→LoginRequest/consulta parametrizada/Hash; sesión→estado del usuario; códigos→Fortify sin implementación criptográfica propia. Datos y archivos sintéticos bajo /pruebas, SQLite :memory:; evidencia en pruebas/evidencias/fase-2/autenticacion. Sin MySQL, schema, vendor, .env o servidor real. Esto verifica sesiones web; autorización de recursos, tokens API y auditoría siguen en F2.1/F2.3.

## Fronteras de recursos — up000069

Tipos0/1/2 administran y operan; tipo3 consulta únicamente turnado individual fiable. User::tipoVigente no convierte null, vacío, bool o desconocidos en0. CoPolicy gobierna acciones; Co::visibleTo comparte alcance en las cuatro consultas actuales de lista/conteo/exportaciones, detalle, reportes individuales y archivos. Hasta F4 solo tur_id con tur_type=user acredita destinatario. No se infiere del rem_id roto, textos ni membresía actual; tampoco se hace backfill silencioso. Las capturas actuales aún no pueblan tur_id: cerrar ese contrato y las entregas congeladas es parte de F4; un listado vacío de tipo3 no acredita ausencia de correspondencia histórica.

CheckUserType usa Gate en rutas administrativas; AuthorizesAdministration se ejecuta en montaje y actualización de los componentes, incluida captura/edición de RG. Se conserva el middleware de ruta en actualizaciones Livewire. Los menús y botones ocultan acciones no permitidas; la denegación efectiva está en PHP. UserPolicy impide a un administrador/supervisor convertir una cuenta en tipo0 o alterar/borrar un superadministrador; el tipo0 conserva esa administración.

La descarga canónica /documentos/{documento}/archivos/{archivo} pasa por Controller→Action compartida con Livewire→modelos/Storage. Comprueba alcance, pertenencia, prefijo y formato de ruta, y entrega bytes del disco correcto. FileManager bloquea cambios de cosId desde cliente y aplica permisos antes de cargar/borrar. CosFile.url emite esa ruta; no una URL pública. Se retira la consulta SQL de las props/pantalla.

**Límite material:** los archivos históricos no se movieron. Una copia accesible directamente por el servidor web no queda protegida por añadir una ruta Laravel. La migración a disco privado y vencimiento15 días desde publicación se resuelve en F5; requiere su procedimiento y autorización de datos. No se declara confidencialidad completa del almacenamiento actual. No se aplicaron migraciones reales ni se comprobó su estado en MySQL; el esquema mínimo de esta implementación incluye tur_id según la migración existente.

Validación:65 pruebas/416 aserciones,14.822s; Pint; Vite11.01s;12 capturas de barras/listados en ambos temas y375/768/1366 sin desbordes. Incluye denegaciones por ID, consulta/conteo/CSV, montaje directo y revalidación Livewire, cambios de rol, paths de archivo, regresión de fotos/login y guardias. El motor PDF es un doble tipado en la prueba de alcance: no demuestra render, contenido o velocidad del PDF. La exportación visual sustituye imágenes por decoración sintética: no demuestra fotos/logos reales. Las pruebas antiguas de CRUD declaran ahora actor administrativo/activo; el caso invitado se prueba sin sesión. Dos errores del fixture se corrigieron (tipo del doble PDF y excepción de modelo del arnés Livewire), sin debilitar permisos.

Fronteras revisadas contra [OWASP Top10:2025](https://top10.owasp.org/), versión confirmada en el índice oficial al trabajar: petición/identificadores→Policies/consulta parametrizada; propiedades Livewire→autorización renovada; archivo→ruta acotada/stream; Blade→escape y permisos. No hay dependencias nuevas ni auditoría integral de OWASP acreditada. Evidencia: pruebas/evidencias/fase-2/permisos. F2.3 sigue pendiente; no se registra todavía auditoría estructurada de cambios de permisos. Edad mínima18 cumplidos continúa como regla vigente y necesita fecha de nacimiento verificable en el contrato de identidad; no se infiere edad fiable de un RFC de dos dígitos.
