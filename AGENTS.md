**Registro — 12/11/2026, arranque NVIDIA (up000049):** La inferencia y llamada a herramienta funcionaron, pero el primer trabajador falló por compactación. El alias se había limitado a 128000 tokens a partir del catálogo del gateway. Se ajustó únicamente su límite declarado a contexto 262144, entrada 240000 y salida 8192 según la documentación oficial de Nemotron Ultra (contexto nativo 256K; hasta 1M según despliegue), con respaldo SHA-256 y comparación del resto de configuración. No se midió el máximo del endpoint alojado ni se declara resuelto el arranque hasta recibir actividad/informe. Se detuvo con confirmación el intento fallido; reintento de la misma tarea pendiente. DeepSeek backend ya tiene recibo de arranque, todavía sin informe. Sin cambios de producto ni datos.

**Registro — 12/11/2026, límite del gateway NVIDIA (up000050):** El segundo intento confirmó que el rechazo procedía del límite 128000 del gateway, no del alias OpenCode. Se guardó evidencia anterior/posterior sin secretos en pruebas/evidencias/integracion-nvidia y se configuró, mediante la API de administración existente de OmniRoute, una única excepción de contexto 262144 para nvidia/nemotron-3-ultra-550b-a55b, respaldada por documentación oficial. PUT HTTP 200, lectura posterior del override y catálogo /v1/models con contexto 262144 verificados; sin cambios de claves ni otros modelos. Intento fallido detenido con confirmación; siguiente reintento pendiente, no se declara ejecutado el análisis frontend. DeepSeek entregó la matriz de contratos backend en solo lectura. Sin acceso a datos de SCO ni cambios de producto.

**Registro — 12/11/2026, fondo de acceso plateado (up000051):** Por autorización puntual del usuario se aplica solo escudo sin letras, plateado y más grande. resources/views/layouts/guest.blade.php referencia el PNG existente public/media/img/campechecon.png; resources/css/app.css centraliza el fondo, filtro grayscale(100%) brightness(1.35) contrast(1.1), ancho min(94vw,1100px), max-height90svh y object-fit:contain. Conserva opacidad80 y gradientes previos, decoración aria-hidden sin interacción; el original PNG no se edita. Build del trabajador correcto (19.13s); coordinador comprobó CSS compilado, diff check y guardias, y ejecutó regresión sintética SQLite en memoria: 22 pruebas, 45 aserciones, 87.54s. Evidencia y vista previa estática en /pruebas. Pendiente revisión renderizada/móvil y aceptación estética; no equivale a estandarización general. Se integra únicamente el PNG consumido, sin otros archivos nuevos/modificados del usuario. Sin MySQL, backend ni dependencias modificados en esta entrega.

**Registro — 12/11/2026, pausa expresa del usuario (up000053):** Se avisa y detiene la tarea de homogeneización global `task_8d50282dc798` / `ctx_af5970bf42a6`; Orca confirma stopped/closed_agent_terminal. Se conserva el estado local de resources en pruebas/reanudacion/20261112-175516, sin revertir ni commitear producto inconcluso. DOC/sistema/reanudacion.md recoge objetivo, estado, pendientes y pasos de reintento del mismo Task. No se deja ejecución remota ni se traslada el proyecto. Pausa solicitada por el usuario; sin build/pruebas adicionales ni acceso a datos. Estandarización global NO terminada; esperar instrucción de reanudar.

**Registro — 12/11/2026, reanudación autorizada (up000054):** El usuario solicita «continuemos». Se leen la nota y checkpoint de pausa, reglas, plan y diferencias locales; no se restaura ni sobrescribe el estado. La implementación global sigue incompleta: resources/css/app.css conserva una base de tokens de206 líneas y las diferencias previas de grupos permanecen. Catálogo de OmniRoute HTTP200 y contexto NVIDIA262144 comprobados; alias local preservado. Se prepara reintento del mismo Task task_8d50282dc798 desde ctx_af5970bf42a6, cuya detención estaba confirmada. Esta entrega solo registra la reanudación y revisiones; no acredita arranque posterior, build, pruebas ni homogeneización terminada. Sin MySQL ni cambios nuevos de producto.

**Registro — 13/11/2026, backend de fotos revisado (up000061):** DeepSeek corrige las dos altas y la edición de fotografías en app/Livewire/Usuarios/Index.php; User centraliza validación de ruta y URL persistida versionada; UsuarioFotoController y routes/web.php sirven la imagen desde el disco public mediante rutas autenticadas. Se comprueba archivo escrito y persistencia antes de retirar la foto anterior. Coordinación conserva BMP y evita borrar rutas históricas ajenas a profile-photos. Evidencias y pruebas en pruebas/Feature/FotosPerfilUsuarioTest.php y pruebas/evidencias/ajustes-20261113/fotos; DOC/sistema/ajustes-20261113.md documenta contratos y relevo de PDF de DeepInfra a Gemini tras fallo de compactación y detención confirmada. Validación: guardia previa aceptada sin cargar Laravel; PHPUnit directo,21 pruebas/94 aserciones,3.421s; Pint limpio en los cinco PHP afectados. SQLite :memory: y archivos sintéticos en /pruebas; sin MySQL, migraciones, .env, servidor real ni cambios de dependencias. Pendiente integrar y verificar vistas de lista/detalle/edición/perfil, estilos y PDF; no se anuncia resuelta la incidencia visual. Sin build por ser una entrega de backend.

## Dirección, evaluación y avisos — 13/11/2026

- El usuario es el CEO; Codex es el director del proyecto y responde por planificación, asignaciones, arquitectura, calidad, seguridad, tiempo, tokens, revisión, documentación e integración local. Resolver la ejecución técnica dentro del alcance autorizado; elevar al CEO decisiones de negocio, cambios de diseño para aceptación y bloqueos que requieran su intervención.
- Evaluar agentes por resultados verificables, corrección, eficiencia y comunicación. Tras dos fallos iguales de herramienta, exigir escalación y detener esa secuencia; si no hay resultado concreto en diez minutos, revisar causa y entrega mínima. Reasignar si procede, confirmando detención antes de compartir archivos. No confundir actividad con avance ni castigar consumiendo más recursos.
- Avisar cada tarea terminada con 🟢 TERMINADA Y VERIFICADA; usar 🟡 EN REVISIÓN/CON PENDIENTES o 🔴 BLOQUEADA/ERROR según el estado real. Identificar tarea, resultado, verificación y pendientes. El aviso no espera al cierre de la fase completa.

