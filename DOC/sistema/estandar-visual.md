# Estándar visual transversal de SCO

Fecha: 12/11/2026. Responsable de esta corrección: Codex. Estado: implementación local y verificación visual en revisión; aprobación estética pendiente.

Autoridad: [AGENTS.md](../../AGENTS.md). Referencia aprobada por el usuario: `/agen`. Mantener funcionalidad, navegación, información y flujos existentes. Primero homogeneización visual; después correcciones funcionales. Los parches previos RG/grupos permanecen locales, pendientes de revisión, sin revertirlos.

## Decisiones vigentes tras revisión del usuario

El azul marino translúcido y los degradados solicitados prevalecen sobre preferencias genéricas de las skills. No rediseñar la navegación ni los flujos.

| Acción | Variante compartida | Color |
| --- | --- | --- |
| Agregar / guardar | success | Verde |
| Editar | warning | Naranja |
| Ver / show | view | Amarillo |
| Eliminar | danger | Rojo, reservado a destrucción |
| Reporte normal | report-normal | Azul |
| Reporte especial | report-special | Violeta |
| Reporte solicitud | report-request | Turquesa |
| Exportar PDF | export-pdf | Magenta |
| Exportar CSV | export-csv | Azul petróleo |
| Filtrar | info | Azul |
| Cancelar / volver | neutral | Azul grisáceo |

Escudo: opacidad0.12 (88% transparente), por la nueva petición de atenuar un poco más el fondo; se constató un ajuste local previo a0.15 y se conserva el resto del trabajo del usuario. Esta última petición busca un fondo apenas perceptible, conservando escala, filtro y archivo. No confundir opacidad de la imagen con alfa del panel.

Superficie oscura: `rgb(7 24 51 / .62)`; clara: `rgb(241 247 255 / .62)`. Sustituyen el alfa0.8 anterior por petición de mayor transparencia. Los controles usan superficie sólida legible y texto contrastado; las tablas no acumulan fondos por fila o celda. Tamaño de icono compartido: 14px; botón de icono 36px o 40px, mínimo táctil 44px en móvil/puntero grueso. No introducir tamaños distintos por CRUD.

La selección nativa de fecha recibe `color-scheme: dark` en oscuro. Se verifica en Chrome con preferencia oscura; el popup depende del navegador/OS. No se promete control CSS de todos sus detalles.

## Colores y temas

Definir una sola familia de tokens semánticos para superficies, campos, texto, bordes, foco y acciones. Reutilizarla en Blade/Livewire y en sus futuros equivalentes Svelte/Inertia. Tomar los grises y azules existentes de `/agen` como base; medir sus estados antes de ratificar los valores exactos del sistema completo.

- Cada fondo lleva un color de texto explícito compatible: claro/oscuro y oscuro/claro. Verificar también opciones de select, fecha, búsqueda, contraseña, textarea, autofill y placeholder.
- Texto normal: contraste mínimo 4.5:1; texto grande y elementos no textuales aplicables: 3:1. Medir contra el fondo efectivo, incluidos transparencias, gradientes, foco y hover.
- Una misma acción tiene la misma variante en todos los recursos: primaria, secundaria, informativa o destructiva. Reservar éxito, advertencia y error para sus significados, acompañados de texto/icono; no usar un color distinto por módulo.
- Encabezados, filas, bordes, selección y estados vacíos de tabla comparten los tokens. No heredar blanco/negro accidentalmente desde el panel padre ni añadir clases locales que contradigan el tema.
- Preparar ambos temas desde cada componente; la presencia de una clase `dark` no demuestra selector, persistencia ni contraste correctos.

## Tamaños, imágenes y presentación

La escala exacta se ratifica en el informe contra `/agen`; estos requisitos rigen su definición y aplicación global:

