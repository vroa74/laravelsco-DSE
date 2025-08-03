# Relaciones entre Cos y Users

## Modelos Creados

### Modelo Cos

-   **Archivo**: `app/Models/Cos.php`
-   **Tabla**: `cos`
-   **Relaciones**:
    -   `remitente()` - BelongsTo con User (rem_id)
    -   `creador()` - BelongsTo con User (creo)
    -   `modificador()` - BelongsTo con User (modifico)

### Modelo User (Actualizado)

-   **Archivo**: `app/Models/User.php`
-   **Relaciones agregadas**:
    -   `cosRemitente()` - HasMany con Cos (rem_id)
    -   `cosCreados()` - HasMany con Cos (creo)
    -   `cosModificados()` - HasMany con Cos (modifico)

## Ejemplos de Uso

### 1. Obtener el remitente de un registro COS

```php
$cos = Cos::find(1);
$remitente = $cos->remitente; // Retorna el User o null
echo $remitente->name; // Nombre del remitente
```

### 2. Obtener todos los registros COS de un usuario como remitente

```php
$user = User::find(1);
$cosRemitente = $user->cosRemitente; // Collection de registros Cos
foreach ($cosRemitente as $cos) {
    echo $cos->ncor; // Número de correspondencia
}
```

### 3. Obtener el creador de un registro COS

```php
$cos = Cos::find(1);
$creador = $cos->creador; // User que creó el registro
echo $creador->name;
```

### 4. Obtener todos los registros COS creados por un usuario

```php
$user = User::find(1);
$cosCreados = $user->cosCreados; // Collection de registros Cos
```

### 5. Obtener el modificador de un registro COS

```php
$cos = Cos::find(1);
$modificador = $cos->modificador; // User que modificó el registro
echo $modificador->name;
```

### 6. Obtener todos los registros COS modificados por un usuario

```php
$user = User::find(1);
$cosModificados = $user->cosModificados; // Collection de registros Cos
```

### 7. Crear un registro COS con remitente

```php
$user = User::find(1);
$cos = new Cos([
    'legislatura' => '2024-2027',
    'ncor' => 'COS-001',
    'rem_nombre' => $user->name,
    'rem_cargo' => $user->position,
    'rem_deporg' => $user->direction,
    'rem_id' => $user->id,
    'creo' => auth()->id(),
    'estatus' => true
]);
$cos->save();
```

### 8. Consultas con relaciones

```php
// Obtener todos los COS con sus remitentes
$cosConRemitentes = Cos::with('remitente')->get();

// Obtener usuarios que han sido remitentes
$usuariosRemitentes = User::has('cosRemitente')->get();

// Obtener COS de un usuario específico como remitente
$cosDeUsuario = Cos::whereHas('remitente', function($query) {
    $query->where('id', 1);
})->get();
```

### 9. Actualizar un registro COS

```php
$cos = Cos::find(1);
$cos->update([
    'modifico' => auth()->id(),
    'estatus' => false
]);
```

## Campos de la Tabla COS

-   `legislatura` - Legislatura
-   `fcap` - Fecha de captura
-   `frec` - Fecha de recepción
-   `ncor` - Número de correspondencia
-   `tcor` - Tipo de correspondencia
-   `ccor` - Clasificación de correspondencia
-   `fofi` - Fecha oficial
-   `nofi` - Número oficial
-   `nhoj` - Número de hojas
-   `rem_nombre` - Nombre del remitente
-   `rem_cargo` - Cargo del remitente
-   `rem_deporg` - Dependencia/Organización del remitente
-   `rem_id` - ID del usuario remitente (FK a users)
-   `rem_dir` - Dirección del remitente
-   `des` - Descripción
-   `seguimiento` - Seguimiento
-   `tur_nom` - Nombre del turnado
-   `tur_cargo` - Cargo del turnado
-   `tur_deporg` - Dependencia/Organización del turnado
-   `creo` - ID del usuario que creó (FK a users)
-   `modifico` - ID del usuario que modificó (FK a users)
-   `reporte` - Reporte
-   `estatus` - Estatus (boolean)
-   `created_at` - Fecha de creación
-   `updated_at` - Fecha de actualización
