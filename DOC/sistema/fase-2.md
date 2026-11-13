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

- F2.1: Policies y alcance único por recurso; controles del servidor en rutas y Livewire, incluidos exports/descargas. Matriz anterior ya confirmada; no volver a preguntarla.
- F2.2: comprobar endpoint efectivo de login, cuenta activa, limitación y desafío MFA cuando corresponda. No habilitar por inferencia correo/MFA obligatorio para todas las cuentas heredadas.
- F2.3: auditoría mínima sin secretos, conservando actor e historia.
- Mantener pendientes de fotos/servidor y PDF visibles; no cerrar fase por una lectura estática o un build.

## Ajuste menor de grupos — up000067

El detalle ya mantiene encabezado, datos y ambos cierres dentro del panel, con texto largo desplazable y cierre accesible. Una prueba/10 aserciones comprueba DOM y closeModal; seis casos offline en ambos temas y375/768/1366 sin desbordes. Build11.69s y Pint. Evidencia: pruebas/evidencias/ajustes-20261113/grupo-detalle. No altera permisos o membresías, no acredita servidor real y no cierra Fase2.