**Registro — 13/11/2026, evaluación y redistribución (up000062):** Se evalúan entregas y transcripciones de DeepSeek, NVIDIA, Gemini y DeepInfra en DOC/sistema/rendimiento-agentes.md. Se confirma stopped/closed_agent_terminal y liberación de los dos intentos Gemini bloqueados en herramientas; estilos pasa a Codex y PDF a DeepSeek en la misma tarea, con recibo ctx_7b5e1d140c1c. Se registra el rechazo previo de una combinación inválida de argumentos de coordinación, corregido sin duplicar tareas. Por nueva instrucción del CEO se aprovecha Gemini en redacción acotada por OmniRoute: diez microtextos, HTTP200, JSON válido,4.669s y772 tokens declarados; ayudas no sustentadas corregidas y propuesta todavía sin aplicar. Archivos: AGENTS.md, README.md, DOC/sistema/ajustes-20261113.md y rendimiento-agentes.md, brief, helper Node y evidencias JSON bajo /pruebas. Validación: recibos de detención/arranque, estructura JSON y node --check; sin build o pruebas de aplicación al no cambiar producto, MySQL, datos reales, dependencias ni configuración privada. Estilos, vistas y PDF continúan pendientes de entrega verificada; la evaluación no acredita capacidad general ni costo monetario de modelos.

**Registro — 13/11/2026, contornos degradados y modal marino (up000063):** Codex integra recursos comunes después de confirmar detenido Gemini: resources/css/app.css y components/modal.blade.php/dialog-modal.blade.php. El CEO rechaza el modal blanco y ratifica el gestor de miembros como referencia: se sustituye por azul marino temático, texto claro, borde/cierre visibles, listas y distribución conservadas; botones Gradient outline, editar naranja intenso y PDF cyan/azul. No cambia el escudo global0.12, paneles principales0.62 ni el velo claro previo del usuario, que queda fuera del commit. Nuevo fixture de componentes reales y verificador offline en /pruebas; validación: Vite10.84s, Pint,23 pruebas/51 aserciones en SQLite :memory:,6 escenarios con12 capturas en375/768/1366 y ambos temas; foco, trampa de Tab, Escape/cierre, campos y contornos sin errores ni desbordamiento. Contraste mínimo de botones4.75:1. Son componentes exportados con adaptador Alpine local, no prueba de la aplicación real ni de todos los estados de cada CRUD. Se preservan pendientes de integración las vistas/fotos y PDF; el intento PDF DeepSeek terminó por salida inesperada de OpenCode y fue detenido con confirmación, sin mejora acreditada. Sin MySQL, datos reales, dependencias ni configuración privada modificados; public/build solo generado localmente.

**Registro — 13/11/2026, botones Agregar en barras de RG/directorio (up000064):** A partir de las dos capturas del CEO se corrige el estado local de resources/views/livewire/reportesgral/index.blade.php y people.blade.php: se elimina la celda exclusiva de Agregar y se restaura el botón en la fila superior junto a PDF/CSV/filtros, recuperando8 y4 bloques de filtros respectivamente. Esa posición ya existía en HEAD: la corrección revierte únicamente el desplazamiento local delegado, sin cambio versionable en index de RG. Se revisan e integran los ajustes pendientes de modales de People y se corrige un h3 de edición cuyos atributos habían quedado como texto duplicado; acciones y datos conservados. Archivos versionados: people.blade.php, exportador/verificador bajo /pruebas, evidencia de barras, AGENTS.md, README.md y DOC/sistema. Validación: Vite7.79s, Pint; exportación sintética1 prueba/11 aserciones en SQLite :memory:,incluido modal de edición;12 capturas de las dos rutas, ambos temas y375/768/1366 sin desbordamiento, con Agregar único en la misma fila que PDF y cuadrícula original restaurada. Sin MySQL, aplicación real, datos personales ni backend modificado. Las evidencias de imagen sirven para distribución; el exportador sustituye imágenes por decoración sintética y no acredita fotos/logotipos del servidor. Fotos completas/PDF y otras vistas continúan pendientes de revisión separada.

## Uso vigente de ayudantes y crédito — 13/11/2026

- Gemini3.1 Flash Lite queda sin nuevas asignaciones por instrucción del CEO. Después de comunicar3.8 Flash listo, el CEO autoriza su comprobación mínima; Gemini3.8 solo recibirá tareas acotadas y verificables tras demostrar el ciclo que necesite. No confundir una prueba API con un trabajador Orca/OpenCode operativo.
- Gemini se usa únicamente mientras exista crédito disponible: sin recargas ni renovación autorizadas. Ante saldo/cuota agotados, detener sus asignaciones y continuar con otras opciones; no repetir solicitudes para forzar la cuota. No se conoce aquí el saldo restante ni se modificó facturación o fallback global.
- NVIDIA queda limitado a tareas básicas, pequeñas y verificables. DeepSeek sigue por OmniRoute; la salida inesperada del proceso OpenCode es un fallo del ejecutor observado y no demuestra incapacidad de DeepSeek o del gateway. Codex conserva dirección, código principal y revisión.

**Registro — 13/11/2026, degradados vivos y Gemini3.8 (up000065):** Se aplica la aclaración del CEO sobre el patrón Flowbite: resources/views/components/{button,secondary-button,danger-button,icon-action}.blade.php componen exterior degradado y span interior; resources/css/app.css centraliza pares de colores claramente distintos, hover transparente y extremos de relleno contrastados. Se conserva compatibilidad CSS de botones heredados y el modal marino aprobado. Fixtures/verificador en /pruebas usan los componentes reales. Validación: Vite15.46s, Pint,14 pruebas/32 aserciones en SQLite :memory:,6 casos/12 capturas en ambos temas y375/768/1366 sin fallos, hover transparente, tonos distintos y contraste mínimo5.015:1. Se documenta la aprobación condicional del CEO de pasar a la siguiente fase con este ajuste, sin dar por concluidas correcciones funcionales pendientes. Nuevo helper comprueba Gemini3.8 Flash por OmniRoute con herramienta sumar ejecutada localmente y respuesta final4:216 tokens declarados,3.414s; sin código/datos de SCO enviados ni claves/configuración cambiadas. No acredita trabajador completo Orca. Reglas actualizadas: Gemini solo hasta agotar crédito, sin renovación; NVIDIA tareas básicas; DeepSeek mantiene gateway. Archivos y límites en README/DOC/sistema y evidencias. Sin MySQL, aplicación real, dependencias ni datos reales; otros parches locales permanecen separados.

## Estado y permisos confirmados por el CEO — 13/11/2026

- Fase activa:2, identidad/autenticación/autorización. La interpretación anterior de la aprobación visual condicional no cerró la revisión estética; posteriormente el CEO autorizó expresamente continuar Fase2 con el detalle de grupos como corrección menor. No declarar uniformidad integral ni fase completa sin su revisión.
- Matriz de negocio confirmada: tipo0 Superadministrador con acceso total; tipo1 Administrador; tipo2 Supervisor con captura/edición/consulta general y administración de usuarios, grupos y catálogos; tipo3 Usuario consulta exclusivamente oficios que le turnaron. El nombre actual del tipo2 es Supervisor, no Editor. Son decisiones aprobadas; la aplicación completa en servidor sigue en implementación, no se acredita por esta documentación.
- Lista, búsqueda, conteo, detalle, exportación/PDF y adjuntos deben respetar el mismo alcance. No conceder acceso por coincidencia de nombres o por rem_id ambiguo; preservar el legado sin reclasificar ni conciliar registros automáticamente. Valores nulos/desconocidos no se convierten en tipo0 por un cast numérico.

