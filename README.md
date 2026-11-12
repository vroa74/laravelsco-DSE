# SICODOC · Sistema de Control Documental de Oficialía de Partes

Aplicación web para la recepción, registro, turnado, resguardo y consulta de documentos oficiales de una Oficialía de Partes. Está construida sobre Laravel + Livewire + Jetstream, con interfaz en español, tema oscuro y soporte para generación de reportes PDF, control de archivos adjuntos y grupos de usuarios para el turnado de documentos.

- **Repositorio:** `laravelsco-DSE`
- **Dominio de referencia (bitácora heredada):** `sicodoc.melomelon.club`, `vroa.melomelon.club`
- **Entorno local:** Laragon (`http://laravelsco-dse.test`)
- **Idioma de la interfaz:** español (`config/app.php` → `locale` por defecto `es`)

---

## 1. Estado del proyecto

| Aspecto | Estado |
| --- | --- |
| Autenticación personalizada (email + RFC + contraseña) | Funcional |
| Registro público de usuarios | Deshabilitado en `config/fortify.php` |
| Recuperación de contraseña, perfil, 2FA, cierre de sesión | Habilitado (Fortify/Jetstream) |
| Reportes generales (`/rg`) con Livewire | Funcional |
| Turnado a usuario o a grupo de usuarios | Funcional (`tur_type`, `tur_group_id`, `tur_nom` heredado) |
| Catálogos NC / TC / CC y legislaturas | Funcional (Livewire) |
| Grupos de usuarios y miembros | Funcional |
| Adjuntos PDF por documento (`cos_files`) | Funcional (15 MB por archivo) |
| Archivos de reporte con límite de descargas y caducidad (`report_files`) | Modelo y comando listos; controlador sin rutas registradas |
| Inventario de componentes (`/componentes`) | Funcional |
| Pruebas automatizadas | Pest 4; 50 correctas y 8 omitidas (ver §11) |

---

## 2. Stack tecnológico

Versiones declaradas en `composer.json` y `package.json` (fuente de verdad del proyecto):

### Backend

| Paquete | Versión | Uso |
| --- | --- | --- |
| PHP | `^8.2` (plataforma Composer 8.4) | Requisito de plataforma |
| `laravel/framework` | `^12.0` | Framework base |
| `laravel/jetstream` | `^5.5` | Autenticación, perfil y stack Livewire |
| `laravel/fortify` | v1 (transitiva) | Backend de autenticación (`config/fortify.php`) |
| `laravel/sanctum` | `^4.4` | Tokens de API (`/api/user`) |
| `livewire/livewire` | `^3.8` | Componentes reactivos del servidor |
| `wireui/wireui` | `^2.6` | Componentes UI (instalado; sin uso detectado en las vistas) |
| `barryvdh/laravel-dompdf` | `^3.1` | Generación de reportes PDF |
| `barryvdh/laravel-snappy` | `^1.0` | PDF alternativo (instalado; sin uso detectado) |
| `maatwebsite/excel` | `^4.0` | Exportaciones a Excel/CSV (instalado; sin uso detectado) |
| `endroid/qr-code` | `^6.0` | Códigos QR (instalado; el 2FA usa el QR de Fortify) |
| `laravel-lang/common` | `^6.9` | Traducciones de Laravel |
| `laravel/tinker` | `^3.1` | REPL de depuración |

### Frontend

| Paquete | Versión | Uso |
| --- | --- | --- |
| `tailwindcss` | `^3.4.19` | Estilos utilitarios (+ `@tailwindcss/forms`, `@tailwindcss/typography`) |
| `vite` / `laravel-vite-plugin` | `^8.3` / `^3.2` | Compilación de assets |
| `alpinejs` | `^3.17.5` | Interacciones del cliente |
| `flowbite` | `^2.5.2` | Componentes Tailwind + plugin JS (CDN) |
| `vue` / `@vitejs/plugin-vue` | `^3.5.45` / `^6.0.10` | Instalado; no se importa en `resources/js/app.js` |
| `axios` | `^1.21.1` | Peticiones HTTP (`resources/js/bootstrap.js`) |
| `@fontsource/roboto`, `@fontsource/arimo` | `^5.3.0` | Tipografías empaquetadas |
| `concurrently` | `^10.0.7` | Script `composer run dev` |

### Desarrollo

Pest `^4.7` (PHPUnit 12), Pint `^1.32`, Pail `^1.3`, Collision `^8.9`, Sail `^1.70`, Faker, Mockery.

> **Nota de entorno:** el equipo local ejecuta PHP 8.5.11 en Laragon, pero `composer.json` fija `config.platform.php` en **8.4.0** porque varias dependencias (`phpoffice/phpspreadsheet` 1.30, `wireui/wireui` 2.6) todavía declaran máximos por debajo de 8.5. El runtime 8.5 funciona sin avisos tras ajustar `PDO::MYSQL_ATTR_SSL_CA` en `config/database.php`.

### Techo de versiones verificado

Actualizado a las versiones más recientes que **no rompen el código**:

| Dependencia | Instalada | Última disponible | Motivo del límite |
| --- | --- | --- | --- |
| `laravel/framework` | 12.72.0 | 13.42.0 | `laravel/jetstream` 5.5 exige `illuminate/support ^11.0\|^12.0` |
| `livewire/livewire` | 3.8.11 | 4.4.8 | Jetstream 5.5 exige `^3.3` y WireUI 2.6 exige `^3.6` |
| `pestphp/pest` | 4.7.8 | 5.3.5 | Pest 5 exige PHP `^8.4` y `pest-plugin-laravel` 5 exige Laravel `^13.23` |
| `tailwindcss` | 3.4.19 | 4.3.5 | `wireui` aporta el preset de v3 y Flowbite 2 usa el plugin de v3 |
| `flowbite` | 2.5.2 | 4.0.2 | Flowbite 4 depende de `tailwindcss ^4.1` |
| `endroid/qr-code` | 6.1.3 | 6.2.0 | La 6.2 exige PHP `^8.5`; la plataforma de Composer es 8.4 |

---

## 3. Requisitos

- PHP 8.2 o superior con extensiones `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `zip`, `gd`.
- Composer 2.
- Node.js 20.19+ o 22.12+ y npm (requisito de Vite 8).
- MySQL/MariaDB para desarrollo (la base de pruebas es SQLite en memoria).
- (Opcional) Laragon o cualquier servidor local con virtual host `laravelsco-dse.test`.

---

## 4. Instalación y puesta en marcha

```bash
# 1. Dependencias
composer install
npm install

# 2. Configuración
copy .env.example .env        # Windows
php artisan key:generate

# 3. Base de datos de desarrollo (revisar credenciales en .env antes de ejecutar)
php artisan migrate

# 4. Assets
npm run build                 # o: npm run dev

