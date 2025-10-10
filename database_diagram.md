# Diagrama de Relaciones de Base de Datos

## Diagrama Mermaid

```mermaid
erDiagram
    users {
        bigint id PK
        string name
        string rfc UK
        string curp UK
        string direction
        string position
        enum sex
        string lvl
        integer tipo
        boolean status
        enum theme
        string email UK
        timestamp email_verified_at
        string password
        string remember_token
        bigint current_team_id FK
        string profile_photo_path
        timestamp created_at
        timestamp updated_at
    }

    user_groups {
        bigint id PK
        string name
        text description
        boolean active
        bigint created_by FK
        timestamp created_at
        timestamp updated_at
    }

    user_group_members {
        bigint id PK
        bigint group_id FK
        bigint user_id FK
        bigint added_by FK
        timestamp created_at
        timestamp updated_at
    }

    cos {
        bigint id PK
        string legislatura
        date fcap
        date frec
        string ncor
        string tcor
        string ccor
        date fofi
        string nofi
        integer nhoj
        string rem_nombre
        string rem_cargo
        string rem_deporg
        bigint rem_id FK
        bigint tur_group_id FK
        string tur_type
        text rem_dir
        text des
        text seguimiento
        string tur_nom
        string tur_cargo
        string tur_deporg
        string creo
        string modifico
        string reporte
        boolean estatus
        timestamp created_at
        timestamp updated_at
    }

    cos_files {
        bigint id PK
        bigint cos_id FK
        string original_name
        string file_name
        string file_path
        string file_type
        bigint file_size
        text description
        string uploaded_by
        timestamp created_at
        timestamp updated_at
    }

    ages {
        bigint id PK
        char titulo
        char nombre
        char apaterno
        char amaterno
        char cargo
        char deporg
        char telefono
        char email
        text dir
        char modifico
        timestamp created_at
        timestamp updated_at
    }

    bitacoras {
        bigint id PK
        string accion
        string usuario
        text original
        text modificado
        timestamp created_at
        timestamp updated_at
    }

    legislaturas {
        bigint id PK
        string legislatura
        boolean actual
        timestamp created_at
        timestamp updated_at
    }

    ncors {
        bigint id PK
        string ncor
        timestamp created_at
        timestamp updated_at
    }

    ccors {
        bigint id PK
        string ccor
        bigint tcor_id FK
        timestamp created_at
        timestamp updated_at
    }

    tcors {
        bigint id PK
        string tcor
        timestamp created_at
        timestamp updated_at
    }

    sessions {
        string id PK
        bigint user_id FK
        string ip_address
        text user_agent
        longtext payload
        integer last_activity
    }

    password_reset_tokens {
        string email PK
        string token
        timestamp created_at
    }

    %% Relaciones
    users ||--o{ user_groups : "crea"
    users ||--o{ user_group_members : "es_miembro"
    users ||--o{ user_group_members : "agrega_miembro"
    users ||--o{ cos : "remite"
    users ||--o{ sessions : "tiene_sesion"
    users ||--o{ password_reset_tokens : "reset_password"

    user_groups ||--o{ user_group_members : "tiene_miembros"
    user_groups ||--o{ cos : "recibe_turnado"

    cos ||--o{ cos_files : "tiene_archivos"
    cos }o--|| users : "remitido_por"
    cos }o--o| user_groups : "turnado_a_grupo"

    tcors ||--o{ ccors : "tiene_clasificaciones"
```

## Descripción de las Relaciones

### Tablas Principales

1. **users** - Tabla de usuarios del sistema
   - Campos principales: name, email, position, tipo (0=root, 1=admin, 2=supervisor, 3=personal)
   - Relaciones: Crea grupos, es miembro de grupos, remite documentos

2. **cos** - Tabla principal de correspondencia/documentos
   - Campos principales: legislatura, fechas, remitente, destinatario
   - Relaciones: Pertenece a usuario remitente, puede ser turnado a grupo o usuario

3. **user_groups** - Tabla de grupos de usuarios
   - Campos principales: name, description, active
   - Relaciones: Creado por usuario, tiene miembros, recibe documentos turnados

### Relaciones Many-to-Many

- **user_group_members** (Pivot): Conecta usuarios con grupos
  - Un usuario puede pertenecer a un solo grupo
  - Un grupo puede tener múltiples miembros

### Relaciones One-to-Many

- **cos_files**: Archivos adjuntos a documentos
- **sessions**: Sesiones de usuario
- **password_reset_tokens**: Tokens de recuperación de contraseña
- **ccors**: Clasificaciones que pertenecen a tipos de correspondencia

### Tablas de Catálogos

- **legislaturas**: Legislaturas disponibles
- **ncors**: Niveles de correspondencia
- **tcors**: Tipos de correspondencia  
- **ccors**: Clasificaciones de correspondencia
- **ages**: Información adicional de usuarios/contactos
- **bitacoras**: Log de cambios en el sistema

### Características Especiales

1. **Turnado flexible**: Los documentos pueden ser turnados a usuarios individuales o a grupos
2. **Restricción única**: Un usuario solo puede pertenecer a un grupo
3. **Auditoría**: Tabla de bitácoras para rastrear cambios
4. **Archivos adjuntos**: Sistema de archivos vinculado a documentos
5. **Sistema de roles**: Campo 'tipo' en users para control de acceso
