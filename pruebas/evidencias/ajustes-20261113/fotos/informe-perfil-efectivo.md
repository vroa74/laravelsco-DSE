# Perfil/fotos efectivos — up000066

El alias del perfil es el de Jetstream, no la clase local homónima. Se conservan su redirect tras foto y sus eventos nativos. User protege escritura/persistencia/baja; Fortify guarda datos y foto en una escritura. Lista/detalle/edición/navegación usan URL autenticada versionada. Vista efectiva muestra fallback de archivo ausente; diálogos abiertos de Usuarios ya no llevan aria-hidden.

27 pruebas/129 aserciones en7.668s; Pint y build8.99s. SQLite :memory:, archivos/temporales sintéticos en /pruebas; BCRYPT_ROUNDS4 solo en el proceso de pruebas. Cobertura de falso retorno de escritura/DB, bajas, conservación anterior, bytes servidos, HTML de consumidores y perfil efectivo tras redirect. La primera prueba asumía un evento saved tras foto; esa expectativa era incorrecta y se corrigió. Los casos de guardado cancelado sí reproducían la retirada prematura del archivo/falso éxito.

Sin aplicación real, MySQL, vendor o DDL modificados. Validación real del servidor y aceptación estética pendientes; no afirmar fotos verificadas en producción. La clase/vista alternativa inactiva se preserva sin cambios propios. Decisiones de roles confirmadas se documentan en DOC/sistema/fase-2.md; su aplicación completa sigue pendiente.