**Registro — 13/11/2026, fotos del recorrido efectivo (up000066):** Se identifica que el alias profile.update-profile-information-form lo registra Jetstream; la clase local homónima y su vista alternativa no son el recorrido efectivo. Se descartan únicamente las ediciones propias a esa vista inactiva. User.php protege escritura/sustitución/baja de foto y UpdateUserProfileInformation de Fortify guarda datos y referencia en una escritura, conservando el flujo de redirección/notificación existente. La lista/detalle/edición de Usuarios y ambas navegaciones consumen profile_photo_url; la vista efectiva profile/update-profile-information-form muestra fallback si falta archivo. Se integran títulos/cierres de los modales de Usuarios y se retira aria-hidden de diálogos realmente abiertos. Pruebas amplían FotosPerfilUsuarioTest y evidencias bajo /pruebas. Resultado:27 pruebas/129 aserciones en SQLite :memory:,7.668s, Pint y Vite8.99s; archivos/temporales sintéticos en /pruebas. La primera expectativa de evento saved era incorrecta para el componente efectivo, que redirige después de cargar foto: se corrigió la prueba; los casos de guardado cancelado sí reproducían pérdida de archivo/falso éxito y quedan cubiertos. Sin MySQL, servidor con datos reales, DDL, credenciales ni vendor modificado. Revisión estética de las pantallas reales pendiente; permisos de Fase2 y PDF no se declaran terminados. Registro y estado en DOC/sistema/fase-2.md y estado-actual.md.

**Registro — 13/11/2026, detalle de grupos contenido (up000067):** Se corrige únicamente la estructura del diálogo de detalle: encabezado, datos y pie dentro de un mismo panel marino; cierre alineado a la derecha y contenido largo desplazable dentro del panel. Conserva campos y acción closeModal. Validación: PHPUnit1 prueba/10 aserciones,57.748s; Pint limpio; Vite11.69s; seis capturas offline en375/768/1366 y ambos temas, sin desbordamiento ni cierres fuera del panel. No es una prueba del servidor real. Pruebas/evidencias bajo /pruebas; sin MySQL, datos reales o cambios de negocio. Los ajustes anteriores de membresías fuera de este bloque permanecen separados. Fase2 continúa abierta.

## Ajustes autorizados: outline, modales, fotos y reportes — 13/11/2026

