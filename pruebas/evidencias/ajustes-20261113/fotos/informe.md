# Fotos de perfil de /usuario — informe (revisión)

**Causa reproducida:** `store(…, 'public')` escribe en `storage/app/public/profile-photos`;
las vistas emitían `asset('storage/…')`, que apunta a `public/storage` (directorio real, sin
enlace). Además Livewire devuelve la ruta aunque `put()` falle, y `update()` puede devolver
`false` sin excepción.

**Correcciones**
| Punto | Cambio |
|---|---|
| 1. `store()` falso | Tras guardar se exige `is_string`, ruta válida y `exists()` real; si falla, error y foto anterior intacta (alta y edición) |
| 2. `save/update` falso | `update()` se comprueba antes de borrar la anterior; alta exige `$creado->exists`, si no descarta el archivo y no anuncia éxito |
| 3. URL sin refresco | `v=substr(sha256(ruta),0,12)`: cambia al sustituir la foto, estable entre renders, sin exponer el nombre del archivo |
| 4. Ruta validada | `User::rutaFotoValida()` (prefijo `profile-photos/`, sin `..`, solo jpg/jpeg/png/gif/webp) se aplica antes de `exists()`; el controlador usa la misma regla. Cargas restringidas a esos formatos |

**Archivos:** `app/Models/User.php`, `app/Livewire/Usuarios/Index.php`,
`app/Http/Controllers/UsuarioFotoController.php`, `pruebas/Feature/FotosPerfilUsuarioTest.php`.

**Verificación:** `php artisan test pruebas/Feature/FotosPerfilUsuarioTest.php` → 19 passed /
86 assertions; `pint --test` propio → passed. Solo `Storage::fake`/mock del disco y SQLite en memoria.

**Corrección del coordinador a este informe:** BMP se conserva, porque ya estaba permitido por el validador anterior; SVG permanece rechazado por la regla de imagen. Hay dos rutas nuevas autenticadas en `routes/web.php`: una canónica por usuario y una de compatibilidad por archivo. No se modificó el esquema, las vistas ni `config/` en esta entrega de backend.

## Verificación de integración del coordinador

- Se añadió protección para que sustituir una foto no borre una ruta histórica ajena a `profile-photos`, y dos pruebas: BMP sintético servido y conservación de un archivo ajeno.
- `useStoragePath` aísla archivos de prueba en `/pruebas`; TEMP/TMP/TMPDIR, cachés y vistas compiladas del comando también apuntan allí.
- `php pruebas/bootstrap.php --verificar-guardia`: `LARAVEL_CARGADO=no`, `GUARDIA=ACEPTA`.
- `php vendor/bin/phpunit pruebas/Feature/FotosPerfilUsuarioTest.php --no-coverage`: **21 pruebas, 94 aserciones, 3.421 s**, SQLite `:memory:`. Salida en `verificacion-coordinador.txt`.
- Pint `--test` limpio en modelo, componente, controlador, rutas y prueba; diff revisado.
- No se verificó el servidor web real ni se alteró `public/storage`. La integración visual sigue pendiente; la prueba de listado/detalle comprueba el contrato del componente, todavía no los elementos `img` de las vistas.
