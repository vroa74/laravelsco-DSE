# Estándar visual transversal de SCO

Fecha: 12/11/2026. Responsable: coordinador. Estado: reglas documentadas; análisis completo, implementación e inspección visual pendientes.

Autoridad: [AGENTS.md](../../AGENTS.md). Referencia aprobada por el usuario: `/agen`. Mantener funcionalidad, navegación, información y flujos existentes. Primero homogeneización visual; después correcciones funcionales. Los parches previos RG/grupos permanecen locales, pendientes de revisión, sin revertirlos.

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