# 5. Servidor
php artisan serve             # o: composer run dev (servidor + queue + vite)
```

> ⚠️ **Protección de datos:** nunca ejecutes `migrate:fresh`, `migrate:refresh`, `migrate:reset`, `db:wipe` ni `db:seed` sobre datos existentes. `App\Providers\AppServiceProvider` bloquea esos comandos destructivos fuera del entorno de pruebas.

### Comandos habituales

| Comando | Descripción |
| --- | --- |
| `php artisan serve` | Servidor de desarrollo |
| `npm run dev` / `npm run build` | Vite en caliente / compilación de producción |
| `composer run dev` | Servidor + cola + Vite con `concurrently` |
| `php artisan test --compact` | Suite Pest completa |
| `php artisan test --compact --filter=nombre` | Prueba específica |
| `vendor/bin/pint --dirty --format agent` | Formateo de archivos PHP modificados |
| `php artisan reports:clean-expired [--force]` | Elimina archivos de reporte expirados (7 días) |
| `php artisan optimize:clear` | Limpia cachés (solo si es necesario) |

### Despliegue (bitácora heredada)

```bash
cd /var/www/vhosts/melomelon.club/vroa.melomelon.club && npm run build
cd /var/www/vhosts/melomelon.club/sicodoc.melomelon.club && npm run build
```

Tras compilar, limpiar cachés de configuración/vistas en el servidor. Si un cambio de frontend no se refleja, ejecutar `npm run build` (o `npm run dev` en local).

---

## 5. Estructura del proyecto

```text
app/
├── Actions/
│   ├── Fortify/                 CreateNewUser, PasswordValidationRules,
│   │                            ResetUserPassword, UpdateUserPassword,
│   │                            UpdateUserProfileInformation
│   └── Jetstream/               DeleteUser
├── Console/Commands/            CleanExpiredReportFiles (reports:clean-expired)
├── Helpers/                     AvatarHelper (autoload vía composer.json "files")
├── Http/
│   ├── Controllers/             AgeController, ReportsController, RgController,
│   │                            UsuarioController, UserGroupController,
│   │                            ReportFileController
│   ├── Controllers/Auth/        LoginController (login/logout personalizados)
│   └── Requests/                LoginRequest
├── Livewire/                    Componentes por dominio (ver §6)
├── Models/                      User, Co, Cos, CosFile, ReportFile, Age,
│                                Bitacora, UserGroup, UserGroupMember,
│                                Ccor, Ncor, Tcor, Legislatura
├── Providers/                   App, Fortify, Jetstream, Route
├── Traits/                      HandlesFileUploads
└── View/Components/             AppLayout, GuestLayout

config/                          app, auth, database, fortify, jetstream, sanctum, ...
database/
├── factories/                   UserFactory
├── migrations/                  22 migraciones (ver §9)
└── seeders/                     DatabaseSeeder, CosSeeder, UserGroupSeeder

public/media/img/                Logotipos, favicon y fondos
resources/
├── css/app.css                  Tailwind + estilos base
├── js/                          app.js, bootstrap.js
└── views/                       Blade (auth, ofi, rg, age, catalogos, componentes,
                                 components, layouts, livewire, profile, reports,
                                 user-groups, usuarios, api, emails, errors)
routes/
├── web.php                      50 rutas de la aplicación
└── api.php                      /api/user (Sanctum)

