# Diccionario y registro del primer recorrido

Fecha: 12/11/2026. Decisión técnica del coordinador para F1.1. Este contrato fija el destino de implementación; no acredita el esquema real de MySQL ni ejecuta DDL. El mapeo completo de las 11 columnas age y 28 columnas co/co_hist sigue en my_proyect.md §8; no duplicarlo ni perder originales.

## Fuente canónica y compatibilidad

- Co es el modelo canónico de cos y RgController conserva las rutas rg.*. No crear un CRUD paralelo ni renombrar rutas por adoptar Svelte/Inertia.
- Cos sigue activo en tres relaciones de User.php: líneas 124, 132 y 140 en la revisión. Conservarlo hasta migrar y probar esos consumidores; corregir la afirmación del informe delegado de que no tenía consumidores.
- rem_id actual está semánticamente mezclado: Create/Edit lo usan como usuario destinatario, la migración lo referencia a ages y Co::remitente lo vincula a User. Se conserva como legado; no aplicar un backfill por semejanza de nombres.
- tur_id/tur_group_id/tur_type y los textos rem_*/tur_* se preservan como representación histórica. Las asignaciones/publicaciones nuevas son la fuente de distribución nueva; no forzar una sola FK heredada como representación de múltiples destinatarios.
- ages queda disponible como legado. people/institutions y sus asignaciones separan identidades conocidas, sin crear personas ficticias para resolver ambiguos.

## Tipos y restricciones fijados para el recorrido

| Campo/familia | Contrato físico de destino |
| --- | --- |
| PK/FK nuevas | BIGINT UNSIGNED, compatibles con id() de users/cos/ages/grupos observado en migraciones. Restrict en evidencia histórica; bajas lógicas. No usar un ID Delphi repetido como PK nueva. |
| cos.nofi | VARCHAR(100), sin índice único. Nullable para conservar legado; la ampliación no elimina las otras validaciones de nuevas capturas. Preservar el original de fuente. |
| cos.remitente_type | VARCHAR(16): person, institution o legacy. En nuevas capturas exactamente un principal; legacy no inventa una identidad conciliada. |
| cos.remitente_person_id / remitente_institution_id | BIGINT UNSIGNED nullable, FK a people/institutions. XOR según tipo en la publicación nueva; legado puede permanecer sin ambas referencias. |
| people | Nombres/apellidos VARCHAR(100), título VARCHAR(20), contactos hasta 255 y dirección TEXT; estado activo y timestamps. No unicidad por nombre/correo ni recorte del original. |
| institutions / institution_types | Nombre legal/cargo hasta 255, nombre corto opcional 100; tipo por FK, código de tipo 64 único y estado activo. No unicidad de institución solo por nombre. |
| person_institution_assignments | person_id, institution_id BIGINT UNSIGNED; cargo VARCHAR(255); vigencias DATE nullable e identificador de actor. No fabricar vigencias históricas. |
| users.birth_date (fase 2) | DATE nullable durante transición de registros existentes; requerido y validado por servidor para cuentas nuevas, mínimo 18 años cumplidos. Fecha privada, sin fechas ficticias para cuentas reales. |
| users.person_id (fase 3) | BIGINT UNSIGNED nullable; unicidad final solo después de conciliación autorizada. No duplicar el modelo/controlador de users por una migración adicional. |
| cos.publication_status | VARCHAR(32) separado de estatus legado. Legado identificado como legacy; publicado/cancelado nuevos solo por acciones autorizadas. |
| cos.published_at / eventos | DATETIME(6), instante normalizado UTC y presentación America/Mexico_City. Nullable si el hecho no existe/se desconoce; jamás rellenar histórico con ahora. Las fechas originales DATE conservan esa precisión. |
| cos.lock_version / cos_versions.version_number | BIGINT UNSIGNED no negativo; contador técnico inicial 0 y versión de contenido inicial 1 al publicar. Son responsabilidades distintas. |
| operation_key / request_hash | UUID en CHAR(36); SHA-256 CHAR(64) calculado en servidor sobre contenido canónico. Unique(actor_id, operation_key) en publicaciones. |
| snapshots de versiones | JSON con lista explícita de campos del documento y remitente autorizados, nunca request completo. Los originales tipados del ETL y los textos heredados no se sustituyen por ese JSON. |
| seguimiento, descripción y dirección | TEXT; Seguimiento nullable según origen. Conservar texto NULL y SQL NULL como originales distintos al conciliar; no normalizar el dump. |
| adjuntos | Mantener metadata existente; disk VARCHAR(64), mime_type VARCHAR(255), sha256 CHAR(64), bytes BIGINT UNSIGNED y fechas DATETIME(6) según evento. expires_at = publicación + 15 días naturales. |

Toda FK final, nulabilidad o índice que dependa de datos existentes se aplica después de conciliación y autorización, nunca para hacer pasar una migración sobre registros ambiguos. Los índices son parte del contrato funcional, no una mejora de rendimiento demostrada.

## Registro único por objeto y fase

Cada fila representa una migración propia de creación o alteración de una sola tabla; el timestamp se asigna al implementar. Cada tabla cuenta con su modelo/controlador/páginas propios del recurso. Los recursos internos e inmutables tienen consulta autorizada, no edición arbitraria ni navegación añadida por estética.

