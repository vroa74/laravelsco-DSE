# Reglas funcionales confirmadas

Decisiones expresas del usuario: 12/11/2026. Estado: reglas documentadas para implementación en las fases correspondientes; esta entrega no modifica datos ni activa procesos.

## Cuentas: edad mínima

- Se permite desde los 18 años cumplidos, incluido el día del cumpleaños 18.
- Laravel valida la fecha de nacimiento y la edad al crear cuentas y en cambios pertinentes. La validación del navegador complementa la del servidor.
- Diseñar una fecha de nacimiento de cuenta protegida, sin exponerla en listados generales ni registros técnicos. El esquema actual revisado de users no incluye ese campo: su migración y validación corresponden a una implementación posterior autorizada.
- No inventar fechas para cuentas existentes ni desactivarlas masivamente. La conciliación de registros reales exige autorización específica; mantener explícitos los casos sin datos suficientes.
- El alcance es cuentas de usuario; no prohibir por inferencia que existan menores u otras personas en un directorio que no sean usuarios.
- Pruebas previstas con fechas ficticias: cumpleaños 18 aceptado, día anterior rechazado, nacimiento futuro rechazado y ausencia inválida en una cuenta nueva.

## Adjuntos: plazo de borrado

- Plazo definitivo: 15 días naturales fijos desde la publicación. Incluye sábados, domingos y festivos. No se calcula un calendario de días hábiles.
- Cómputo: published_at + 15 días naturales, manteniendo la hora institucional America/Mexico_City y almacenando un instante inequívoco. A partir de expires_at se deniega la descarga.
- El proceso de borrado físico se ejecuta con autorización y puede reintentar si falla; el retraso del trabajador no prolonga el derecho de descarga.
- El oficio, los metadatos, las procedencias, las constancias y el historial permanecen. No se elimina la fila para ocultar el borrado físico.
- La consulta, una edición, cargas posteriores o reintentos no reinician automáticamente la retención. Reenvío/republicación conserva la política explícita correspondiente.
- No inventar fecha de publicación del histórico ni aplicar una limpieza retroactiva sin régimen y autorización específicos.
- El plazo anterior de diez días de los PDF queda como antecedente, sustituido por la precisión del usuario. No se cambia automáticamente el subsistema independiente report_files.
- Pruebas previstas con datos sintéticos: un instante antes del corte, exactamente en el corte y después; inclusión de fin de semana/festivo, reintento de borrado y conservación de metadatos.

## Verificación de esta entrega

Lectura posterior y coherencia de referencias verificadas. Sin migraciones ejecutadas, cambios de cuentas, borrado físico, Scheduler, .env ni acceso a MySQL. Estas reglas no acreditan todavía validaciones o limpieza implementadas.