tests/
├── Feature/                     Pruebas de características (Pest)
├── Unit/                        Ejemplo unitario
├── Pest.php                     Configuración de Pest + RefreshDatabase
└── TestCase.php                 Guardia de SQLite en memoria
```

---

## 6. Módulos funcionales

### 6.1 Autenticación personalizada

- **Inicio de sesión** (`GET /login` → `auth.login`, `POST /login` → `login.post`):
  - Credenciales: **email + RFC + contraseña**.
  - `App\Http\Requests\LoginRequest` valida `email`, `rfc` (`3-4 letras + 6 dígitos`, máx. 13) y `password`, con mensajes en español.
  - `Auth\LoginController@login` localiza al usuario por `email` y `rfc`, autentica con `Auth::attempt()` y regenera la sesión; redirige a `config('fortify.home')` (`/dashboard`).
  - Los campos RFC y contraseña incluyen botón de mostrar/ocultar con SVG en línea.
  - La vista de login cierra la sesión automáticamente tras **60 segundos de inactividad** (script propio).
- **Cierre de sesión:** `POST /logout` (`Auth\LoginController@logout`) invalida la sesión y redirige a la página pública `welcome`. `GET /logout` también redirige a `welcome` para evitar errores al recargar o usar el botón "atrás".
- **Registro deshabilitado** (`Features::registration()` comentado en `config/fortify.php`).
- **Funciones activas:** recuperación de contraseña, actualización de perfil, cambio de contraseña y autenticación de dos factores.
- **Jetstream:** stack `livewire`, foto de perfil y eliminación de cuenta activas; equipos y API desactivados en `config/jetstream.php`.

### 6.2 Reportes generales y Oficialía de Partes (`/rg`)

- Recurso `RgController` (solo `index`, `create`, `show`, `edit`, `destroy`; las altas y cambios se resuelven con Livewire).
- Componentes: `App\Livewire\Reportesgral\{Index, Create, Edit, Show}`.
- Vistas: `resources/views/rg/{index,rg,create,edit,show,add}.blade.php`.
- **Turnado:** el documento puede turnarse a un usuario (`tur_type = user`, campos `tur_nom`, `tur_cargo`, `tur_deporg`) o a un grupo (`tur_type = group`, `tur_group_id`). `Co::getTurNameAttribute()` resuelve el nombre mostrado y `Co::turGroup()` expone la relación. Los campos añadidos son `nullable` para conservar el histórico.
- **Reportes PDF** (`ReportsController`, DomPDF):
  - `GET /reporte-normal/{id}/{tipoReporte}` → `reports.reportn` (`reporteNormal`).
  - `GET /reporte-especial/{id}/{tipoReporte}` → `reports.reporte` (`reporteEspecial`).
  - `GET /reporte-solicitud/{id}/{tipoReporte}` → `reports.reports` (`reporteSolicitud`).
- **Bitácora:** modelo `Bitacora` sobre la tabla `bitacoras` para el seguimiento de movimientos.

### 6.3 Usuarios y AGE

- `UsuarioController` (resource `usuario`, sin `store`/`update`) y `AgeController` (resource `agen`) para consulta y edición asistidas por Livewire.
- Componentes: `App\Livewire\Usuarios\{Index, Create, Edit, Show}` y `App\Livewire\People` (vista `/usuarios` → `age.people`).
- Campos de usuario: `name`, `email`, `rfc`, `curp`, `direction`, `position`, `sex`, `lvl`, `tipo`, `status`, `password`, `profile_photo_path`.
- Relaciones: grupos del usuario (`groups`), grupos creados (`createdGroups`), documentos turnados (`cosTurnado`), creados (`cosCreados`) y modificados (`cosModificados`).

### 6.4 Catálogos

- Ruta `/catalogos` (`catalogos`) con componentes `App\Livewire\Catalogo\{Nc, Tc, Cc}`.
- Modelos y tablas: `Ncor` → `ncors`, `Tcor` → `tcors`, `Ccor` → `ccors` y `Legislatura` → `legislaturas`.
- También existen componentes raíz `App\Livewire\{Nc, Tc, Cc, Leg}` con sus vistas en `resources/views/livewire/`.

### 6.5 Grupos de usuarios y turnado

- `UserGroupController` (resource `user-groups`) + `App\Livewire\UserGroups\Index`.
- Rutas adicionales:
  - `POST /user-groups/{userGroup}/add-member` → `user-groups.add-member`
  - `DELETE /user-groups/{userGroup}/remove-member` → `user-groups.remove-member`
  - `GET /user-groups/{userGroup}/available-users` → `user-groups.available-users`
- `UserGroup`: nombre, descripción, estado activo, creador, miembros (`members`), conteos y estadísticas de archivos, `hasMember()`, `addMember()`, `removeMember()`.
- `UserGroupMember` mantiene la pertenencia con `added_by` y unicidad por usuario/grupo.
- La jerarquía de grupos se agregó y se retiró en migraciones posteriores (`add_hierarchy_to_user_groups_table`, `remove_hierarchy_from_user_groups_table`).
- Vistas: `resources/views/user-groups/{index,create,edit,show}.blade.php`.

### 6.6 Archivos adjuntos (dos esquemas)

**a) Archivos de documento (`cos_files`)**

- Trait `App\Traits\HandlesFileUploads`: `files`, `fileDescriptions`, `maxFileSize` = 15 MB (`15728640` bytes), tipos permitidos `pdf`.
- Guarda en el disco `public` bajo `cos-files/`, con nombre único `time()_uniqid().pdf`.
- `CosFile` expone `url`, tamaño formateado, `exists()`, `deleteFile()` y los scopes `pdf` y `maxSize`.
- Relación `Co::files()`.

**b) Archivos de reporte (`report_files`)**

- Modelo `ReportFile`: `report_id`, `report_type`, `original_name`, `file_path`, `file_name`, `mime_type`, `file_size`, `download_count`, `max_downloads` (5 por defecto), `expires_at`.
- Reglas de negocio: **máximo 10 MB por PDF** (`ReportFileController::upload` → `max:10240`), **5 descargas** y **7 días naturales** de vida; `canBeDownloaded()`, `incrementDownloadCount()`, `isExpired()`, `hasReachedDownloadLimit()`, `getDaysUntilExpiration()`, scopes `expired` y `downloadable`.
- `ReportFileController` implementa `upload`, `download`, `list`, `delete` y `stats` (responde 410 cuando el archivo caducó o agotó sus descargas).
- Comando programable `php artisan reports:clean-expired` (con `--force`) para eliminar registros y archivos físicos expirados.
- ⚠️ Actualmente **no hay rutas registradas** para `ReportFileController`; la funcionalidad queda disponible solo a nivel de modelo y comando.

### 6.7 Inventario de componentes (`/componentes`)

Vista `resources/views/componentes/index.blade.php`, accesible con sesión iniciada. Documenta:

- Paquetes directos de Composer y Node.js (contadores: 11 + 6 en producción, 9 + 9 en desarrollo).
- Componentes Blade propios y de Jetstream.
- Clases Livewire del proyecto.
- Plugins e integraciones de interfaz (Alpine, Axios, Flowbite, Font Awesome, SweetAlert2, Tailwind, Vite, Vue, Roboto, Arimo, Figtree).
- Iconos Font Awesome utilizados y vistas con SVG en línea.

Debe mantenerse sincronizada con `composer.json`, `package.json`, `resources/views/components`, `app/Livewire` y los iconos de las vistas.

### 6.8 Vistas de apoyo

- `resources/views/ofi/of1..of10`: plantillas de oficios usadas como referencia de maquetación.
- `/temp` (`temp`) y `App\Livewire\Temp`: espacio de pruebas.
- `welcome`: página pública con la descripción de la Oficialía de Partes y acceso al inicio de sesión.

---

## 7. Rutas principales

`php artisan route:list --except-vendor` reporta 50 rutas. Todas usan nombres y se referencian con `route()`.

### Rutas públicas

| Método | URI | Nombre | Acción |
| --- | --- | --- | --- |
| GET | `/` | `welcome` | Vista `welcome` |
| GET | `/login` | `login` | Vista `auth.login` (middleware `guest`) |
| POST | `/login` | `login.post` | `Auth\LoginController@login` |
| POST | `/logout` | `logout` | `Auth\LoginController@logout` |
| GET | `/logout` | — | Redirección a `welcome` |
| GET | `/of1` … `/of10` | `of1` … `of10` | Plantillas `ofi.ofN` |

### Rutas autenticadas (`auth:sanctum`, `jetstream.auth_session`, `verified`)

| Método | URI | Nombre | Acción |
| --- | --- | --- | --- |
| GET | `/dashboard` | `dashboard` | Vista `dashboard` |
| GET | `/catalogos` | `catalogos` | Vista `catalogos.catalogos` |
| GET | `/componentes` | `componentes` | Vista `componentes.index` |
| GET | `/usuarios` | `usuarios` | Vista `age.people` |
| GET | `/temp` | `temp` | Vista `temp` |
| GET/POST/PUT/DELETE | `/user-groups...` | `user-groups.*` | `UserGroupController` |
| POST | `/user-groups/{userGroup}/add-member` | `user-groups.add-member` | `UserGroupController@addMember` |
| DELETE | `/user-groups/{userGroup}/remove-member` | `user-groups.remove-member` | `UserGroupController@removeMember` |
| GET | `/user-groups/{userGroup}/available-users` | `user-groups.available-users` | `UserGroupController@getAvailableUsers` |
| GET/POST/PUT/DELETE | `/rg...` | `rg.*` | `RgController` (sin `store`/`update`) |
| GET/POST/PUT/DELETE | `/agen...` | `agen.*` | `AgeController` (sin `store`/`update`) |
| GET/POST/PUT/DELETE | `/usuario...` | `usuario.*` | `UsuarioController` (sin `store`/`update`) |
| GET | `/reportesgral` | `reportgral` | Vista `rg.rg` |
| GET | `/reporte-normal/{id}/{tipoReporte}` | `reporteNormal` | PDF `reports.reportn` |
| GET | `/reporte-especial/{id}/{tipoReporte}` | `reporteEspecial` | PDF `reports.reporte` |
| GET | `/reporte-solicitud/{id}/{tipoReporte}` | `reporteSolicitud` | PDF `reports.reports` |

### API

| Método | URI | Middleware | Acción |
| --- | --- | --- | --- |
| GET | `/api/user` | `auth:sanctum` | Devuelve el usuario autenticado |

---

## 8. Modelos y base de datos

| Modelo | Tabla | Notas |
| --- | --- | --- |
| `User` | `users` | `HasApiTokens`, `HasProfilePhoto`, `TwoFactorAuthenticatable`, `Notifiable`; contraseña con cast `hashed` |
| `Co` | `cos` | Modelo principal de documentos; `legislaturaRel`, `remitente`, `turGroup`, `files`, `getTurNameAttribute`, `isTurnadoToGroup`, `isTurnadoToUser` |
| `Cos` | `cos` | Modelo heredado sobre la misma tabla; conserva `remitente`, `creador`, `modificador` |
| `CosFile` | `cos_files` | Adjuntos PDF de un documento |
| `ReportFile` | `report_files` | Archivos PDF con límite de descargas y caducidad |
| `Age` | `ages` | Registros de la Dirección/AGE |
| `Bitacora` | `bitacoras` | Bitácora de movimientos |
| `Ccor` | `ccors` | Catálogo CC |
| `Ncor` | `ncors` | Catálogo NC |
| `Tcor` | `tcors` | Catálogo TC |
| `Legislatura` | `legislaturas` | Catálogo de legislaturas |
| `UserGroup` | `user_groups` | Grupos de turnado |
| `UserGroupMember` | `user_group_members` | Pertenencia a grupos (`added_by`) |

### Campos heredados que **no deben renombrarse**

`id_s`, `F_serv`, `fcap`, `frec`, `ncor`, `tcor`, `ccor`, `fofi`, `nofi`, `nhoj`, `rem_*`, `tur_*`, `creo`, `modifico`, `reporte`, `estatus`, `des`, `seguimiento`. Se conservan para mantener compatibilidad con el histórico y los reportes existentes.

### Tabla `cos` (documento)

- Identificación: `legislatura`, `legislatura_id`, `ncor`, `tcor`, `ccor`, `nofi`, `nhoj`.
- Fechas: `fcap` (captura), `frec` (recepción), `fofi` (oficio).
- Remitente: `rem_nombre`, `rem_cargo`, `rem_deporg`, `rem_dir`, `rem_id` (FK `users`).
- Turnado: `tur_nom`, `tur_cargo`, `tur_deporg`, `tur_group_id` (FK `user_groups`), `tur_type` (`user`/`group`).
- Contenido: `des`, `seguimiento`, `reporte`, `estatus`.
- Auditoría: `creo`, `modifico`, `created_at`, `updated_at`.

---

## 9. Migraciones (22)

```text
0001_01_01_000000_create_users_table
0001_01_01_000001_create_cache_table
0001_01_01_000002_create_jobs_table
2025_01_07_035343_add_two_factor_columns_to_users_table
2025_01_07_035417_create_personal_access_tokens_table
2025_01_07_162123_create_cos_table
2025_01_07_162124_create_ages_table
2025_01_07_162124_create_ncors_table
2025_01_07_162125_create_ccors_table
2025_01_07_162125_create_tcors_table
2025_01_07_162158_create_legislaturas_table
2025_01_28_182914_create_bitacoras_table
2025_01_30_000000_create_report_files_table
2025_01_31_000001_create_user_groups_table
2025_01_31_000002_create_user_group_members_table
2025_01_31_000003_add_group_turnado_to_cos_table
2025_01_31_000004_add_hierarchy_to_user_groups_table
2025_01_31_000005_add_unique_user_group_membership
2025_01_31_000006_remove_hierarchy_from_user_groups_table
2025_06_15_043921_create_cos_files_table
2025_10_15_194355_fix_cos_foreign_keys
2026_10_17_210000_add_legislatura_id_to_cos_table
```

Las migraciones de turnado y archivos usan columnas `nullable` para no romper registros anteriores. Las migraciones automáticas generadas por herramientas se eliminaron en el commit `up000038`.

---

## 10. Interfaz, layouts y componentes

### Layouts

| Vista | Uso |
| --- | --- |
| `layouts.app` | Layout autenticado: navbar fija (`@livewire('navigation-menu')`), encabezado opcional, `x-banner`, SweetAlert2 y Flowbite por CDN, Font Awesome 6.0, Roboto |
| `layouts.guest` | Layout público: tema oscuro, Figtree (Bunny Fonts), Font Awesome 6.0 y SweetAlert2 por CDN |
| `layouts.free` | Layout libre para pantallas sin navegación |
| `layouts.navbar` / `layouts._navbar` | Navegación de la página pública y variantes |
| `layouts.footer` | Pie de página |

Convenciones visuales: Tailwind CSS, tema oscuro (`<html class="dark">`), contenedores `bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg`, badges `inline-flex ... rounded-full text-xs`, botones Jetstream (`<x-button>`, `<x-secondary-button>`, `<x-danger-button>`).

### Componentes Blade (30 registrados en el inventario)

`x-action-message`, `x-action-section`, `x-app-layout`, `x-application-logo`, `x-application-mark`, `x-authentication-card`, `x-authentication-card-logo`, `x-banner`, `x-button`, `x-checkbox`, `x-confirmation-modal`, `x-confirms-password`, `x-danger-button`, `x-dialog-modal`, `x-dropdown`, `x-dropdown-link`, `x-form-section`, `x-guest-layout`, `x-input`, `x-input-error`, `x-label`, `x-modal`, `x-nav-link`, `x-responsive-nav-link`, `x-secondary-button`, `x-section-border`, `x-section-title`, `x-switchable-team`, `x-validation-errors`, `x-welcome`.

Además existe `resources/views/components/nav.php` (componente `x-nav`) y dos componentes de clase en `app/View/Components` (`AppLayout`, `GuestLayout`).

### Componentes Livewire (21)

```text
App\Livewire\Cc                          App\Livewire\Reportesgral\Create
App\Livewire\Catalogo\Cc                 App\Livewire\Reportesgral\Edit
App\Livewire\Catalogo\Nc                 App\Livewire\Reportesgral\Index
App\Livewire\Catalogo\Tc                 App\Livewire\Reportesgral\Show
App\Livewire\FileManager                 App\Livewire\Tc
App\Livewire\Leg                         App\Livewire\Temp
App\Livewire\NavigationMenu              App\Livewire\UserGroups\Index
App\Livewire\Nc                          App\Livewire\Usuarios\Create
App\Livewire\People                      App\Livewire\Usuarios\Edit
App\Livewire\Profile\UpdateProfileInformationForm
                                         App\Livewire\Usuarios\Index
                                         App\Livewire\Usuarios\Show
