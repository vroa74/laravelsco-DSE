# Reanudación de la homogeneización visual

Pausa expresa del usuario: 20261112-175516. El equipo se va a apagar temporalmente.

- Último commit antes de esta nota: 22eb650 up000052 - Escudo global y superficies al ochenta por ciento.
- Run Orca: `run_b565b48fba3c`.
- Tarea pendiente: `task_8d50282dc798`.
- Dispatch detenido: `ctx_af5970bf42a6`; `worker-stop` confirmó `state=stopped` y `processAction=closed_agent_terminal`.
- Mensaje de suspensión enviado antes de detener: `msg_e5452418c9b5`.
- Frontend asignado a `omniroute/frontend-nvidia-ultra`; backend DeepSeek ya entregó su análisis en solo lectura.
- No hay entorno de ejecución remoto preparado: la inferencia es remota, pero archivos/herramientas son locales. No se trasladó el proyecto ni se dejó trabajo en la nube.

## Objetivo que debe conservarse

Escudo de Campeche plateado, grande y SIN LETRAS detrás del contenido en todas las páginas. Usar `public/media/img/campechecon.png`; el fondo de acceso ya está implementado en up000051. Paneles/tablas/vistas con **alfa0.8 únicamente en su color de fondo**; texto/iconos/controles al100%. Evitar fondos sólidos o capas80 anidadas que oculten el escudo. Conservar funcionalidad, navegación, acciones y datos; responsive móvil/tableta/escritorio y claro/oscuro. Unificar además tamaños/colores de controles, botones e iconos con `/agen` como referencia. Reglas en AGENTS.md y DOC/sistema/estandar-visual.md (up000052).

## Estado observado al detener

- Archivos rastreados de resources con diferencias: 2.
- Archivos nuevos de resources copiados al checkpoint: 0.
- Checkpoint local: `pruebas/reanudacion/20261112-175516` (estado-git.txt, frontend-en-curso.patch y copia de archivos nuevos de resources).
- Estos respaldos preservan el estado existente, incluidos cambios previos; NO son una implementación revisada ni deben aplicarse a ciegas.
- No se ejecutaron validaciones adicionales al pausar. No afirmar que la homogeneización global está terminada ni que sus cambios pasaron build/pruebas.
- Evidencia previa SOLO del fondo de acceso: build correcto y22 pruebas/45 aserciones aprobadas conSQLite memoria en up000051; no acredita cambios posteriores.
- Parches anteriores RG/grupos/dompdf, favicon y PNG del usuario siguen locales y no deben mezclarse sin revisión.

## Al regresar

1. Esperar petición expresa de reanudar; la tarea queda pendiente por pausa del usuario.
2. Leer esta nota, AGENTS.md vigente y estado real de Git; preservar modificaciones hechas por el usuario durante la pausa.
3. Comprobar OmniRoute y el alias sin exponer claves; metadatos de contexto NVIDIA configurados a262144, no128000.
4. Revisar diff/resources y el checkpoint antes de reactivar el mismo Task. Tras comprobar el estado de Orca, usar el flujo documentado de reintento con `--task task_8d50282dc798 --retry-of ctx_af5970bf42a6 --worktree current --agent opencode --model omniroute/frontend-nvidia-ultra` en el mismo Run.
5. Completar implementación, build y validaciones autorizadas con guardias; solamente SQLite :memory: sintético. Nada de MySQL, SQL histórico, .env o aplicación real.
6. Verificar composición/transparencia/contraste por pantalla y breakpoint; documentar y commitear solo trabajo revisado. Presentar estado visual al usuario.