| Elemento | Regla común |
| --- | --- |
| Tipografía | Misma familia existente y jerarquía por función; no cambiar fuente según el CRUD ni reducir texto para ocultar contenido. |
| Espacios, bordes y radios | Una escala compartida para campos, paneles, diálogos y tablas; excepciones justificadas por función y documentadas. |
| Campos | Misma altura y padding por variante; ancho adaptable, etiquetas y errores legibles, sin mínimos que desborden. |
| Botones | Una escala estándar/compacta por contexto, no por pantalla. Objetivo táctil mínimo de 44 × 44 px en móvil; dibujo y área interactiva pueden tener tamaños distintos. |
| Iconos | Misma familia, tamaño, alineación y significado por acción; nombre accesible en botones sin texto. Reutilizar bibliotecas instaladas. |
| Tablas | Misma densidad, encabezados, separadores y acciones. En móvil, tabla apilada/tarjetas con etiquetas e información completa; no desplazamiento horizontal. |
| Fotos de usuario | Una escala común por contexto (lista, edición, detalle), proporción cuadrada y recorte `object-fit: cover`, sin deformación. Espacio reservado y fallback accesible si falta la foto; conservar vista de foto actual y nueva selección. |
| Logos y documentos | Conservar proporción y contenido con `object-fit: contain` cuando el recorte destruya información; no aplicar el recorte de avatares a todas las imágenes. |
| Estados | Compartir presentación de foco, hover, carga, error, vacío, selección y deshabilitado; no depender solo del color ni ocultar el foco. |
| Movimiento | Transiciones discretas y coherentes que comuniquen estado, sin animaciones decorativas que entorpezcan captura/consulta; respetar movimiento reducido. |

Revisar móvil, tableta y escritorio en ambos temas. Resolver desbordes con ajuste de anchos, texto y distribución; recortar el viewport no demuestra responsive. Conservar teclado, orden de foco y controles de contraseña accesibles.

## Skills y plugins

| Skill disponible | Responsabilidad | Fuente compartida |
| --- | --- | --- |
| Taste / design-taste-frontend | Identidad y criterio estético, respetando `/agen`. | `C:/Users/Python/.agents/skills/design-taste-frontend/SKILL.md` |
| UI/UX Pro Max | Tokens, tipografía, medidas, componentes y accesibilidad. | `C:/Users/Python/.agents/skills/ui-ux-pro-max/SKILL.md` |
| Impeccable | Auditoría de coherencia, contraste y acabado. | `C:/Users/Python/.agents/skills/impeccable/SKILL.md` |

Existe además `.agents/skills/design-taste-frontend/SKILL.md` con instrucciones distintas: identificar cuál se usa y resolver contradicciones según el usuario, el contexto de aplicación administrativa y el stack real. No cambiar a React, instalar iconos ni adoptar un estilo nuevo porque una skill lo recomiende por defecto.

Disponibilidad, lectura, aplicación y ejecución de herramientas son hechos diferentes: reportarlos por separado. Esta entrega comprobó las rutas; no acredita auditoría completa ni ejecución de sus motores. No se instala ningún plugin adicional. Cualquier incorporación autorizada de skill/plugin/MCP o configuración mantiene compatibilidad y descubrimiento en Codex Desktop y CLI, verificando ambos sin inventar resultados.

## Orden y verificación

1. Inventariar las skills pertinentes y revisar arquitectura, componentes y estilos actuales sin modificar la interfaz.
2. Presentar diagnóstico contra `/agen`, dirección visual, tokens/medidas concretos y prioridades antes de implementar.
3. Homogeneizar componentes compartidos y aplicarlos por CRUD conservando funcionalidad; revisar consumidores compartidos.
4. Verificar render real en ambos temas y móvil/tableta/escritorio: contraste medido, teclado, estados, fotos y desbordes. Registrar evidencia y pendientes; no llamar terminado a lo que solo se revisó estáticamente.
5. Retomar después los defectos funcionales, incluida la foto de edición, preservando las correcciones ya existentes.

Evidencias y pruebas nuevas en `/pruebas`; pruebas de aplicación únicamente sintéticas en SQLite en memoria con guardias. No abrir la aplicación real ni consultar MySQL para este análisis. Registrar cada implementación en AGENTS.md, README.md y DOC/sistema conforme a las reglas de entrega.

Validación de esta entrega: lectura documental, referencias locales y revisión de diferencias; sin build, pruebas de aplicación, auditoría visual ni cambios de interfaz.

## Reparto de trabajo confirmado

