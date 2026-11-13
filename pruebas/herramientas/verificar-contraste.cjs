const { chromium } = require('C:/Users/Python/AppData/Local/npm-cache/_npx/9833c18b2d85bc59/node_modules/playwright');
const fs = require('node:fs');
const path = require('node:path');
const { pathToFileURL } = require('node:url');
const root = path.resolve('pruebas/prototipos/estandar');
const linear = n => (n /= 255) <= .04045 ? n / 12.92 : ((n + .055) / 1.055) ** 2.4;
const luminance = rgb => rgb.map(linear).reduce((sum, n, i) => sum + n * [.2126, .7152, .0722][i], 0);
const contrast = (a, b) => { const x = luminance(a), y = luminance(b); return (Math.max(x, y) + .05) / (Math.min(x, y) + .05); };

(async () => {
  const browser = await chromium.launch({ executablePath: 'C:/Users/Python/AppData/Local/Google/Chrome SxS/Application/chrome.exe', headless: true });
  const results = [];
  try {
    for (const theme of ['light', 'dark']) {
      const page = await browser.newPage({ viewport: { width: 1366, height: 900 }, colorScheme: theme });
      await page.route('**/*', route => route.request().url().startsWith(pathToFileURL(root).href) ? route.continue() : route.abort());
      await page.goto(pathToFileURL(path.join(root, theme + '.html')).href);
      await page.evaluate(() => document.fonts.ready);
      const elements = await page.evaluate(() => [...document.querySelectorAll('h1,h2,label,input,select,.btn-base,.btn-icon,tbody td')].filter(el => !el.disabled && !(el.tagName === 'TD' && el.querySelector('.btn-icon'))).map(el => {
        const r = el.getBoundingClientRect();
        return { name: el.getAttribute('aria-label') || el.id || el.tagName, color: getComputedStyle(el).color.match(/[\d.]+/g).slice(0, 3).map(Number), x: r.x, y: r.y, w: r.width, h: r.height };
      }).filter(r => r.w && r.h && r.y + r.h < innerHeight));
      // Captura de fondo real con escudo: se oculta solo tinta para muestrear debajo.
      const hide = await page.addStyleTag({ content: '* { color: transparent !important; -webkit-text-fill-color: transparent !important; text-shadow: none !important; }' });
      const png = await page.screenshot();
      await hide.evaluate(el => el.remove());
      const pixels = await page.evaluate(async ({ b64, elements }) => {
        const img = new Image(); img.src = 'data:image/png;base64,' + b64; await img.decode();
        const canvas = document.createElement('canvas'); canvas.width = img.width; canvas.height = img.height;
        const ctx = canvas.getContext('2d'); ctx.drawImage(img, 0, 0);
        return elements.map(r => [.15, .35, .55].flatMap(dx => [.25, .5, .75].map(dy => [...ctx.getImageData(Math.floor(r.x + r.w * dx), Math.floor(r.y + r.h * dy), 1, 1).data].slice(0, 3))));
      }, { b64: png.toString('base64'), elements });
      const ratios = elements.map((el, i) => ({ name: el.name, minimum: Math.min(...pixels[i].map(pixel => contrast(el.color, pixel))) }));
      await page.keyboard.press('Tab');
      const keyboard = await page.evaluate(() => ({ first: document.activeElement.id, outline: getComputedStyle(document.activeElement).outlineStyle, width: getComputedStyle(document.activeElement).outlineWidth }));
      const date = page.locator('#fecha');
      await date.click();
      let picker;
      try { await date.evaluate(el => el.showPicker()); picker = 'showPicker aceptado'; } catch { picker = 'popup nativo no automatizable'; }
      await page.screenshot({ path: path.resolve('pruebas/evidencias/estandar-visual/calendario-' + theme + '.png') });
      results.push({ theme, ratios, keyboard, picker });
      await page.close();
    }
    fs.writeFileSync('pruebas/evidencias/estandar-visual/contraste-teclado.json', JSON.stringify(results, null, 2));
    process.exitCode = results.some(r => r.ratios.some(x => x.minimum < 4.5) || r.keyboard.outline !== 'solid') ? 1 : 0;
    console.log(JSON.stringify(results.map(r => ({ theme: r.theme, minimum: Math.min(...r.ratios.map(x => x.minimum)), failures: r.ratios.filter(x => x.minimum < 4.5), keyboard: r.keyboard, picker: r.picker }))));
  } finally { await browser.close(); }
})().catch(error => { console.error(error.message); process.exitCode = 1; });
