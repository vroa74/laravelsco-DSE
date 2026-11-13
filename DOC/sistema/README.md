# Documentación del sistema SCO

Actualización:13/11/2026. Responsable: Codex, director del proyecto. Estado vigente: [estado-actual.md](estado-actual.md); fase activa: [Fase2](fase-2.md). La revisión estética general continúa abierta, con correcciones menores en paralelo por instrucción del CEO.

## Fuentes y alcance

- Reglas y registro obligatorio de cambios: [AGENTS.md](../../AGENTS.md).
- Análisis, dependencias y criterios por fase: [my_proyect.md](../../my_proyect.md).
- Esta carpeta mantiene documentación viva del sistema; no duplica el análisis ni sustituye las reglas.
- Ruta solicitada: `doc/sistema`. En Windows corresponde a la carpeta existente `DOC/sistema`; se conserva `DOC` y sus fuentes.
- La solicitud actual autoriza reestructurar por fases. Las restricciones antiguas de solo análisis describen las entregas previas.

## Responsables y control de entrega

- Coordinador: administración, arquitectura, revisión, integridad, seguridad, costos y documentación.
- Desarrollo delegado según AGENTS.md: DeepSeek/OmniRoute y NVIDIA/OmniRoute. En esta entrega visual el usuario asigna directamente a Codex implementación, revisión e integración; no hay escritores simultáneos en las mismas vistas.
- Usuario: revisión del diseño al cerrar cada fase, antes de avanzar a la siguiente.
- Toda entrega distingue observado, propuesto, implementado y probado; informa archivos, validación, pendientes y reversión.

## Decisiones confirmadas

| Decisión | Regla vigente |
| --- | --- |
| Interfaz | Svelte + Inertia tomando el diseño actual como base; mejoras estéticas permitidas sin cambiar funcionalidad ni flujos. Laravel conserva validación, autorización y persistencia. |
| Prioridad | Listado/búsqueda y captura antes del dashboard. |
| Remitente | Una persona o institución principal por oficio, representante opcional. |
| Publicación | Inmediata al confirmar, sin rol ni bandeja de aprobación separada. |
| Edad de cuentas | Desde los 18 años cumplidos; validación definitiva en Laravel, sin inventar fechas del legado. |
| Retención de adjuntos | 15 días naturales fijos desde publicación; borrar físico autorizado y conservar metadatos/historial. |
| Pruebas | Solo datos sintéticos en SQLite `:memory:`, previa comprobación de guardias. |
| Datos reales | Sin autorización para MySQL, importaciones o pruebas con el SQL histórico. |
| Organización | Migración por tabla y modelo/controlador/páginas propios por recurso. |
| Interfaz adaptable | Responsive obligatorio en todas las pantallas y estados: móvil, tableta y escritorio, claro/oscuro, teclado y sin scroll horizontal ni información indispensable oculta. |
| Concurrencia | Objetivo 2 capturistas + 40 consultantes; capacidad y latencias aún no medidas. |

## Presupuesto temporal solicitado

Objetivo confirmado el 12/11/2026: unas 2 horas de ejecución por fase, más el tiempo de revisión y aprobación del usuario. Sustituye la estimación preliminar de semanas, que no estaba respaldada por productividad medida.

| Fase | Objetivo técnico | Aprobación |
| --- | --- | --- |
| 0: base y contratos | 2 horas | Tiempo del usuario, registrado por separado. |
| 1: arquitectura y pruebas | 2 horas | Tiempo del usuario, registrado por separado. |
| 2: autenticación y autorización | 2 horas | Tiempo del usuario, registrado por separado. |
| 3: directorio, catálogos y grupos | 2 horas | Tiempo del usuario, registrado por separado. |
| 4: captura, publicación y consulta | 2 horas | Tiempo del usuario, registrado por separado. |
| 5: adjuntos privados y conservación | 2 horas | Tiempo del usuario, registrado por separado. |
| 6: interfaz Svelte/Inertia y reportes | 2 horas | Tiempo del usuario, registrado por separado. |
| 7: ETL y conciliación | 2 horas | Tiempo del usuario y permisos de datos aplicables. |
| 8: aceptación integral y operación | 2 horas | Tiempo del usuario y autorizaciones operativas aplicables. |
| Total objetivo | 18 horas técnicas | Más revisiones/aprobaciones. |

- Las 30 horas mencionadas previamente son referencia de presupuesto; no son una duración comprobada ni un consumo a agotar automáticamente.
- El presupuesto no demuestra viabilidad de cerrar todas las fases en ese tiempo. Cada cierre conserva sus criterios de aceptación, seguridad, pruebas autorizadas y documentación.
- Registrar inicio, fin, ejecución técnica, espera de aprobación y bloqueos con sus causas. El avance real y el consumo de tokens/costo todavía no están medidos por fase.
- Ante una desviación prevista de las 2 horas, informar pronto qué se obtuvo, qué falta y su efecto; no ocultar pendientes ni sustituir criterios por una demostración superficial.
- El alcance actualmente autorizado de datos sigue siendo SQLite en memoria con datos sintéticos; este presupuesto no autoriza MySQL, importación histórica ni despliegue.

## Costos, tokens y nube