| Fase / objeto | Migración de trabajo | Modelo / controlador / páginas del recurso | Restricción central |
| --- | --- | --- | --- |
| 2 / users.birth_date | add_birth_date_to_users | User / controlador de usuarios existente y acciones de creación/perfil / páginas de usuarios | 18 años cumplidos en cuentas nuevas; legado sin dato pendiente de conciliación. |
| 2 / audit_events | create_audit_events | AuditEvent / AuditEventController / AuditEvents | Actor, recurso, acción e instante; sin secretos ni borrado por cascada. |
| 3 / institution_types | create_institution_types | InstitutionType / InstitutionTypeController / InstitutionTypes | Código único y estado activo. |
| 3 / institutions | create_institutions | Institution / InstitutionController / Institutions | FK al tipo; identidad no deducida solo del nombre. |
| 3 / people | create_people | Person (table people explícita) / PersonController / People | Persona independiente de cuenta; originales conservados. |
| 3 / person_institution_assignments | create_person_institution_assignments | PersonInstitutionAssignment / PersonInstitutionAssignmentController / PersonInstitutionAssignments | FKs, cargo y vigencia; baja conserva historia. |
| 3 / users.person_id | add_person_id_to_users | User / mismos controladores y páginas propios de users | FK nullable; unique solo tras conciliar. |
| 3 / user_group_membership_events | create_user_group_membership_events | UserGroupMembershipEvent / UserGroupMembershipEventController / UserGroupMembershipEvents | group_id, user_id, member_id, evento, instante y actor; mantener unique(user_id) de membresía actual. |
| 3 / catálogos existentes | alteración propia si procede por tabla | Modelos/controladores/páginas de ncors, tcors, ccors y legislaturas | No duplicar catálogos; tipo y clasificación coherentes, textos históricos conservados. |
| 4 / cos | add_publication_sender_and_version_to_cos | Co / RgController / Correspondence con presentación actual | Nofi 100, campos de remitente/publicación/versión; columnas originales intactas. |
| 4 / cos_versions | create_cos_versions | CosVersion / CosVersionController / CosVersions | cos_id, version_number, snapshot, actor, motivo e instante; unique(cos_id, version_number). |
| 4 / cos_publications | create_cos_publications | CosPublication / CosPublicationController / CosPublications | cos_id, cos_version_id, actor_id, published_at, operation_key, request_hash y tipo de evento; operación única por actor. |
| 4 / cos_recipients | create_cos_recipients | CosRecipient / CosRecipientController / CosRecipients | publication_id, tipo, user_id o group_id; exactamente uno. Índices únicos separados (publication_id,user_id) y (publication_id,group_id). |
| 4 / cos_recipient_members | create_cos_recipient_members | CosRecipientMember / CosRecipientMemberController / CosRecipientMembers | recipient_id, user_id, instantánea y snapshot_at; unique(recipient_id,user_id). |
| 4 / cos_deliveries | create_cos_deliveries | CosDelivery / CosDeliveryController / CosDeliveries | publication_id, cos_id, user_id, asignación, primera/última consulta y acuse; unique(publication_id,user_id). |
| 4 / cos_delivery_sources | create_cos_delivery_sources | CosDeliverySource / CosDeliverySourceController / CosDeliverySources | id técnico, delivery_id y recipient_member_id; pareja única y coherencia de evento/usuario. |
| 4 / cos_actions | create_cos_actions | CosAction / CosActionController / CosActions | cos_id, actor, tipo, instante y texto; seguimiento original no se reinterpreta en actuaciones inventadas. |
| 5 / cos_files | add_private_metadata_and_expiration_to_cos_files | CosFile / CosFileController / CosFiles | Disco privado, metadata permanente y corte desde publicación; no cascada destructiva de evidencia. |
| 5 / file_deletion_logs | create_file_deletion_logs | FileDeletionLog / FileDeletionLogController / FileDeletionLogs | Intento, operación, resultado seguro y reintento; sin eliminar metadata del documento. |

## Orden y garantías cruzadas

1. Users existente → auditoría/edad; luego tipos de institución, instituciones y personas; después asignaciones y vínculo nullable de cuenta.
2. Con permisos preparados: ampliación cos → versiones → publicaciones → destinatarios → snapshot de miembros → entregas → procedencias. Cada publicación valida al menos un destinatario y rechaza grupos vacíos.
3. Documento, versión, publicación, miembro y entrega deben referir el mismo contexto. Al implementar, agregar las claves compuestas/índices requeridos por el motor para esa coherencia y pruebas de IDs válidos de contextos distintos; las FKs aisladas no bastan.
4. Transacciones breves e idempotencia en publicación; archivos y notificaciones fuera de bloqueos largos. Una entrega efectiva conserva todas sus procedencias.
5. El registro de fuentes, ocurrencias y originales tipados del ETL mantiene el mapeo completo de my_proyect.md §7/8/13; se implementa una vez en fase 7 y requiere autorización propia. No hay importación ni backfill en esta fase.
6. La reversión conserva nuevos documentos, historia y referencias; no ejecutar down destructivo ni sustituir una base completa para volver al código anterior.

Este documento cierra el contrato técnico preparatorio de F1.1, sujeto a las decisiones de negocio ya identificadas para sus fases. No es evidencia de migraciones aplicadas o integridad comprobada en MySQL.
