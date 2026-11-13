# Modelos de apoyo: comprobación mínima

Fecha:13/11/2026. Pasarela:OmniRoute local. No se sustituyó por OpenRouter ni se cambiaron claves o aliases.

## Preferencia del usuario

Usar primero el saldo de Gemini para tareas compatibles; no se prevé renovación. Mantener trabajo acotado y contexto mínimo. Esta preferencia no es una orden de consumir saldo sin trabajo útil ni de reemplazar la coordinación actual.

## Resultado observado

| Modelo solicitado | HTTP | Resultado | Consumo API |
| --- | --- | --- | --- |
| gemini/gemini-3.1-flash-lite | 200 en ambas solicitudes | Sin herramienta con límite128; report_ready con suma4/estadoOK validado con límite384 | 463 tokens |
| deepinfra/Qwen/Qwen3.6-35B-A3B | 200 | report_ready con suma4/estadoOK validado con límite128 | 362 tokens |

Total:3 solicitudes,825 tokens declarados por la API. No se midió precio facturado, saldo restante ni equivalencia con créditos. Los tiempos completos observados fueron2525ms y2700ms para Gemini,2023ms para DeepInfra; son estas llamadas mínimas, no una medición de capacidad o latencia general.

La comprobación revisa la generación de una llamada de herramienta y sus argumentos. No ejecuta una herramienta externa, no arranca agentes, no demuestra integración completa con Orca/OpenCode ni modifica archivos de producto. DeepSeek y NVIDIA ya habían comunicado resultados anteriormente; en esta tarea solo se constató su estado active en metadatos y no se repitió inferencia.

Evidencia sin secretos: `pruebas/evidencias/integracion-modelos-20261113/pruebas-minimas.json`. Ningún código, dato real o credencial de SCO se envió a los modelos. Sin MySQL o aplicación real.