Desde el 12/11/2026, NVIDIA NIM asume frontend y DeepSeek backend, ambos mediante OmniRoute; el coordinador mantiene documentación y revisión. Se verificó Nemotron 3 Ultra con HTTP 200 y llamada a herramienta; el alias compartido OpenCode es `omniroute/frontend-nvidia-ultra`. Respaldo de configuración y preservación del resto comprobados, sin secretos en la evidencia. El backend analiza contratos en paralelo, sin adelantar correcciones mientras la prioridad es la homogeneización visual. Los informes preceden a implementar.

Disponibilidad de inferencia no acredita arranque ni trabajo terminado del agente. Este alias sirve a OpenCode CLI y trabajadores Orca; no se ha configurado ni probado como modelo de Codex Desktop/CLI. Sin MCP, plugins ni skills nuevos. La incorporación queda documentada en up000048; faltan informes y aceptación visual.

### Incidencia de arranque del trabajador NVIDIA

El primer intento de trabajador falló por compactación; no equivale a fallo de la prueba de inferencia. El límite de 128000 declarado desde el catálogo del gateway se ajustó a 262144 de contexto, 240000 de entrada y 8192 de salida, con respaldo verificado. La [documentación oficial](https://docs.nvidia.com/nim/large-language-models/2.0.5/day-0/get-started-nemotron-3-ultra.html) indica 256K nativo y hasta 1M según despliegue; no se ensayó el máximo del endpoint alojado. Intento fallido detenido con confirmación; reintento pendiente. Backend DeepSeek con recibo de arranque, sin informe. Registro up000049; sin cambios de interfaz ni datos.

### Límite efectivo del gateway y entrega backend

El segundo intento de NVIDIA fue rechazado por OmniRoute: estimación de 146280 tokens frente a su límite declarado de 128000. Ajustar solo el alias de OpenCode no modificaba ese límite. Se guardaron metadatos anteriores/posteriores sin secretos en `pruebas/evidencias/integracion-nvidia` y se aplicó por API una única excepción de contexto de 262144 al modelo Nemotron Ultra. PUT HTTP 200, lectura posterior y catálogo de inferencia con 262144 comprobados. La fuente oficial permanece enlazada arriba; no se mide aquí el máximo real del endpoint ni se eluden protecciones. Reversión: retirar únicamente esa excepción para recuperar el valor anterior; no borrar otras configuraciones.

Intento fallido detenido con confirmación; nuevo reintento todavía pendiente de informe. DeepSeek ya entregó matriz de contratos backend en solo lectura: no hay contrato operativo de tema identificado y coexisten convenciones de URL de foto, entre otros riesgos a contrastar antes de implementar. El informe del trabajador es evidencia estática, no una prueba del sistema real. Registro up000050; sin cambios de producto.

## Fondo de acceso implementado (up000051)

La autorización puntual del usuario permite un escudo plateado, más grande y sin letras como fondo. Se consume `public/media/img/campechecon.png`, que contiene únicamente el escudo, preservando el archivo original; `unnamed.png` conserva su leyenda y no se modifica. La cabecera de la tarjeta y los formularios se conservan.

El componente CSS común del fondo aplica escala de grises, brillo1.35, contraste1.1, ancho `min(94vw,1100px)`, alto máximo `90svh` y `object-fit:contain`; opacidad0.8 y gradientes históricos conservados. Es decoración no interactiva con `aria-hidden`. No se modifica el contrato de tema ni se incorpora selector/persistencia; la homogeneización general sigue pendiente.

Validación: build correcto comunicado por el trabajador (19.13s), CSS compilado y diferencias revisados por el coordinador, guardia aceptada antes de Laravel y 22 pruebas existentes de componentes/responsive aprobadas, 45 aserciones, 87.54s, exclusivamente con SQLite en memoria y datos sintéticos. Evidencia: `pruebas/evidencias/fondo-acceso/regresion.txt`. Vista previa estática sin backend: `pruebas/prototipos/fondo-acceso-plata.html`, vinculada al CSS del build local actual. No hubo inspección renderizada en navegador; siguen pendientes revisión visual por tamaño/tema y aprobación estética. No se declara estandarizada la aplicación completa.

## Antecedente: escudo y superficies al80% (up000052; alfa sustituido por 0.62)

La captura de `/dashboard` precisa el resultado requerido: el escudo plateado debe verse detrás del contenido de todas las páginas. El fondo de acceso de up000051 es solo una parte; no acredita esta cobertura global.

Usar un fondo decorativo común, grande y sin letras con `campechecon.png`. La regla original de cada panel principal o contenedor de tabla indicaba alfa0.8 (actualmente sustituido por alfa0.62), manteniendo texto/iconos/controles al100%. No usar `opacity` en el contenedor completo. Quitar fondos opacos internos y evitar acumulación de transparencias anidadas que esconda el escudo; conservar encabezados, filas, selección, ayudas y errores legibles. Los colores claro/oscuro se definen una vez y el contraste se verifica contra la composición final, incluida la parte más clara del escudo.

Cobertura: layouts de acceso y aplicación, dashboard, correspondencia, directorio, usuarios, grupos, catálogos, perfil y vistas secundarias pertinentes. Reutilizar componentes/tokens y conservar flujos y datos. Móvil/tableta/escritorio y ambos temas; no se agrega aquí selector/persistencia de tema ni se traslada la transparencia a PDF/correo.

Criterio de aceptación: evidencia de cada familia de pantalla sobre el fondo real, superficies sin atenuación de sus descendientes, contraste, teclado y ausencia de desplazamiento lateral. Una captura aislada o pruebas de cadenas no acreditan cobertura. Estado: regla confirmada; implementación global pendiente.

## Organización y alcance de esta entrega

Tokens y material visual: `resources/css/app.css`. Botones, campos y diálogos: `resources/views/components`. Composición: vistas existentes de cada recurso; no se agregan consultas ni reglas de negocio a Blade. No se modifica el backend ni se instalan dependencias. Las pruebas, herramientas y capturas sintéticas quedan bajo `/pruebas`; no son código de producto.

Se revisan las plantillas efectivas: Jetstream monta `resources/views/navigation-menu.blade.php`, no su duplicado bajo livewire. Los CRUD montan People, Usuarios/Index, UserGroups/Index y Reportesgral/Index. La barra plegable de navegación se usa hasta 1023px para evitar desbordamiento, conservando los mismos enlaces.

Skills aplicadas: Taste (identidad aprobada y stack existente sobre defaults React/movimiento), UI/UX Pro Max (búsqueda local de contraste en campos) e Impeccable 4.7.0 (context, craft-floor y polish). El contexto permite refinamiento del sistema existente sin crear un rediseño. No se instalaron plugins ni hooks.

## CSS descriptivo obligatorio

- **CSS descriptivo obligatorio:** usar nombres semánticos de clases y variables que expliquen la función del componente o estado; evitar nombres ambiguos como caja1, estilo2 o nuevo. Organizar por bloques con encabezados descriptivos y comentar propiedades visuales importantes (opacidad, capas, filtros, temas y excepciones responsive), indicando qué controlan y cómo modificarlas. Mantener una propiedad por línea en esos bloques para facilitar su localización. Reutilizar tokens/componentes; no copiar estilos por CRUD ni renombrar consumidores sin revisar sus referencias.

El bloque de fondo institucional identifica sus tres capas, transparencia del escudo, acabado plateado y variantes por tema. Los comentarios documentan presentación; no introducen lógica de negocio.

## Comentarios completos y cobertura de paneles (up000058)

- **Comentarios por selector CSS:** cada bloque de app.css, incluidos selectores agrupados, estados hover/focus/disabled, pseudoelementos y condiciones responsive, debe explicar en español su finalidad y los elementos que afecta. Documentar las variables compartidas y señalar cuando sean reservas sin consumidor actual. Los comentarios no autorizan cambiar valores, selectores ni comportamiento.

app.css contiene comentarios en sus78 bloques de selectores y explica variables, temas, estados y media queries. La comparación estructural comprueba que documentar CSS no cambia su funcionamiento. Las vistas efectivas usuarios/index y componentes/index usan ahora el panel-base compartido, retirando fondos opacos e interiores que tapaban el escudo. Se preservan datos, acciones, marcadores de categoría y navegación.

Verificación:23 pruebas/53 aserciones con SQLite en memoria, build y12 capturas sintéticas en ambos temas y tres tamaños; sin desbordamiento y paneles alfa0.62. Evidencias bajo pruebas/evidencias/css-comentado y paneles-usuario-componentes. No es una validación sobre datos reales ni una certificación de accesibilidad integral.