- Botones internos: patrón Flowbite Gradient outline con capa exterior degradada y span interior del tema que se vuelve transparente en hover, según el código aportado por el CEO. Los dos extremos deben ser claramente distintos y llamativos, no dos tonos casi iguales: agregar/guardar verde→azul, editar naranja→ámbar, ver amarillo→lima, eliminar rojo→fucsia, normal azul→cyan, especial violeta→azul, solicitud turquesa→lima, PDF cyan→azul, CSV cielo→turquesa y secundario gris azulado→azul. Mantener iconos, tamaños, foco y significado; rojo reservado para eliminar. Profundizar los extremos en hover cuando sea necesario para contraste mínimo4.5:1, sin atenuar el texto.
- Referencia de modales ratificada por el CEO el 13/11/2026: el gestor de miembros de la imagen aprobada. En tema oscuro usar azul marino (#08162b como base), letras claras, campos oscuros, listas delimitadas y distribución compacta; no panel blanco. Panel del modal al98% para separarlo de la página, borde/sombra definidos y backdrop independiente al50%, sin atenuar el contenido. En claro usar azul grisáceo claro con tinta oscura. El cierre es visible, tiene nombre accesible y objetivo de44px. Los botones siguen Gradient outline y los colores semánticos; la corrección de contraste no autoriza rediseñar la distribución. Esta instrucción sustituye el panel semiblanco anterior.
- Un solo botón de búsqueda uniforme por sección de captura/edición RG (Descripción, Remitente, Seguimiento, Turnado). La futura distinción persona/grupo no se añade todavía. Conservar el selector canónico correspondiente y no inventar nuevos pasos de negocio.
- La acción Agregar/Crear de un listado se ubica en la fila superior de su barra interna, junto a Exportar y Aplicar filtros, fuera del cuerpo plegable y de la cuadrícula de campos. Nunca crear una celda o fila de filtros exclusiva para Agregar. Debe seguir disponible al plegar filtros, conservar el orden de acciones y adaptarse a móvil sin desplazamiento horizontal.
- En listas de selección, distinguir nombre, cargo, dirección y correo mediante jerarquía y tonos grises compartidos con contraste suficiente; preservar información y permitir ajuste de línea, sin paletas locales por CRUD.
- Fotos: alta, persistencia, listado, detalle y edición deben compartir un contrato de URL accesible; temporaryUrl solo describe la carga temporal. No borrar una foto anterior antes de completar con seguridad su sustitución. No reemplazar public/storage ni tocar datos reales por inferencia; reproducir con archivos y cuentas sintéticos.
- Cada PDF identifica su tipo (normal, especial, solicitud) en filename y título. Mejoras de rendimiento deben medirse con el mismo fixture; no cachear PDFs de usuarios de forma compartida ni retirar contenido o fondo para aparentar velocidad.
- El usuario autoriza desarrollar estos ajustes en paralelo: Gemini estilos comunes, DeepSeek backend de fotos, DeepInfra reportes y NVIDIA vistas. Cada archivo tiene un propietario; coordinación conserva revisión, documentación e integración. No anunciar trabajadores activos por una mera asignación. No arrancar la app con datos reales ni acceder a MySQL.

**Registro — 13/11/2026, preparación de cuatro encargos (up000060):** Se documentan las observaciones autorizadas y se crean briefs pequeños sin información personal en pruebas/encargos/20261113-ajustes. Se añaden dos aliases a la configuración compartida de OpenCode (Gemini Flash Lite y DeepInfra Qwen), con respaldo SHA-256 verificado y comparación del resto intacto, usando IDs y contextos del catálogo OmniRoute y herramientas ya comprobadas. No modifica claves, MCP, plugins, configuración de Codex ni producto de SCO; la configuración corresponde al consumidor OpenCode de los trabajadores y no cambia el modelo coordinador ni acredita prueba en Codex Desktop/CLI. Detención antigua de NVIDIA confirmada exited, recurso liberado con recibo antes de reasignar; ningún escritor previo activo en los archivos. OpenCode CLI2.1.4 lista los cuatro aliases previstos; el arranque posterior debe acreditarse por recibos y no se declaran todavía implementados los ajustes. Sin datos reales o MySQL.

## Prioridad temporal de Gemini y comprobación de modelos — 13/11/2026

- El usuario incorpora Gemini 3.1 Flash Lite y precisa que se usará primero su saldo disponible, sin contar con renovarlo. Priorizarlo para las próximas tareas compatibles; esta preferencia no autoriza gastar tokens sin objetivo, duplicar trabajo ni lanzar agentes con historiales grandes.
- Antes de asignar trabajo a una conexión nueva, comprobar una tarea sintética pequeña y la generación de una llamada de herramienta. Una conexión marcada active o un catálogo disponible no demuestran inferencia real. No enviar código, datos del proyecto ni credenciales para estas pruebas.
- Pruebas directas verificadas por OmniRoute: `gemini/gemini-3.1-flash-lite` y `deepinfra/Qwen/Qwen3.6-35B-A3B`, ambos HTTP200 y llamada `report_ready` con suma4/estadoOK validada. Gemini no emitió herramienta con128 tokens de salida y sí con384; Qwen pasó con128. Tres solicitudes:825 tokens declarados por la API (Gemini463; DeepInfra362), sin equivalencia monetaria demostrada.
- El alcance acreditado es respuesta y generación de llamada de herramienta por API. No equivale a ejecutar un trabajador completo de Orca/OpenCode, editar el proyecto con esos modelos ni comprobar su facturación o cuota. No se modificaron claves, aliases o configuración compartida por esta comprobación.

**Registro — 13/11/2026, modelos nuevos y prioridad de consumo (up000059):** Se leen metadatos de las cuatro conexiones activas y se prueban únicamente Gemini y DeepInfra, que no tenían esta comprobación directa. Tarea sintética2+2 mediante report_ready, sin archivos ni datos de SCO. Ambos responden y sus argumentos se validan; Gemini requiere una segunda solicitud con mayor límite de salida. Se registran825 tokens reportados por API y límites honestos de la prueba en DOC/sistema/modelos-ia.md y pruebas/evidencias/integracion-modelos-20261113. Se incorpora la preferencia del usuario de usar primero Gemini sin renovación prevista. Validación documental y JSON de evidencia; sin build o pruebas de aplicación por no cambiar producto. Sin MySQL, .env, dependencias ni configuración privada modificados. Integración como trabajador completo no probada.

## Reglas visuales ratificadas y orden MVC — 12/11/2026

- La instrucción más reciente asigna a Codex la corrección directa y su verificación. Se detuvo con confirmación el Dispatch NVIDIA `ctx_64106dc0f9ed` antes de editar; no hay dos agentes autorizados escribiendo las mismas vistas. El reparto previo queda como antecedente para otras tareas, no como impedimento para esta entrega.
- Paleta única con degradados: agregar/guardar = verde; editar = naranja; ver/show = amarillo; eliminar/destructivo = rojo. Rojo nunca identifica una exportación. Mantener nombre accesible e icono; no comunicar únicamente por color.
- Reporte normal = azul, especial = violeta, solicitud = turquesa; exportar PDF = cyan/azul, CSV = azul petróleo; filtros = azul y cancelar/volver = azul grisáceo. Misma acción conserva variante en todas las pantallas.
- Escudo de fondo atenuado por la última instrucción: opacidad de imagen 0.12 (88% transparente), después del ajuste local del usuario a0.15. Debe percibirse tenuemente; esto es independiente del alfa de los paneles y no atenúa el texto. Mantener PNG original y filtro plateado.
- Tablas y paneles principales: azul marino `rgb(7 24 51 / .62)` en oscuro y superficie clara equivalente en light. El alfa 0.62 sustituye la exigencia anterior de 0.8 por petición de mayor transparencia. Texto e iconos al 100%; una sola capa por panel, sin fondos de fila opacos ni desvanecer descendientes.
- Todos los controles comparten pares explícitos de superficie/texto, opciones, placeholder, autofill, foco y deshabilitado. Calendario y select nativos reciben `color-scheme` acorde al tema; su dibujo final depende del navegador y sistema operativo, no se reemplazan por un nuevo flujo por iniciativa estética.
- **Comentarios por selector CSS:** cada bloque de app.css, incluidos selectores agrupados, estados hover/focus/disabled, pseudoelementos y condiciones responsive, debe explicar en español su finalidad y los elementos que afecta. Documentar las variables compartidas y señalar cuando sean reservas sin consumidor actual. Los comentarios no autorizan cambiar valores, selectores ni comportamiento.
- **CSS descriptivo obligatorio:** usar nombres semánticos de clases y variables que expliquen la función del componente o estado; evitar nombres ambiguos como caja1, estilo2 o nuevo. Organizar por bloques con encabezados descriptivos y comentar propiedades visuales importantes (opacidad, capas, filtros, temas y excepciones responsive), indicando qué controlan y cómo modificarlas. Mantener una propiedad por línea en esos bloques para facilitar su localización. Reutilizar tokens/componentes; no copiar estilos por CRUD ni renombrar consumidores sin revisar sus referencias.
- Presentación centralizada en `resources/css/app.css` y `resources/views/components`; las vistas de cada recurso componen esos componentes. No añadir consultas, persistencia, validación o autorización de negocio a Blade. Modelos, controladores/componentes Livewire y vistas conservan sus responsabilidades; no crear copias de recursos ni introducir lógica de negocio en CSS/JavaScript. La reestructuración funcional posterior debe respetar MVC y el plan por tabla.
- No anunciar uniformidad por un build o un informe delegado: verificar las plantillas realmente montadas, ambos temas y tres tamaños, contraste/foco y ausencia de desborde real. No ocultar el overflow del documento para aparentar responsive. Las evidencias nuevas se guardan exclusivamente en `/pruebas`.

**Registro — 12/11/2026, corrección directa de la interfaz (up000055):** Codex asume implementación por instrucción expresa y detiene NVIDIA con confirmación antes de editar. Archivos: CSS compartido, componentes Blade, layouts y vistas de dashboard, catálogos, directorio, personal, correspondencia y grupos; pruebas existentes de componentes/responsive y herramientas/evidencias sintéticas en `/pruebas`. Motivo: colores semánticos inconsistentes, capas grises que ocultaban el escudo y campos sin contraste. Efecto: degradados con significado estable, panel azul marino alfa0.62, escudo al0.48 (40% menos intensidad), controles temáticos y navegación plegable hasta1023px. No se agregan reglas ni consultas de negocio a las vistas. Validación: build Vite, Pint, detector Impeccable, 22 pruebas/45 aserciones de componentes y responsive, 11/60 de guardias y exportación de siete páginas (1 prueba/7 aserciones); 48 capturas locales en ambos temas y375/768/1366px, sin desbordamiento; contraste y foco medidos en componentes sobre el escudo. No se visita la aplicación con datos reales ni se usa MySQL. Pendientes: aceptación estética del usuario, cobertura dinámica completa de estados/permisos y correcciones funcionales anteriores, que se conservan fuera de esta integración. No se declara terminada la reestructuración del sistema.

**Registro — 12/11/2026, mayor transparencia del escudo (up000056):** Por petición del usuario se reduce exclusivamente la opacidad del escudo global de0.48 a0.30 (70% transparente) en resources/css/app.css. Se actualiza la regla activa y DOC/sistema/estandar-visual.md, conservando el PNG, escala, filtro, tablas al0.62 y texto sin atenuar. Validación: build Vite correcto (10.18s); snapshots sintéticos locales en claro y oscuro con opacidad computada0.3 y ancho1366/1366 sin desbordamiento; evidencia en pruebas/evidencias/escudo-30. Sin backend, MySQL ni datos reales. Aceptación estética pendiente.

**Registro — 12/11/2026, escudo más tenue y CSS descriptivo (up000057):** Se constata un ajuste local del usuario de0.30 a0.15 y se reduce la opacidad del escudo a0.12 por la petición de mayor transparencia. Se añaden encabezados y comentarios de capas, transparencia, acabado plateado y temas en resources/css/app.css, con propiedades separadas para facilitar su localización; el comentario informal queda sustituido por etiquetas claras. Se establece la regla de CSS descriptivo en AGENTS.md y DOC/sistema/estandar-visual.md. El ajuste previo del usuario en el velo del tema claro se conserva localmente fuera de este commit. Validación: build Vite correcto (11.0s), opacidad computada0.12 en snapshots sintéticos claros/oscuros, tablas al0.62 y ancho1366/1366 sin desbordamiento; pruebas/evidencias/escudo-12. Sin backend, datos reales ni MySQL. Pendiente aceptación estética.

**Registro — 12/11/2026, CSS explicado y paneles pendientes (up000058):** Se comentan los78 bloques de reglas de resources/css/app.css, importaciones, variables compartidas y condiciones responsive; se separan las propiedades para facilitar lectura. Comparación estructural con PostCSS: mismos selectores, declaraciones, valores y orden antes/después de comentar. Se corrigen los fondos opacos de las vistas efectivas resources/views/usuarios/index.blade.php y resources/views/componentes/index.blade.php mediante panel-base y fondos interiores transparentes, manteniendo sus datos y acciones. La exportación sintética incluye componentes. Validación: build Vite9.82s, Pint,22 pruebas/45 aserciones de interfaz y1/8 de exportación;12 capturas (dos rutas, ambos temas,375/768/1366px), paneles alfa0.62 y sin desbordamiento. Evidencia en pruebas/evidencias/css-comentado y paneles-usuario-componentes. Sin MySQL, aplicación con datos reales, backend ni dependencias. El velo claro modificado previamente por el usuario se conserva localmente fuera del commit. Pendiente aceptación estética.

## Superficies translúcidas en todas las páginas — 12/11/2026

- Aclaración expresa del usuario, con captura de `/dashboard`: el escudo plateado, grande y sin letras debe verse como fondo detrás del contenido en todas las páginas, no solo en acceso. Usar `public/media/img/campechecon.png`, sin alterar el PNG original.
- Paneles principales, vistas y contenedores de tablas usan **62% de opacidad del color de fondo** (alfa0.62; sustituye el 80% anterior). Texto, iconos, controles y contenido permanecen al100%. Prohibido aplicar `opacity:0.8` a todo el contenedor y desvanecer sus descendientes.
- Una sola superficie translúcida por panel principal; evitar capas opacas o fondos semitransparentes anidados que acumulen opacidad y oculten el escudo. Las celdas/filas y envoltorios internos se armonizan con el panel común sin eliminar etiquetas, selección, errores ni jerarquía de tabla.
- Definir pares de superficie/texto para claro y oscuro y medir contraste contra la composición real con el escudo, no solo contra un fondo plano. Mantener como mínimo4.5:1 para texto normal,3:1 para grande y elementos aplicables; preservar foco, teclado y objetivos táctiles.
- Aplicar mediante componentes/tokens compartidos al contenido principal de dashboard, correspondencia, directorio, usuarios, grupos, catálogos y demás vistas. Conservar navegación, formularios, validación y acciones. No introducir selector/persistencia de tema ni migrar el frontend por este cambio de presentación. Responsive móvil/tableta/escritorio, sin desplazamiento lateral ni recorte de información.
- El fondo debe ser decorativo, sin capturar eventos ni aparecer en el árbol accesible. No extender este tratamiento a PDF o correo de servidor por inferencia.

**Registro — 12/11/2026, alcance visual global (up000052):** Se documenta la aclaración del usuario en AGENTS.md y DOC/sistema/estandar-visual.md y se registra en README.md. El fondo de acceso está implementado en up000051; el fondo global, superficies alfa0.8 y homogeneización general siguen pendientes de implementación y revisión. Validación de esta entrega solo documental; sin código, datos o dependencias modificados.

## Reparto de trabajo NVIDIA/DeepSeek — 12/11/2026

- Por instrucción expresa del usuario, el frontend y sus detalles visuales se asignan a NVIDIA NIM mediante OmniRoute; el backend a DeepSeek mediante OmniRoute. El coordinador conserva arquitectura, revisión, documentación, seguridad, costos e integración. Esta distribución sustituye la atribución anterior de todo desarrollo a DeepSeek; no cambia los límites de datos ni la prioridad visual.
- Modelo frontend comprobado: `nvidia/nvidia/nemotron-3-ultra-550b-a55b`; alias compartido de OpenCode `omniroute/frontend-nvidia-ultra`. Modelo backend existente: `omniroute/deepseek-v4.1-flash-1017`. No afirmar ejecución del trabajador por una prueba de inferencia ni actividad por haber enviado un mensaje.
- Primero entregar diagnóstico y estándar visual contra `/agen` antes de implementar. Mientras tanto, el backend revisa contratos y compatibilidad con la UI en solo lectura; no adelanta correcciones funcionales. No modificar archivos compartidos simultáneamente.
- **Registro de validación:** metadatos técnicos de OmniRoute leídos sin cuerpos de conversación; prueba autenticada del modelo NVIDIA con HTTP 200 y llamada `report_ready`. Se agregó un único alias a la configuración compartida de OpenCode, con respaldo SHA-256 comprobado y comparación del resto de la configuración sin cambios. Sin claves expuestas ni configuración de SCO modificada. La ruta sirve a trabajadores OpenCode/Orca y su CLI; no equivale a cambiar el modelo coordinador ni a configurar o probar NVIDIA en Codex Desktop/CLI. No se incorporó MCP, plugin ni skill nuevos.
- **Pendientes:** recepción de informes, revisión del coordinador y aplicación/verificación visual. Tres asignaciones visuales anteriores detenidas con confirmación para consolidar el trabajo, sin revertir sus archivos locales. Esta actualización documental se registra en `README.md` §15 como up000048; sin pruebas de aplicación, MySQL ni cambios de producto.

## Prioridad y estándar visual obligatorio — 12/11/2026

- **Prioridad expresa del usuario:** realizar primero la homogeneización visual y sus reglas; posponer nuevas correcciones funcionales. Los parches RG/grupos ya recibidos permanecen pendientes de revisión e integración; esta instrucción no autoriza revertirlos ni mezclarlos con la entrega visual.
- **Fuente única:** todos los CRUD y pantallas siguen [DOC/sistema/estandar-visual.md](DOC/sistema/estandar-visual.md). `/agen` es la referencia aprobada. Conservar navegación, información, acciones y flujos existentes; uniformar presentación sin introducir funciones por iniciativa estética.
- **Colores y contraste:** definir pares compartidos de fondo/texto para claro y oscuro. Fondo claro con texto oscuro y fondo oscuro con texto claro; verificar valores, etiquetas, opciones, placeholder, autofill, errores, foco y hover. Contraste mínimo de 4.5:1 para texto normal y 3:1 para texto grande y elementos no textuales aplicables. Prohibido combinar fondo oscuro con texto negro fijo o depender de una herencia sin verificarla.
- **Medidas comunes:** mismos tamaños y variantes por función para inputs, botones, iconos, tablas, imágenes, paneles y diálogos. Mismo significado implica misma apariencia en cualquier sección. Reutilizar componentes/tokens; no definir una paleta ni copiar clases contradictorias por CRUD.
- **Responsive y temas:** aplicar el estándar en móvil, tableta y escritorio, en claro y oscuro y en todos los estados. Ajustar contenido sin desplazamiento horizontal ni recorte de información; no usar ocultación global del desborde como prueba de cumplimiento.
- **Equipo de diseño permanente:** Taste (`design-taste-frontend`) dirige identidad y criterio estético; `ui-ux-pro-max` fundamenta tokens, medidas y accesibilidad; `impeccable` audita consistencia, contraste y acabado. Leer el SKILL.md aplicable, identificar su versión y registrar instrucciones aplicadas y herramientas realmente ejecutadas. Las preferencias del usuario y el stack real prevalecen sobre defaults incompatibles de una skill.
- **Skills/plugins:** comprobar disponibilidad y capacidades reales. Estas tres referencias son skills: no afirmar que son plugins instalados. No instalar dependencias, activar hooks ni modificar configuración por inferencia. Toda incorporación autorizada conserva descubrimiento compatible en Codex Desktop y CLI, con verificación de ambas interfaces y límites expresos.
- **Aceptación:** el análisis visual y su informe preceden a implementar el estándar. Antes de anunciar uniformidad, verificar render, contraste y teclado en ambos temas y los tres tamaños, incluidos vacío, carga, error y deshabilitado. Una lectura de código, build o prueba de cadenas no acredita revisión visual.

**Registro — 12/11/2026, normativa visual (up000047):** Se incorporan esta prioridad y reglas, se crea DOC/sistema/estandar-visual.md y se enlaza en README.md §15. Motivo: unificar apariencia entre CRUD antes de continuar correcciones. Validación documental y enlaces locales; sin cambios de interfaz, datos, plugins ni configuración en esta entrega. Pendientes: informe de diseño, aplicación y verificación visual del estándar; foto de usuario y cierre de parches RG/grupos aplazados.

<laravel-boost-guidelines>
=== reglas base ===

# Pruebas y archivos de pruebas
Todos los archivos generados para las pruebas estaran ubicados en
la carpeta /pruebas si execpcion.

# Commits y bitácora (regla obligatoria)

- Toda modificación terminada que sume **más de 10 líneas** (altas + bajas) se cierra con un commit inmediato, sin esperar a que el usuario lo pida.
- El mensaje sigue la serie existente: `upNNNNNN - Título corto en español` con el **siguiente consecutivo** (`up000042`, `up000043`, …). El cuerpo enumera los cambios generados: archivos o grupos tocados y el efecto de cada uno.
- El mismo cambio se registra en `README.md` §15 con una subsección `### Título ("upNNNNNN")`, una tabla `Archivo | Cambio` y la línea **Validación**; así queda documentado el post al que pertenece el commit.
- Antes de commitear: `vendor/bin/pint --dirty --format agent`, `npm run build` si hubo cambios de frontend y `php artisan test --compact`.
- Nunca se incluyen en el commit `public/build`, `.env`, credenciales, respaldos `sql/` ni la carpeta `.agents/` sin autorización.

# Guía de Laravel Boost

Las directrices de Laravel Boost están especialmente curadas por los mantenedores de Laravel para esta aplicación. Estas reglas deben seguirse de cerca para asegurar la mejor experiencia al construir aplicaciones Laravel.

## Contexto fundamental

Esta aplicación es un proyecto Laravel y los principales paquetes del ecosistema con sus versiones están listados a continuación. Eres un experto en todos ellos. Asegúrate de cumplir con estos paquetes y versiones específicos.

- php - 8.5 (Composer fija `config.platform.php` en 8.4.0)
- laravel/framework (LARAVEL) - v12
- laravel/jetstream (JETSTREAM) - v5
- laravel/fortify (FORTIFY) - v1
- laravel/sanctum (SANCTUM) - v4
- livewire/livewire (LIVEWIRE) - v3
- laravel/prompts (PROMPTS) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v3
- vite - v8

## Techo de versiones verificado

Estas son las versiones máximas que la aplicación admite hoy sin romper el código; no las subas por encima sin resolver antes el bloqueo indicado.

- **Laravel 12** es el límite: `laravel/jetstream` 5.5 exige `illuminate/support ^11.0|^12.0`, por lo que Laravel 13 falla al resolver dependencias.
- **Livewire 3** es el límite: Jetstream 5.5 exige `livewire/livewire ^3.3` y WireUI 2.6 exige `^3.6`.
- **Tailwind 3** es el límite: `wireui/wireui` aporta el preset de Tailwind v3 en `tailwind.config.js` y `flowbite` 2 usa el plugin de v3.
- **Flowbite 2** es el límite: `flowbite` 4 depende de `tailwindcss ^4.1`, lo que obliga a migrar el preset de WireUI y revisar todos los estilos.
- `endroid/qr-code` se mantiene en 6.1 porque la rama 6.2 exige PHP `^8.5` y la plataforma de Composer es 8.4.

## Activación de habilidades

Este proyecto tiene habilidades específicas de dominio disponibles en `**/skills/**`. DEBES activar la habilidad relevante siempre que trabajes en ese dominio; no esperes hasta estar atascado.

## Convenciones

- Debes seguir todas las convenciones de código existentes usadas en esta aplicación. Al crear o editar un archivo, revisa archivos hermanos para la estructura, el enfoque y la nomenclatura correctos.
- Todas las rutas, adiciones, anexiones y modificaciones deben seguir la guía de estilo observada en el proyecto.
- Usa nombres descriptivos para variables y métodos. Por ejemplo, `isRegisteredForDiscounts`, no `discount()`.
- Revisa si ya existe un componente reutilizable antes de escribir uno nuevo.
- Cuando se solicite una modificación de una ruta o de una acción específica, realiza únicamente esa acción solicitada y verifica que no repercuta en las demás acciones de esa misma ruta ni en ninguna otra ruta.
- Todas las vistas deben estar escritas en español.

## Guía de estilo del proyecto

- Idioma: todo texto visible en interfaz (títulos, etiquetas, mensajes, botones, validaciones y ayudas) debe estar en español.
- Rutas: usa rutas con nombre y `route()` para generar enlaces; conserva la convención actual de recursos y alias de nombres existentes.
- Controladores: mantén clases en `App\Http\Controllers` con sufijo `Controller` y nombres en PascalCase.
- Livewire: organiza componentes por dominio y acción (por ejemplo `App\Livewire\Service\Index`), con propiedades en camelCase y bindings `wire:model.live` cuando se requiera filtrado en tiempo real.
- Modelos y base de datos: respeta los nombres de columnas heredadas existentes (incluyendo `snake_case` y campos legacy como `id_s`, `F_serv`), sin renombrar campos salvo solicitud explícita.
- Blade: prioriza componentes reutilizables (`x-...`) antes de duplicar bloques; conserva estructuras existentes de layout y slots.
- Estilos: usa Tailwind CSS como primera opción, manteniendo coherencia visual con la paleta y patrones ya presentes en cada módulo.
- Coherencia visual: conserva el mismo estilo visual en todo el proyecto; reutiliza los patrones existentes en lugar de inventar variantes.
- Sin desplazamiento lateral (regla obligatoria): ninguna vista debe desplazarse en horizontal; solo se permite desplazamiento vertical. Prohibido `overflow-x-auto`, `overflow-x-scroll` y anchos mínimos fijos como `min-w-[960px]`. Las tablas de datos usan la clase `tabla-apilada` (definida en `resources/css/app.css`): en móvil cada fila se muestra como tarjeta con etiqueta `data-label` y desde 768px vuelve a ser tabla normal. Usa anchos fijos solo con prefijo responsive (`md:w-40`), nunca en móvil.
- Campos de contraseña: todo input de contraseña debe incluir el botón de mostrar/ocultar con el estilo del login (icono de ojo SVG, `text-gray-400 hover:text-gray-600`, posicionado a la derecha). En Livewire/Blade usa el componente `<x-password-toggle-button />` dentro de un contenedor `relative` con `x-data="{ show: false }"` y `x-bind:type="show ? 'text' : 'password'"` en el input.
- Mensajes de sesión: conserva claves estándar observadas (`message`, `error`) y textos claros en español.
- Comentarios: usa comentarios breves y útiles, preferentemente en español, solo cuando aporten contexto no obvio.
- El diseño de esta web ap debe ser responsivo.

## Scripts de verificación

- No crees scripts de verificación ni uses tinker cuando las pruebas cubran esa funcionalidad y demuestren que funciona. Las pruebas unitarias y de características son más importantes.

## Protección de los datos de la base de datos (PRIORIDAD MÁXIMA)

- Protege los datos de la base de datos a toda costa; esta regla prevalece sobre cualquier otra.
- **Está prohibido tocar la base de datos (leer, escribir, migrar, sembrar, consultar o ejecutar pruebas que la usen) a menos que el usuario lo pida expresamente en ese mensaje.** Una petición de código, vistas o pruebas no cuenta como autorización.
- Antes de ejecutar cualquier prueba, verifica que `phpunit.xml` fuerce `DB_CONNECTION=sqlite` y `DB_DATABASE=:memory:` y que `tests/TestCase.php` conserve su guardia que aborta si la conexión no es SQLite en memoria. Nunca quites ni debilites esas protecciones.
- Si `bootstrap/cache/config.php` existe, la configuración en caché puede ignorar `phpunit.xml`; si la guardia aborta una prueba, pregunta al usuario antes de ejecutar `php artisan config:clear`.
- `AppServiceProvider` bloquea los comandos destructivos de Artisan (`migrate:fresh`, `migrate:refresh`, `migrate:reset`, `db:wipe`) fuera de las pruebas; no lo desactives ni lo evites con `--force` u otros rodeos.
- Nunca ejecutes comandos destructivos contra la base de datos real: `migrate:fresh`, `migrate:refresh`, `migrate:reset`, `db:wipe`, `db:seed` sobre datos existentes, `DROP`, `TRUNCATE` ni `DELETE`/`UPDATE` masivos o sin `WHERE`.
- No modifiques ni borres usuarios, servicios, inventarios u otros registros existentes sin aprobación explícita del usuario.
- Antes de cualquier cambio de datos o esquema autorizado, haz un respaldo y avisa al usuario.
- Usa solo consultas de solo lectura por defecto, y solo cuando el usuario las haya pedido expresamente.
- Las pruebas deben correr únicamente con la base de datos de pruebas (SQLite `:memory:` de `phpunit.xml`), nunca con `RefreshDatabase` apuntando a MySQL real.
- No restaures ni sobrescribas respaldos (`sql/`) sin confirmación explícita.
- No cambies las credenciales ni la conexión de base de datos en `.env`.

## Estructura y arquitectura de la aplicación

- Mantente en la estructura de directorios existente; no crees nuevas carpetas base sin aprobación.
- No cambies las dependencias de la aplicación sin aprobación.

## Empaquetado de frontend

- Si el usuario no ve un cambio de frontend reflejado en la interfaz, puede significar que necesita ejecutar `npm run build`, `npm run dev` o `composer run dev`. Pregúntale.

## Archivos de documentación

- Solo debes crear archivos de documentación si el usuario lo solicita explícitamente.

## Respuestas

- Sé conciso en tus explicaciones: enfócate en lo importante en lugar de explicar detalles obvios.

=== reglas boost ===

# Laravel Boost

## Herramientas

- Laravel Boost es un servidor MCP con herramientas diseñadas específicamente para esta aplicación. Prefiere las herramientas de Boost sobre alternativas manuales como comandos de shell o lectura de archivos.
- Usa `database-query` para ejecutar consultas de solo lectura en la base de datos en lugar de escribir SQL crudo en tinker.
- Usa `database-schema` para inspeccionar la estructura de tablas antes de escribir migraciones o modelos.
- Usa `get-absolute-url` para resolver el esquema, dominio y puerto correctos de las URLs del proyecto. Siempre úsalo antes de compartir una URL con el usuario.
- Usa `browser-logs` para leer registros del navegador, errores y excepciones. Solo los registros recientes son útiles; ignora las entradas antiguas.

## Búsqueda de documentación (IMPORTANTE)

- Siempre usa `search-docs` antes de hacer cambios en el código. No omitas este paso. Devuelve documentación específica de la versión basada en los paquetes instalados.
- Pasa un arreglo `packages` para limitar los resultados cuando sepas qué paquetes son relevantes.
- Usa múltiples consultas amplias basadas en temas: `['rate limiting', 'routing rate limiting', 'routing']`. Espera que los resultados más relevantes aparezcan primero.
- No agregues nombres de paquetes a las consultas porque la información del paquete ya se comparte. Usa `test resource table`, no `filament 4 test resource table`.

### Sintaxis de búsqueda

1. Usa palabras para lógica AND automática: `rate limit` coincide con "rate" Y "limit".
2. Usa `"frases entre comillas"` para coincidencias exactas de posición: `"infinite scroll"` requiere palabras adyacentes en ese orden.
3. Combina palabras y frases para consultas mixtas: `middleware "rate limit"`.
4. Usa múltiples consultas para lógica OR: `queries=["authentication", "middleware"]`.

## Artisan

- Ejecuta comandos Artisan directamente desde la línea de comandos (por ejemplo, `php artisan route:list`). Usa `php artisan list` para descubrir comandos disponibles y `php artisan [command] --help` para revisar parámetros.
- Inspecciona rutas con `php artisan route:list`. Filtra con: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Lee valores de configuración usando notación de puntos: `php artisan config:show app.name`, `php artisan config:show database.default`. O lee archivos de configuración directamente en el directorio `config/`.

## Tinker

- Ejecuta PHP en el contexto de la aplicación para depuración y pruebas. No crees modelos sin aprobación del usuario; prefiere pruebas con fábricas. Prefiere comandos Artisan existentes en lugar de código tinker personalizado.
- Usa siempre comillas simples para evitar la expansión del shell: `php artisan tinker --execute 'Your::code();'`
  - Usa comillas dobles dentro de las cadenas PHP: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== reglas php ===

# PHP

- Siempre usa llaves `{}` para estructuras de control, incluso en cuerpos de una sola línea.
- Usa promoción de propiedades del constructor de PHP 8: `public function __construct(public GitHub $github) { }`. No dejes métodos `__construct()` vacíos sin parámetros a menos que el constructor sea privado.
- Usa declaraciones de tipo de retorno explícitas y tipos en los parámetros de todos los métodos: `function isAccessible(User $user, ?string $path = null): bool`
- Usa TitleCase para las claves de Enum: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefiere bloques PHPDoc sobre comentarios en línea. Solo agrega comentarios en línea para lógica excepcionalmente compleja.
- Usa definiciones de forma de arreglo (`array shape`) en los PHPDoc.

=== reglas de despliegue ===

# Despliegue

- Laravel se puede desplegar usando [Laravel Cloud](https://cloud.laravel.com/), que es la forma más rápida de desplegar y escalar aplicaciones Laravel.

=== reglas de pruebas ===

# Aplicación de pruebas

- Cada cambio debe ser probado programáticamente. Crea una prueba nueva o actualiza una prueba existente, luego ejecuta las pruebas afectadas para asegurarte de que pasen.
- Ejecuta la menor cantidad de pruebas necesaria para asegurar la calidad y la velocidad. Usa `php artisan test --compact` con un nombre de archivo o filtro específico.

=== reglas laravel/core ===

# Haz las cosas a la manera de Laravel

- Usa los comandos `php artisan make:` para crear nuevos archivos (por ejemplo, migraciones, controladores, modelos, jobs, etc.). Puedes listar los comandos disponibles con `php artisan list` y revisar los parámetros con `php artisan [command] --help`.
- Si vas a crear una clase PHP genérica, usa `php artisan make:class`.
- Pasa `--no-interaction` a todos los comandos Artisan para asegurarte de que no requieran entrada del usuario. También debes pasar las `--options` correctas para asegurar el comportamiento esperado.

### Creación de modelos

- Cuando crees nuevos modelos, crea factories y seeders útiles también. Pregunta al usuario si necesita algo más, usando `php artisan make:model --help`.

## APIs y recursos Eloquent

- Para APIs, usa por defecto recursos Eloquent API y versionado de API a menos que las rutas existentes no lo hagan; en ese caso, sigue la convención actual de la aplicación.

## Generación de URL

- Al generar enlaces a otras páginas, prefiere rutas con nombre y la función `route()`.

## Pruebas

- Al crear modelos para pruebas, usa las factories. Revisa si la factory tiene estados personalizados antes de configurar manualmente el modelo.
- Faker: usa métodos como `$this->faker->word()` o `fake()->randomDigit()`. Sigue las convenciones existentes respecto a si usas `$this->faker` o `fake()`.
- Al crear pruebas, usa `php artisan make:test [options] {name}` para una prueba de características y pasa `--unit` para una prueba unitaria. La mayoría de las pruebas deben ser de características.

## Error de Vite

- Si recibes un error `Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest`, puedes ejecutar `npm run build` o preguntar al usuario que ejecute `npm run dev` o `composer run dev`.

=== reglas livewire/core ===

# Livewire

- Livewire permite construir interfaces dinámicas y reactivas en PHP sin escribir JavaScript.
- Puedes usar Alpine.js para interacciones del lado del cliente en lugar de frameworks JavaScript.
- Mantén el estado en el servidor para que la interfaz refleje los datos. Valida y autoriza en las acciones como lo harías en solicitudes HTTP.

=== reglas pint/core ===

# Formateador Laravel Pint

- Si has modificado archivos PHP, debes ejecutar `vendor/bin/pint --dirty --format agent` antes de finalizar los cambios para asegurar que tu código coincida con el estilo del proyecto.
- No ejecutes `vendor/bin/pint --test --format agent`; simplemente ejecuta `vendor/bin/pint --format agent` para corregir problemas de formato.

=== reglas pest/core ===

## Pest

- Este proyecto usa Pest para pruebas. Crea pruebas con `php artisan make:test --pest {name}`.
- El argumento `{name}` no debe incluir el directorio de la suite de pruebas. Usa `php artisan make:test --pest SomeFeatureTest` en lugar de `php artisan make:test --pest Feature/SomeFeatureTest`.
- Ejecuta pruebas con `php artisan test --compact` o con el filtro `php artisan test --compact --filter=testName`.
- NO elimines pruebas sin aprobación.

## Inventario de componentes, plugins e iconos

- Mantén el inventario visible en `resources/views/componentes/index.blade.php` sincronizado con las dependencias directas de `composer.json` y `package.json`, los componentes Blade de `resources/views/components`, las clases Livewire de `app/Livewire`, las integraciones/plugins frontend y los iconos de las vistas.
- Al agregar, retirar o cambiar una dependencia, componente, plugin o icono, actualiza ese inventario en el mismo cambio. Distingue las dependencias instaladas de las integraciones realmente cargadas y registra las fuentes de los SVG en línea.
- Basa el inventario en archivos fuente del proyecto; no incluyas artefactos generados de `storage/`, archivos compilados de `public/build/` ni código de `vendor/`.

</laravel-boost-guidelines>
