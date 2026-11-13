# Modelos de apoyo: comprobación mínima

Fecha:13/11/2026. Pasarela:OmniRoute local. No se sustituyó por OpenRouter ni se cambiaron claves o aliases.

## Preferencia del usuario

La preferencia inicial de usar primero Gemini queda acotada por instrucciones posteriores:3.1 Flash Lite suspendido;3.8 Flash comunicado listo por el CEO y comprobado solo por API. Usar Gemini únicamente hasta agotar el crédito existente, sin recarga o renovación autorizadas; ante agotamiento, detener asignaciones sin bucles de reintento. NVIDIA solo tareas básicas. DeepSeek conserva OmniRoute y Codex dirige/revisa. Mantener contexto mínimo; la disponibilidad en catálogo o API no acredita un trabajador Orca completo.

## Resultado observado

| Modelo solicitado | HTTP | Resultado | Consumo API |
| --- | --- | --- | --- |
| gemini/gemini-3.1-flash-lite | 200 en ambas solicitudes | Sin herramienta con límite128; report_ready con suma4/estadoOK validado con límite384 | 463 tokens |
| deepinfra/Qwen/Qwen3.6-35B-A3B | 200 | report_ready con suma4/estadoOK validado con límite128 | 362 tokens |

Total:3 solicitudes,825 tokens declarados por la API. No se midió precio facturado, saldo restante ni equivalencia con créditos. Los tiempos completos observados fueron2525ms y2700ms para Gemini,2023ms para DeepInfra; son estas llamadas mínimas, no una medición de capacidad o latencia general.

La comprobación revisa la generación de una llamada de herramienta y sus argumentos. No ejecuta una herramienta externa, no arranca agentes, no demuestra integración completa con Orca/OpenCode ni modifica archivos de producto. DeepSeek y NVIDIA ya habían comunicado resultados anteriormente; en esta tarea solo se constató su estado active en metadatos y no se repitió inferencia.

Evidencia sin secretos: `pruebas/evidencias/integracion-modelos-20261113/pruebas-minimas.json`. Ningún código, dato real o credencial de SCO se envió a los modelos. Sin MySQL o aplicación real.


## Gemini3.8 Flash — prueba de ciclo de herramienta

13/11/2026: gemini/gemini-3.8-flash por el gateway local existente. Primera solicitud: llamada sumar con2 y2. La herramienta se ejecutó localmente con valores sintéticos; se devolvió su resultado por el protocolo de herramientas. Segunda solicitud: respuesta final4. Dos HTTP200,216 tokens declarados,3.414s; argumentos y resultado validados.

Evidencia: pruebas/evidencias/ajustes-20261113/gemini-38/ciclo-herramienta.json. No se enviaron archivos, código o datos de SCO. Sin cambios de aliases, claves, facturación ni fallback. No se lanzó trabajador ni se acredita edición de archivos o ejecución de herramientas del arnés Orca/OpenCode. No se mide saldo restante ni costo facturado. El paso posterior debe ser una tarea pequeña completa antes de darle desarrollo amplio.
