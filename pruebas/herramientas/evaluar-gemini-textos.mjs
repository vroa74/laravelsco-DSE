import fs from 'node:fs';
import path from 'node:path';
import os from 'node:os';
import { performance } from 'node:perf_hooks';

// Prueba acotada de redacción: no envía archivos, código ni datos de SCO.
// La credencial existente se usa solo en memoria; nunca se imprime ni se guarda.
const config = JSON.parse(fs.readFileSync(path.join(os.homedir(), '.config/opencode/opencode.json'), 'utf8'));
const provider = config.providers?.omniroute ?? config.provider?.omniroute;
const settings = provider?.settings ?? provider?.options;
if (!settings?.apiKey || !settings?.baseURL) throw new Error('Conexión local existente no disponible; no se modificó configuración.');
const base = new URL(settings.baseURL);
if (!['127.0.0.1', 'localhost'].includes(base.hostname)) throw new Error('Esta prueba exige el gateway local existente.');
const endpoint = new URL(`${base.pathname.replace(/\/$/, '')}/chat/completions`, base.origin);
const ids = ['agregar', 'editar', 'ver', 'eliminar', 'exportar_pdf', 'reporte_normal', 'reporte_especial', 'reporte_solicitud', 'cerrar', 'error_foto'];
const prompt = `Revisa microtextos de una interfaz administrativa en español. Sin herramientas ni explicaciones. Devuelve JSON puro: {"textos":[{"id":"...","etiqueta":"...","ayuda":"..."}]}. Exactamente estos 10 ids: ${ids.join(', ')}. Etiqueta hasta 35 caracteres; ayuda hasta 100. Son acciones existentes: agregar registro, editar registro, ver detalle, eliminar registro (no prometer reversibilidad), exportar PDF, abrir reporte normal, abrir reporte especial, abrir reporte de solicitud, cerrar diálogo, error al guardar foto conservando la anterior. No inventes funciones, confirmaciones, correos ni almacenamiento. En error_foto expresa claramente que se conserva la foto anterior.`;
const started = performance.now();
const response = await fetch(endpoint, {
  method: 'POST',
  headers: { Authorization: `Bearer ${settings.apiKey}`, 'Content-Type': 'application/json' },
  body: JSON.stringify({ model: 'gemini/gemini-3.1-flash-lite', messages: [{ role: 'user', content: prompt }], max_tokens: 1200, temperature: 0.2 }),
  signal: AbortSignal.timeout(30000),
});
if (!response.ok) throw new Error(`La prueba devolvió HTTP ${response.status}; respuesta privada omitida.`);
const data = await response.json();
const content = data.choices?.[0]?.message?.content ?? '';
let propuesta;
try { propuesta = JSON.parse(content.replace(/^```(?:json)?\s*/, '').replace(/\s*```$/, '')); }
catch { throw new Error('La respuesta no cumple JSON; no se aplica al proyecto.'); }
const textos = propuesta.textos;
const valido = Array.isArray(textos) && textos.length === ids.length
  && new Set(textos.map(t => t.id)).size === ids.length
  && ids.every(id => textos.some(t => t.id === id))
  && textos.every(t => typeof t.etiqueta === 'string' && t.etiqueta.length > 0 && t.etiqueta.length <= 35
    && typeof t.ayuda === 'string' && t.ayuda.length > 0 && t.ayuda.length <= 100);
const evidencia = { fecha: new Date().toISOString(), tarea: 'Microtextos sintéticos, sin herramientas ni archivos remotos', modeloSolicitado: 'gemini/gemini-3.1-flash-lite', modeloRespuesta: data.model, http: response.status, duracionMs: Math.round(performance.now() - started), usoDeclarado: data.usage ?? null, estructuraValida: valido, aplicada: false, propuesta };
const destino = path.resolve('pruebas/evidencias/ajustes-20261113/evaluacion/gemini-textos.json');
fs.mkdirSync(path.dirname(destino), { recursive: true });
fs.writeFileSync(destino, JSON.stringify(evidencia, null, 2) + '\n');
console.log(JSON.stringify(evidencia, null, 2));
if (!valido) process.exitCode = 1;
