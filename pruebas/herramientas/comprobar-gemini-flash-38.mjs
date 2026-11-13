import fs from 'node:fs';
import os from 'node:os';
import path from 'node:path';
import { performance } from 'node:perf_hooks';

// Ciclo sintético de herramienta por API; no envía código/archivos de SCO.
// Usa la conexión existente sin modificarla ni guardar credenciales.
const config = JSON.parse(fs.readFileSync(path.join(os.homedir(), '.config/opencode/opencode.json'), 'utf8'));
const provider = config.providers?.omniroute ?? config.provider?.omniroute;
const settings = provider.settings ?? provider.options;
const base = new URL(settings.baseURL);
if (!['127.0.0.1', 'localhost'].includes(base.hostname)) throw Error('Se exige el gateway local existente.');
const endpoint = new URL(base.pathname.replace(/\/$/, '') + '/chat/completions', base.origin);
const model = 'gemini/gemini-3.8-flash';
const tools = [{ type: 'function', function: { name: 'sumar', description: 'Suma dos números sintéticos.', parameters: { type: 'object', properties: { a: { type: 'number' }, b: { type: 'number' } }, required: ['a', 'b'], additionalProperties: false } } }];
const messages = [{ role: 'user', content: 'Usa sumar con a=2 y b=2. Después de recibir el resultado, responde solo con el número, sin explicaciones.' }];
const usages = [], started = performance.now();
async function request(choice) {
  const response = await fetch(endpoint, { method: 'POST', headers: { Authorization: `Bearer ${settings.apiKey}`, 'Content-Type': 'application/json' }, body: JSON.stringify({ model, messages, tools, tool_choice: choice, max_tokens: 1024 }), signal: AbortSignal.timeout(30000) });
  if (!response.ok) throw Error(`HTTP ${response.status}; no se reintenta ni se imprime la respuesta privada.`);
  const data = await response.json();
  usages.push(data.usage ?? null);
  return data;
}
const first = await request({ type: 'function', function: { name: 'sumar' } });
const assistant = first.choices?.[0]?.message;
const call = assistant?.tool_calls?.[0];
if (!call || assistant.tool_calls.length !== 1 || call.function.name !== 'sumar') throw Error('No se recibió la única herramienta esperada.');
const args = JSON.parse(call.function.arguments);
if (args.a !== 2 || args.b !== 2) throw Error('Argumentos sintéticos incorrectos.');
const result = args.a + args.b; // La herramienta se ejecuta aquí, no por el modelo.
messages.push(assistant, { role: 'tool', tool_call_id: call.id, content: String(result) });
const second = await request('none');
const answer = second.choices?.[0]?.message?.content?.trim();
const evidence = { fecha: new Date().toISOString(), modeloSolicitado: model, modelosRespuesta: [first.model, second.model], prueba: 'Ciclo API: llamada sumar, ejecución local sintética y respuesta final', herramienta: 'sumar', argumentos: args, resultadoLocal: result, respuesta: answer, validado: answer === '4', duracionMs: Math.round(performance.now() - started), usosDeclarados: usages, limite: 'No acredita edición ni ejecución de un trabajador completo en Orca/OpenCode. Sin archivos, código o datos de SCO enviados; sin cambios de configuración.' };
const file = path.resolve('pruebas/evidencias/ajustes-20261113/gemini-38/ciclo-herramienta.json');
fs.mkdirSync(path.dirname(file), { recursive: true });
fs.writeFileSync(file, JSON.stringify(evidence, null, 2) + '\n');
console.log(JSON.stringify(evidence, null, 2));
if (!evidence.validado) process.exitCode = 1;