```

### Reglas de interfaz del proyecto

- Todo texto visible debe estar en **español** (aún quedan cadenas de Jetstream en inglés).
- Tailwind CSS es la primera opción de estilo; no crear variantes visuales nuevas sin reutilizar patrones.
- Campos de contraseña: mostrar/ocultar con icono de ojo SVG, `text-gray-400 hover:text-gray-600`, alineado a la derecha, mediante `<x-password-toggle-button />` dentro de un contenedor `relative` con `x-data="{ show: false }"` (regla de `AGENTS.md`).
- Mensajes de sesión con claves `message` y `error`, textos claros en español.

---

## 11. Pruebas automatizadas

- Framework: **Pest 4** sobre **PHPUnit 12**, con `tests/Pest.php` aplicando `Tests\TestCase` y `RefreshDatabase` a `Feature`.
- **Base de datos de pruebas:** `phpunit.xml` fuerza `DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:` y `DB_URL=""` (vacío) con `force="true"`.
- **Guardia adicional:** `tests/TestCase.php` aborta con `RuntimeException` si la conexión por defecto no es SQLite en memoria.
- **Bloqueo de comandos destructivos:** `AppServiceProvider::boot()` ejecuta `DB::prohibitDestructiveCommands(! $this->app->runningUnitTests())`.
- Nunca deben ejecutarse pruebas contra MySQL real ni debilitar estas protecciones.

### Comandos

```bash
php artisan test --compact
php artisan test --compact --filter=logout
php artisan test --compact tests/Feature/LogoutTest.php
vendor/bin/pint --dirty --format agent
```

### Pruebas del proyecto

| Archivo | Cobertura | Estado |
| --- | --- | --- |
| `tests/Feature/LogoutTest.php` | Logout POST redirige a `welcome`, `welcome` carga sin sesión, `/logout` por GET redirige a `welcome` | ✅ 3 pruebas |
| `tests/Feature/ComponentesTest.php` | `/componentes` lista componentes Blade, Livewire, integraciones e iconos | ✅ 1 prueba |
| `tests/Feature/AuthenticationTest.php` | Login de Jetstream con `email`, `rfc` y `password` (credenciales válidas e inválidas) | ✅ 2 pruebas |
| `tests/Feature/IconActionTest.php` | `x-icon-action` (variantes, enlace, etiqueta accesible), `x-password-toggle-button`, escudo de fondo en auth y render de 8 rutas principales | ✅ 13 pruebas |
| `tests/Feature/ResponsiveLayoutTest.php` | Regla sin desplazamiento lateral: CSS base, ausencia de `overflow-x-*`/`min-w-[Npx]`, tablas `tabla-apilada` con `data-label` y CSS compilado por Vite | ✅ 9 pruebas |
| Suite Jetstream (`ProfileInformationTest`, `UpdatePasswordTest`, `TwoFactorAuthenticationTest`, `PasswordResetTest`, `BrowserSessionsTest`, `ApiTokenPermissionsTest`, `CreateApiTokenTest`, `DeleteApiTokenTest`, `DeleteAccountTest`, `EmailVerificationTest`, `PasswordConfirmationTest`, `RegistrationTest`) | Funciones de Jetstream/Fortify | ✅ ejecutan con avisos de deprecación |

**Último resultado (entorno local, PHP 8.5.11):** `58 pruebas`, `100 aserciones`, `50 correctas`, `8 omitidas` (`->skip()` de funciones Jetstream deshabilitadas: API, registro y verificación de correo) y `0 fallos`. Sin avisos de deprecación tras el ajuste de `config/database.php`.

---

## 12. Análisis frente a `AGENTS.md`

`AGENTS.md` (reglas de Laravel Boost) es la guía operativa del proyecto. Este es el contraste con el estado real del código:

### Lo que se cumple

- Interfaz en español en las vistas trabajadas y mensajes de validación personalizados.
- Rutas con nombre y uso de `route()` en enlaces y redirecciones (`welcome`, `logout`, `login.post`, `componentes`).
- Controladores en `App\Http\Controllers` con sufijo `Controller`.
- Livewire organizado por dominio (`Catalogo`, `Reportesgral`, `Usuarios`, `UserGroups`, `Profile`).
- Nombres de columnas heredados respetados (`id_s`, `F_serv`, `rem_*`, `tur_*`, `ncor`, `tcor`, `ccor`, etc.).
- Tailwind CSS como base de estilos y reutilización de componentes `x-*` de Jetstream.
- Protección de la base de datos: `phpunit.xml` fuerza SQLite `:memory:`, `tests/TestCase.php` aborta si no lo es y `AppServiceProvider` bloquea comandos destructivos.
- Inventario de componentes actualizado en `resources/views/componentes/index.blade.php` junto con las dependencias.
- Formateo con Laravel Pint disponible (`vendor/bin/pint --dirty --format agent`).

### Discrepancias y brechas detectadas

| # | Regla en `AGENTS.md` | Estado real |
| --- | --- | --- |
| 1 | PHP 8.3, Laravel 13, Pest 4, Livewire 3, Sanctum 4, Pint 1, Pail 1, Tailwind 3 | Alineado salvo Laravel: el proyecto quedó en **Laravel 12** porque Jetstream 5.5 no admite 13; PHP local 8.5 con plataforma Composer 8.4. Pest 4, Livewire 3, Sanctum 4, Pint 1, Pail 1 y Tailwind 3 coinciden |
| 2 | Paquetes `laravel/boost`, `laravel/mcp`, `laravel/prompts` | No figuran en `composer.json`; las herramientas MCP de Boost (`search-docs`, `database-query`, `database-schema`, `browser-logs`) no están disponibles en este entorno |
| 3 | Pruebas en la carpeta `/pruebas` | El proyecto usa `tests/` con la estructura estándar de Laravel; no existe `/pruebas` |
| 4 | Habilidades en `**/skills/**` | Están en `.agents/skills/`; `.agents/` no figura en `.gitignore` y suma 1 929 archivos / 39.6 MB (incluye `.agents/skill-backups/`), por lo que hoy queda fuera del commit |
| 5 | Usar `<x-password-toggle-button />` en campos de contraseña | Componente creado en `up000042` e incluido en el inventario; `auth/login.blade.php` lo usa junto con `x-data="{ show: false }"` |
| 6 | Todo texto visible en español | Persisten cadenas de Jetstream en inglés (`Email`, `Password`, `Log in`, `Remember me`, `Email Password Reset Link`) |
| 7 | Inventario de componentes sincronizado | Falta registrar el componente propio `x-nav` (`resources/views/components/nav.php`) |
| 8 | Documentación solo si se solicita | `README.md` se reescribe por solicitud explícita en este cambio |

> Recomendación: mantener el techo documentado en §2 (Laravel 12, Livewire 3, Tailwind 3, Flowbite 2) hasta que `laravel/jetstream` soporte Laravel 13 y `wireui`/`flowbite` migren a Tailwind 4. Ese salto debe planificarse como tarea independiente porque afecta el preset de Tailwind y todos los estilos.

---

## 13. Observaciones y deuda técnica

Detectadas al revisar el proyecto y el diff del último commit. **No se corrigieron** porque el alcance solicitado era revisar, documentar y registrar el commit.

1. **`AuthenticationTest` desactualizado:** ✅ resuelto en `up000042`; la prueba envía `rfc` y `UserFactory` genera un RFC único, por lo que la suite queda sin fallos.
2. **`ReportFileController` sin rutas:** `upload`, `download`, `list`, `delete` y `stats` no están expuestos en `routes/web.php`; la funcionalidad de 10 MB / 5 descargas / 7 días existe pero no es accesible desde la interfaz.
3. **Modelos duplicados:** `Co` y `Cos` apuntan a la misma tabla `cos`. Conviene dejar un solo modelo canónico y conservar el otro como alias deprecado.
4. **`UserFactory` referencia `App\Models\Team`**, clase que no existe. Solo falla si se usa `withPersonalTeam()` o se habilitan equipos de Jetstream. No se ejecuta en las pruebas actuales.
5. **`resources/views/welcome.blade.php`**: ✅ resuelto en `up000043`; se retiró el texto suelto `++++++`, el `<title>` usa `config('app.name')` y se corrigió el encabezado de la portada.
6. **Vista huérfana:** `resources/views/livewire/rg/index.blade.php` no tiene clase `App\Livewire\Rg\Index` asociada.
7. **Copias de vistas:** `resources/views/ofi/of1.blade - copia.php` y `of2.blade - copia*.php` deberían retirarse del proyecto.
8. **Descarga de adjuntos:** `CosFile::exists()` y `deleteFile()` usan el disco por defecto (`local`), mientras `HandlesFileUploads` guarda en el disco `public` con `storeAs(..., 'public')`. Revisar para evitar descargas fallidas.
9. **Dos límites distintos de tamaño:** `cos_files` permite 15 MB y `report_files` 10 MB. Confirmar con negocio cuál aplica a cada flujo.
10. **Inactividad de 60 segundos** en el login: redirige a `/` sin cerrar sesión formalmente; puede ser agresivo para el usuario.
11. **`config/app.php`** usa `locale = es`, pero `.env.example` declara `APP_LOCALE=en`; un `.env` nuevo arrancaría en inglés.
12. **PHP 8.5 local** ya no emite deprecaciones en la suite: `config/database.php` usa `Pdo\Mysql::ATTR_SSL_CA` cuando existe y `composer.json` fija la plataforma en 8.4. Aun así, conviene desplegar con la misma versión de PHP declarada (8.4).
13. **Rutas de imágenes públicas:** `welcome` usa `media/img/background.png` y `media/img/logos.png`, `layouts.app` usa `media/img/favicon.png` y `layouts.navbar` usa `media/img/ple_legis_65.png`. Las cuatro existen en `public/media/img`; el fallo de imágenes en despliegues proviene de no publicar esa carpeta.
14. **`AppServiceProvider`** ahora bloquea comandos destructivos; documentar que `migrate:fresh`, `migrate:refresh`, `migrate:reset` y `db:wipe` fallarán fuera de las pruebas.
15. **`.agents/` fuera del control de versiones:** contiene 1 929 archivos (39.6 MB) entre `skills/` y `skill-backups/`; falta decidir si se versiona `skills/` e ignora `skill-backups/`.

---

## 14. Bitácora heredada del README anterior

El README original (`zREADME.md`) mantenía una bitácora de trabajo que se conserva como referencia histórica:

- Creación de componentes Livewire: `catalogo.nc`, `catalogo.tc`, `catalogo.cc`, `reportesgral.index`, `reportesgral.create`, `reportesgral.edit`, `reportesgral.show`.
- Creación de controladores con `php artisan make:controller ... --resourse` (incluida la errata `--resourse`).
- Definición del requisito de archivos de reporte: **PDF de máximo 10 MB, 5 descargas y caducidad de 7 días**, implementado en `ReportFile` y `reports:clean-expired`.
- Nota sobre la imagen de la aplicación no unificada entre vistas.
- Secuencia sugerida de despliegue: `composer install`, `npm install`, `npm run build`, `php artisan migrate --force`, `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.

---

## 15. Convención de commits y registro de este cambio

### Convención

- Los commits usan la secuencia `upNNNNNN` (por ejemplo `up000037`, `up000038`, `up000039`), con mensaje corto y una descripción de los cambios incluidos.
- **Regla vigente desde `up000042`:** toda modificación terminada que sume más de 10 líneas (altas + bajas) se cierra con un commit inmediato con el siguiente consecutivo de la serie y el detalle de los cambios en el cuerpo del mensaje.
- Cada commit se registra además en este apartado §15 (`### Título ("upNNNNNN")` + tabla de archivos + validación), de modo que la bitácora indica el post al que pertenece.
- Las migraciones generadas automáticamente por herramientas no se conservan (se retiraron en `up000038`).
- Los cambios se documentan también en el inventario `/componentes` cuando afectan dependencias, componentes o iconos.

### Cambios incluidos en `up000040`

| Archivo | Cambio |
| --- | --- |
| `README.md` | Reescritura completa: estado, stack, requisitos, instalación, estructura, módulos, rutas, modelos, migraciones, interfaz, pruebas, análisis de `AGENTS.md`, deuda técnica y convenciones |
| `resources/views/componentes/index.blade.php` | Inventario ampliado: 30 componentes Blade con descripción, 21 clases Livewire, integraciones de frontend, iconos Font Awesome y SVG en línea; contadores corregidos (11 + 6 producción, 9 + 9 desarrollo) y título «Total de paquetes directos» |
| `app/Http/Controllers/Auth/LoginController.php` | El cierre de sesión redirige con `route('welcome')` en lugar de `redirect('/')` |
| `routes/web.php` | Nueva ruta `GET /logout` que redirige a `welcome` para enlaces directos, recargas y botón «atrás»; Pint normalizó clausuras multilínea y orden de `use` |
| `resources/views/auth/login.blade.php` | Botón «Inicio» con icono `fa-igloo` para volver a la página pública |
| `resources/views/auth/forgot-password.blade.php` | Botón «Inicio» con icono `fa-house` para volver a la página pública |
| `resources/views/layouts/guest.blade.php` | Font Awesome 6.0 por CDN para las pantallas de autenticación |
| `phpunit.xml` | Fuerza `DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:` y `DB_URL=""` con `force="true"` |
| `tests/TestCase.php` | Guardia que aborta la ejecución si la conexión no es SQLite en memoria |
| `app/Providers/AppServiceProvider.php` | `DB::prohibitDestructiveCommands()` fuera del entorno de pruebas |
| `tests/Feature/LogoutTest.php` *(nuevo)* | 3 pruebas del cierre de sesión y de la página pública |
| `tests/Feature/ComponentesTest.php` *(nuevo)* | Prueba del inventario de componentes |
| `AGENTS.md` *(nuevo)* | Reglas operativas del proyecto |

### Actualización de dependencias (`up000041`)

| Archivo | Cambio |
| --- | --- |
| `composer.json` | Laravel `^12.0`, Jetstream `^5.5`, Livewire `^3.8`, Sanctum `^4.4`, WireUI `^2.6`, Tinker `^3.1`, Excel `^4.0`, Pest `^4.0`, Pint `^1.32`, Pail `^1.3`, Sail `^1.70`, Collision `^8.9`, DomPDF `^3.1`, Laravel Lang `^6.9`; se agrega `config.platform.php = 8.4.0` |
| `composer.lock` | Resolución completa de las nuevas versiones (Laravel 12.72.0, Livewire 3.8.11, Pest 4.7.8, PHPUnit 12.5.33, Excel 4.0.6, Tinker 3.1.0) |
| `package.json` | Vite `^8.3.8`, `laravel-vite-plugin` `^3.2.1`, `@vitejs/plugin-vue` `^6.0.10`, Alpine `^3.17.5`, Tailwind `^3.4.19`, Axios `^1.21.1`, fuentes `^5.3.0`, `concurrently` `^10.0.7` |
| `package-lock.json` | Resolución de las nuevas versiones de frontend |
| `config/database.php` | Usa `Pdo\Mysql::ATTR_SSL_CA` (PHP ≥8.4) con reserva a `PDO::MYSQL_ATTR_SSL_CA`, eliminando la deprecación de PHP 8.5 en las pruebas |
| `AGENTS.md` | Versiones reales del stack y nueva sección «Techo de versiones verificado» |
| `README.md` | Stack, requisitos, pruebas y análisis de `AGENTS.md` alineados a las versiones instaladas |

**Validación:** `composer validate` correcto, 50 rutas, `npm run build` correcto con Vite 8 y suite con 27 pruebas correctas, 8 omitidas y 1 fallo preexistente (`AuthenticationTest`).

### Interfaz responsiva, botones unificados y sin desplazamiento lateral (`up000042`)

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` | Nueva sección «Commits y bitácora» (commit obligatorio con `upNNNNNN` y registro en `README.md` cuando el cambio supera 10 líneas) y regla de estilo «sin desplazamiento lateral» |
| `resources/css/app.css` | `overflow-x: clip` en `html` y `body`; componente `.tabla-apilada` que en móvil convierte cada fila en tarjeta con etiqueta `::before` desde `data-label` y desde 768px restaura la tabla |
| `resources/views/components/icon-action.blade.php` *(nuevo)* | Botón o enlace de acción solo con icono: variantes por gradiente, tamaños `sm`/`md`, `title` y `aria-label` accesibles |
| `resources/views/components/password-toggle-button.blade.php` *(nuevo)* | Botón de ojo reutilizable para mostrar u ocultar contraseñas |
| `resources/views/livewire/reportesgral/index.blade.php` | Tabla a `tabla-apilada` con `data-label`, sin `overflow-x-auto` ni `min-w-[880px]`, filtros con `flex-wrap`, acciones con `x-icon-action` y `<thead>` restaurado |
| `resources/views/livewire/rg/index.blade.php` | Mismo tratamiento: tabla apilada, sin `min-w-[880px]` y `<thead>` restaurado |
| `resources/views/livewire/usuarios/index.blade.php` | Tabla apilada con 12 etiquetas, anchos `md:w-*`, `colspan` del estado vacío corregido (13→12) |
| `resources/views/livewire/people.blade.php` | Tabla apilada con 11 etiquetas, anchos `md:w-*`, `colspan` corregido (12→11) |
| `resources/views/livewire/user-groups/index.blade.php` | Tabla apilada con 6 etiquetas y sin `overflow-x-auto` |
| `resources/views/livewire/reportesgral/create.blade.php`, `edit.blade.php` | Contenedores de modal solo con desplazamiento vertical (`overflow-y-auto`) |
| `resources/views/auth/*` (login, register, reset, forgot, confirm, verify, two-factor) | Acciones con `x-icon-action` y textos en español; `register`, `reset-password` y `confirm-password` incorporan `x-password-toggle-button` (login conserva su toggle con JS propio) |
| `resources/views/layouts/guest.blade.php`, `components/authentication-card.blade.php` | Escudo `media/img/ple_legis_65.png`: fondo fijo con degradados y `mix-blend-screen` en el layout, y emblema superior en la tarjeta de autenticación con `backdrop-blur` |
| `resources/views/catalogos/catalogos.blade.php` | Se retira la detección de dispositivo por JavaScript; una sola cuadrícula responsiva de 1, 2 y 4 columnas |
| `resources/views/livewire/nc.blade.php`, `tc.blade.php`, `cc.blade.php`, `leg.blade.php`, `file-manager.blade.php` | Acciones y formularios con `x-icon-action` en lugar de botones con texto |
| `resources/views/age/*`, `rg/*`, `user-groups/*`, `profile/*`, `api/*`, `dashboard.blade.php`, `temp.blade.php` | Encabezados y espacios responsivos (`text-base sm:text-lg`, `py-6 sm:py-8`), acciones unificadas y bloques `flex` con `gap` |
| `resources/views/componentes/index.blade.php` | Inventario con `x-icon-action`, `x-password-toggle-button` y los iconos Font Awesome realmente usados |
| `database/factories/UserFactory.php` | RFC único (`[A-Z]{4}[0-9]{6}`) y PHPDoc `@extends Factory<User>` |
| `tests/Feature/AuthenticationTest.php` | Envía `rfc` en el login correcto y en el fallido |
| `tests/Feature/IconActionTest.php` *(nuevo)* | 13 pruebas: botón de icono, enlace, toggle de contraseña, escudo de fondo y render de 8 rutas principales |
| `tests/Feature/ResponsiveLayoutTest.php` *(nuevo)* | 9 pruebas que impiden reintroducir desplazamiento lateral y validan `tabla-apilada`, `data-label` y el CSS compilado |

**Validación:** `vendor/bin/pint --dirty --format agent` limpio, `npm run build` correcto (`app-BaXTTsVI.css` exporta `.tabla-apilada`, `attr(data-label)` y `overflow-x:clip`), `php artisan view:cache` correcto y suite con 58 pruebas, 100 aserciones, 50 correctas, 8 omitidas y 0 fallos.

### Portada pública sin texto residual y con título institucional (`up000043`)

| Archivo | Cambio |
| --- | --- |
| `resources/views/welcome.blade.php` | El `<title>` pasa de `Laravel` a `config('app.name')`; se retira el texto suelto `++++++` que se mostraba en el cuerpo y se corrige el encabezado «Ques es Oficialía de Partes» a «¿Qué es la Oficialía de Partes?» |
| `tests/Feature/LogoutTest.php` | Nueva prueba de la portada: exige el título con el nombre de la aplicación y la ausencia del texto residual |
| `README.md` | Punto 5 de §13.5 marcado como resuelto y retiro del pendiente equivalente en §15 |

**Validación:** `vendor/bin/pint --dirty --format agent` limpio y `php artisan test --compact` con 59 pruebas (51 correctas, 8 omitidas) y 0 fallos.

### Exclusiones locales de Git (`up000044`)

| Archivo | Cambio |
| --- | --- |
| `.gitignore` | Se excluyen `.agents/` (39.6 MB de habilidades y respaldos), `DOC/` (36.8 MB: propuesta, diagramas y `sco.sql`, respaldo de la base con 650 `INSERT`) y `zREADME.md` (bitácora anterior) para que el árbol de trabajo quede limpio sin subir datos ni peso innecesario |
| `README.md` | Esta sección y actualización de «Pendientes fuera de estos commits» |

**Validación:** `git status --short` sin archivos sin seguimiento, `vendor/bin/pint --dirty --format agent` limpio y `php artisan test --compact` con 59 pruebas (51 correctas, 8 omitidas) y 0 fallos.

### Pruebas aisladas y guardia previa al arranque ("up000045")

| Archivo | Cambio |
| --- | --- |
| `phpunit.xml` | Registra la suite `Pruebas` y fuerza entorno testing, SQLite en memoria, URL vacía y servicios aislados. |
| `tests/TestCase.php` | Ejecuta una guardia antes de arrancar Laravel y conserva la comprobación posterior de la conexión efectiva. |
| `pruebas/bootstrap.php` | Rechaza configuraciones cacheadas, valores no permitidos y contradicciones entre SERVER, ENV y putenv; no imprime rutas de base ni URLs. |
| `pruebas/arranque-forzado.php` | Fixture negativo con `php -n`, controladores MySQL deshabilitados y observables del aborto antes del bootstrap. |
| `pruebas/Feature` y `pruebas/Unit` | 11 pruebas de descubrimiento, dato sintético, aislamiento y conflictos de entorno, compatibles con Pest y PHPUnit. |
| `pruebas/evidencias/fase-1` y `DOC/sistema/fase-1.md` | Evidencia de ejecución y revisión del coordinador, límites y tareas pendientes de la fase. |
| `README.md` | Registro de esta entrega en la sección 15. |

**Validación:** Pint pasó. `php artisan test --compact --cache-directory=pruebas/.cache/phpunit`: 62 aprobadas, 8 omitidas y 163 aserciones, 74.27 s, con entorno forzado a SQLite `:memory:` y artefactos temporales bajo `/pruebas`. El desarrollador verificó además Pest y PHPUnit para la suite nueva: 11 pruebas, 60 aserciones. El fixture negativo comprobó controladores MySQL deshabilitados y ausencia de contenedor, bootstrap de aplicación y gestor de BD. Sin acceso a MySQL, cambios de esquema real, dependencias ni interfaz. F1.3 aceptada; F1.1/F1.2 permanecen en revisión de diseño.

### Contrato técnico y reglas funcionales de la reestructuración ("up000046")

| Archivo | Cambio |
| --- | --- |
| `DOC/sistema/diccionario-primer-recorrido.md` | Modelo canónico, consumidores legados, tipos, nulabilidad, integridad y registro de migraciones por tabla/fase. |
| `DOC/sistema/compatibilidad-y-transicion.md` | Stack objetivo, adaptadores y fuentes oficiales, transición por recorrido y validaciones de integración pendientes. |
| `DOC/sistema/reglas-funcionales.md` | Cuentas desde 18 años cumplidos y adjuntos durante 15 días naturales desde publicación; metadatos/historia permanentes. |
| `DOC/sistema/fase-1.md` | Cierre de preparación, evidencia F1.3 y límites; no acredita instalación del stack nuevo ni migración de datos. |
| `README.md` | Bitácora de este cierre documental. |

**Validación:** documentos leídos de vuelta en UTF-8; estructura, referencias, decisiones y diferencias revisadas. No se ejecutan Pint/build/pruebas por este cambio exclusivamente documental. La regresión de F1.3 permanece en up000045: 62 aprobadas, 8 omitidas y 163 aserciones. Sin datos, .env, dependencias ni interfaz modificados.

### Estándar visual transversal y prioridad de homogeneización ("up000047")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` | Regla global de estilos y prioridad visual: contraste, componentes, tamaños, imágenes, temas y responsabilidades de las skills. Solo esta incorporación entra en el commit; cambios locales anteriores preservados. |
| [DOC/sistema/estandar-visual.md](DOC/sistema/estandar-visual.md) | Contrato de uniformidad para todos los CRUD tomando `/agen` como referencia, requisitos responsive y comprobaciones previas a la entrega. |
| `README.md` | Enlace al estándar y registro de su alcance. |

**Validación:** lectura posterior, enlaces locales, disponibilidad de los tres SKILL.md y revisión de diferencias documentales. Sin cambios de interfaz, instalación de plugins ni acceso a datos. Aplicación del estándar y verificación visual pendientes; las correcciones RG/grupos no forman parte de este commit.

### Reparto NVIDIA frontend y DeepSeek backend ("up000048")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` | Asigna frontend a NVIDIA NIM y backend a DeepSeek, con prioridad visual y límites de implementación. Solo esta incorporación se incluye; cambios previos preservados. |
| `DOC/sistema/estandar-visual.md` | Registra roles, modelo NVIDIA comprobado y límites de la integración OpenCode/Orca. |
| `README.md` | Bitácora del reparto y validación. |

**Validación:** inferencia NVIDIA vía OmniRoute HTTP 200 con llamada a herramienta; alias único agregado fuera del repositorio con respaldo SHA-256 verificado y comparación del resto sin cambios. Tres intentos anteriores detenidos con confirmación. Lectura/diferencias documentales revisadas; informes y verificación visual pendientes. Sin claves publicadas, nuevas dependencias, MySQL ni código de producto modificado en esta entrega. No se afirma configuración ni prueba de NVIDIA en Codex Desktop/CLI.

### Contexto del trabajador NVIDIA ("up000049")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` y `DOC/sistema/estandar-visual.md` | Registra el fallo de compactación del primer arranque NVIDIA, ajuste de límites declarados con fuente oficial y estado pendiente de reintento. |
| `README.md` | Bitácora del ajuste; configuración privada fuera del repositorio. |

**Validación:** respaldo SHA-256 y comparación del resto de la configuración correctos; contexto nativo 256K contrastado con documentación oficial. Intento fallido detenido con confirmación; no se afirma trabajo realizado por el agente, capacidad máxima alojada ni resolución completa. Sin pruebas de aplicación, interfaz ni MySQL.

### Límite efectivo del gateway NVIDIA ("up000050")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` y `DOC/sistema/estandar-visual.md` | Diferencia entre límite del alias y del gateway; excepción única documentada y entrega backend de solo lectura. |
| `pruebas/evidencias/integracion-nvidia` | Metadatos del límite anterior/posterior, sin claves ni conversaciones. |
| `README.md` | Bitácora y resultado real de verificación. |

**Validación:** actualización de metadatos vía API HTTP 200, readback y catálogo de inferencia con contexto262144 para Nemotron Ultra. Intento fallido detenido con confirmación; frontend todavía pendiente de informe. DeepSeek entregó revisión estática de contratos. Sin claves, código de producto, datos de SCO ni MySQL modificados.

### Fondo de acceso plateado, ampliado y sin letras ("up000051")

| Archivo | Cambio |
| --- | --- |
| `resources/views/layouts/guest.blade.php` | Fondo con el escudo sin leyenda y clases compartidas; formularios y cabecera conservados. |
| `resources/css/app.css` | Filtro plateado, tamaño adaptable hasta1100px, alto máximo90svh y gradientes/opacidad previos. |
| `public/media/img/campechecon.png` | Incluye el PNG original proporcionado por el usuario que consume el nuevo fondo, sin editarlo. |
| `pruebas/evidencias/fondo-acceso` y `pruebas/prototipos/fondo-acceso-plata.html` | Regresión y vista previa estática del fondo sin backend. |
| `AGENTS.md`, `DOC/sistema/estandar-visual.md` y `README.md` | Decisión del usuario, alcance y pendientes. |

**Validación:** build correcto del trabajador (19.13s); CSS compilado y diff check revisados; guardias verificadas y 22 pruebas aprobadas con45 aserciones en87.54s, datos sintéticos enSQLite memoria. Sin MySQL ni pruebas nuevas que repliquen CSS. Revisión renderizada y aceptación estética pendientes; la estandarización general no está implementada. Otros PNG/favicons y parches previos quedan fuera del commit.

### Escudo global y superficies translúcidas ("up000052")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` | Precisa escudo global y alfa0.8 solo del fondo de paneles/tablas; descendientes al100%, sin capas que oculten el escudo. |
| `DOC/sistema/estandar-visual.md` | Cobertura por familia de pantalla, ambos temas, responsive y contraste de la composición real. |
| `README.md` | Registra la aclaración y diferencia fondo de acceso de homogeneización global. |

**Validación:** lectura y diferencias documentales comprobadas. El fondo de acceso está implementado en up000051; la cobertura global y estandarización siguen pendientes. Sin código, datos, pruebas de aplicación ni dependencias modificados en esta entrega.

### Pausa y punto de reanudación ("up000053")

| Archivo | Cambio |
| --- | --- |
| `AGENTS.md` | Registra pausa expresa, detención confirmada y homogeneización pendiente. |
| `DOC/sistema/reanudacion.md` | Estado local, objetivo visual, Task/Dispatch y pasos para continuar sin descartar cambios. |
| `README.md` | Bitácora de la suspensión; producto inconcluso fuera del commit. |

**Validación:** suspensión enviada y detención Orca confirmada; checkpoint local de diferencias y archivos nuevos de resources guardado y nota leída de vuelta. Sin build, pruebas ni datos en esta pausa. No continúa trabajo en la nube; esperar petición de reanudación.

### Pendientes fuera de estos commits

- Exponer las rutas de `ReportFileController` o retirar la funcionalidad.
- `DOC/` y `.agents/` viven solo en local; si se requiere versionar la documentación de `DOC/`, se retira esa línea de `.gitignore` y se excluye únicamente `DOC/sco.sql`.