- Dividir por tarea y revisar los archivos pertinentes; no recargar documentos completos en cada interacción.
- Reutilizar referencias y contratos aceptados, resumir resultados de herramientas y evitar consultas repetidas sin nueva evidencia.
- Usar un trabajador a la vez salvo tareas independientes que justifiquen concurrencia; no duplicar una asignación por silencio.
- Registrar tokens/costo por fase cuando la herramienta los informe; si no los informa, indicar no medido. Nunca incluir claves ni prompts con datos personales.
- El proyecto físico permanece obligatoriamente en `C:/laragon/www/laravelsco-DSE`, aunque se trabaje en la nube. Todo cambio debe integrarse y quedar visible aquí antes de revisión o entrega, conservando el trabajo local y resolviendo los conflictos de forma explícita. DeepSeek procesa inferencia remota mediante OmniRoute; cualquier servidor adicional se evalúa por tiempo total, costo y seguridad.

## Estado por fase

| Fase | Estado comprobado | Próxima puerta |
| --- | --- | --- |
| 0: base y contrato | Análisis y contrato cerrados; reglas iniciales resueltas y diseño existente confirmado. Ver [revisión de fase 0](fase-0.md). | Implementar respetando diseño/comportamiento existentes; alternativa descartada como referencia. |
| 1: diseño físico y pruebas | Preparación cerrada: diccionario y matriz revisados; F1.3 verificada con 62 aprobadas y 8 omitidas. Ver [fase 1](fase-1.md). | Presentar cierre al usuario; implementación de fase 2 e integración posterior según dependencias. |
| 2–8 | Pendientes; consultar tareas individuales en el plan. | Dependencias y aceptación de cada fase. |

## Registro de cambios y verificaciones

| Fecha/tarea | Archivos o componente | Cambio y evidencia | Pendientes |
| --- | --- | --- | --- |
| 12/11/2026: reglas | AGENTS.md | Se exige documentar todos los cambios en el archivo de reglas. Lectura posterior verificada. | Preservar modificaciones previas del usuario. |
| 12/11/2026: integración | Configuración compartida de OpenCode fuera del repositorio | Respaldo SHA-256 verificado; alias `modelID=ds/deepseek-flash`; contexto 1 000 000, presupuesto de entrada 900 000 y salida 8 192. Solo cambió la definición del modelo. | Catálogo CLI comprobado y segundo trabajador entregó análisis con herramientas; facturación por solicitud no verificada. |
| 12/11/2026: conexión | OmniRoute → DeepSeek | Catálogo anuncia `ds/deepseek-flash` con contexto 1 000 000; llamada mínima respondió `OK`. | Esta llamada no prueba ejecución de herramientas ni el desarrollo. |
| 12/11/2026: coordinación | AGENTS.md y DOC/sistema/README.md | Se asignan responsabilidades, documentación, política de costos/tokens y decisiones nuevas del usuario. | Revisar la entrega de DeepSeek. |

| 12/11/2026: copia local obligatoria | AGENTS.md y DOC/sistema/README.md | El usuario confirma que el proyecto físico debe seguir en este equipo y mostrar aquí los cambios, incluso si se trabaja en la nube. Lectura posterior verificada. | Aplicar esta condición a cada entrega; no hay traslado ni despliegue. |

| 12/11/2026: presupuesto temporal | AGENTS.md y DOC/sistema/README.md | Objetivo solicitado de 2 horas por fase y aprobación aparte; nueve fases equivalen a 18 horas técnicas. Lectura posterior y suma verificadas. | Medir ejecución real, aprobaciones y desviaciones; objetivo sin garantía de duración. |

| 12/11/2026: captura y diseño de referencia | AGENTS.md, my_proyect.md y DOC/sistema/fase-0.md | Oficio hasta 100 caracteres; Seguimiento y fechas según esquema SQL; mínimo un destinatario y bloqueo de grupos vacíos. El usuario exige conservar diseño y comportamiento actuales. SQL leído como texto y resultados agregados; maqueta alternativa no aceptada. | Rehacer la paridad visual con datos sintéticos; sin migraciones ni MySQL. |

| 12/11/2026: cierre de fase 0 | AGENTS.md, my_proyect.md y DOC/sistema/fase-0.md | Contrato revisado y preguntas iniciales resueltas; usuario confirma conservar diseño y comportamiento existentes. Se evita otro rediseño y se prepara fase 1. | Sin código de producto ni pruebas de aplicación ejecutadas; duración consolidada y costo no medidos. |

| 12/11/2026: estética y responsive | AGENTS.md, my_proyect.md y DOC/sistema | El usuario permite mejoras estéticas sobre el diseño actual, preservando funcionalidad y flujos; responsive obligatorio en todas las pantallas y estados. Lectura posterior verificada. | Revisar visualmente las mejoras al implementar cada fase; esta actualización no modifica la UI. |

En F1.3 el desarrollador ejecutó pruebas exclusivamente sintéticas en SQLite en memoria; sus resultados y la revisión pendiente están en fase-1.md. No se accedió a MySQL. La fase 0 de análisis está cerrada y el usuario confirmó el diseño existente; todavía no hay fase de implementación terminada. El consumo total de tokens y el costo por fase no están medidos.

Documentos vigentes de preparación: [diccionario](diccionario-primer-recorrido.md), [compatibilidad](compatibilidad-y-transicion.md) y [reglas funcionales](reglas-funcionales.md). La interfaz no se modificó en esta fase.
