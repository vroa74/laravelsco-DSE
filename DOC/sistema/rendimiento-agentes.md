# Evaluación operativa de agentes — 13/11/2026

Calificaciones provisionales de estos intentos en el entorno actual. Son juicio del coordinador sobre entrega, corrección, eficiencia y comunicación; no un benchmark general de modelos. Un proceso activo no acredita progreso ni una API funcional acredita uso correcto de herramientas.

| Agente | Nota | Evidencia y decisión |
| --- | --- | --- |
| DeepSeek | 8/10 | Entregó fotos y corrigió observaciones. Integración de coordinación: 21 pruebas/94 aserciones, up000061. Requiere revisión; recibió la tarea PDF pendiente. |
| NVIDIA | 6/10 provisional | Hay cambios locales de vistas y ediciones efectivas en su registro; falta informe de cierre, verificación y aceptación visual. Conserva sus vistas, con obligación de cerrar alcance. |
| Gemini en Orca/herramientas | 2/10 | Dos intentos, estilos y PDF, acumularon unos 45 minutos de lecturas repetidas y errores de sintaxis/herramientas sin entrega verificada. Al revisar después de la detención aparecieron 52 líneas parciales añadidas en app.css (backdrop/cierre/identidad), aún sin comprobar y sin completar el encargo; se conservan para revisión de Codex. Ambos detenidos con confirmación; sin nuevas tareas autónomas de código hasta demostrar un ciclo pequeño completo. |
| Gemini en texto breve | 7/10 | Prueba directa por OmniRoute: diez etiquetas, HTTP200, JSON y límites válidos, 4.669s, 772 tokens declarados. Etiquetas útiles; ayudas con afirmaciones no sustentadas corregidas por coordinación. Apto para redacción breve revisada. |
| DeepInfra | 3/10 de integración | La prueba API previa funcionó, pero el trabajador PDF falló por compactación antes de implementar. Sin más trabajos largos hasta corregir y demostrar el arranque pequeño. No se atribuye el fallo al razonamiento del modelo. |
| Codex/coordinación | 5/10 | Revisó e integró fotos, pero detectó tarde los bucles de Gemini y confundió actividad con avance en los avisos iniciales. Asume estilos comunes y controla entregas mediante diferencias, pruebas e informes. |

## Medidas ejecutadas

- Estilos Gemini `ctx_85cf35332885` y PDF Gemini `ctx_1096d538dfcf`: `stopped / closed_agent_terminal`, después liberados preservando sus transcripciones. No se borró trabajo local ni se reinició el historial.
- PDF continúa en la misma tarea `task_eea9a06cc715`, nuevo intento DeepSeek `ctx_7b5e1d140c1c`. Arranque recibido; todavía no equivale a entrega. Encargo actualizado en `/pruebas/encargos/20261113-ajustes/05-deepseek-reportes-reasignado.md`.
- La primera orden de reasignación combinó `--task` y `--spec-file`, incompatibles: se rechazó antes del arranque. Se consultó la ayuda y estado, y se corrigió usando la tarea existente más un mensaje con el encargo actualizado. No se duplicó la tarea.
- Codex asume CSS y componentes comunes después de confirmar detenida la escritura de Gemini. NVIDIA conserva sus vistas; se le comunicó el nuevo propietario.
- Gemini recibió una única tarea de texto por `omni-inference`, sin herramientas, código, archivos del proyecto ni datos reales. Resultado original y versión revisada en `/pruebas/evidencias/ajustes-20261113/evaluacion`. No se aplican textos automáticamente a producto.

## Reglas de seguimiento

- Tras dos fallos iguales de una herramienta, el agente debe comunicar el bloqueo y detener esa secuencia; no repetir intentos sin cambiar la causa.
- Si pasan diez minutos sin un resultado concreto, exigir un checkpoint con causa, cambio producido y entrega mínima pendiente. Es un criterio de revisión, no un temporizador automático ni promesa de vigilancia continua.
- Reasignar por evidencia de bloqueo o incapacidad y confirmar la detención antes de dar los mismos archivos a otro escritor. No penalizar con más consumo ni borrar trabajo como castigo.
- Entregas cerradas se avisan al usuario con 🟢 terminado y verificado, 🟡 pendiente/en revisión o 🔴 bloqueado/error, indicando tarea, resultado, comprobación y pendientes. No anunciar éxito por envío de instrucciones o actividad del proceso.
- Tokens y costos de trabajadores completos no están disponibles: no estimarlos ni equiparar tiempo con gasto. Los 772 tokens son únicamente el uso declarado de la prueba directa de texto.

Esta entrega evalúa y reorganiza trabajo. No acredita concluidos estilos, vistas, PDF ni la reestructuración general. Sin build o pruebas de aplicación porque no cambia producto; comprobación de recibos, JSON y sintaxis del helper Node. Sin MySQL ni datos reales.
