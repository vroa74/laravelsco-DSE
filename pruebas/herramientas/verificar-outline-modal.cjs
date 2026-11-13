const { chromium } = require('C:/Users/Python/AppData/Local/npm-cache/_npx/9833c18b2d85bc59/node_modules/playwright');
const fs = require('node:fs');
const path = require('node:path');
const { pathToFileURL } = require('node:url');
const root = path.resolve('pruebas/prototipos/ajustes-modal');
const evidence = path.resolve('pruebas/evidencias/ajustes-20261113/estilos');
const linear = n => (n /= 255) <= .04045 ? n / 12.92 : ((n + .055) / 1.055) ** 2.4;
const lum = rgb => rgb.map(linear).reduce((v, n, i) => v + n * [.2126, .7152, .0722][i], 0);
const ratio = (a, b) => (Math.max(lum(a), lum(b)) + .05) / (Math.min(lum(a), lum(b)) + .05);

(async () => {
  const browser = await chromium.launch({ executablePath: 'C:/Users/Python/AppData/Local/Google/Chrome SxS/Application/chrome.exe', headless: true });
  const results = [];
  try {
    for (const theme of ['light', 'dark']) for (const width of [375, 768, 1366]) {
      const page = await browser.newPage({ viewport: { width, height: 900 }, colorScheme: theme, reducedMotion: 'reduce' });
      const errors = [], blocked = [];
      page.on('pageerror', error => errors.push(error.message));
      await page.route('**/*', route => {
        if (route.request().url().startsWith(pathToFileURL(root).href)) return route.continue();
        blocked.push(route.request().url()); return route.abort();
      });
      await page.goto(pathToFileURL(path.join(root, theme + '.html')).href);
      await page.evaluate(() => document.fonts.ready);
      const normal = await page.locator('[data-variante]').evaluateAll(els => els.map(el => {
        const c = getComputedStyle(el);
        const rgb = s => s.trim().startsWith('#') ? s.trim().slice(1).match(/../g).map(x => parseInt(x, 16)) : s.match(/[\d.]+/g).slice(0, 3).map(Number);
        return { variant: el.dataset.variante, text: rgb(c.color), surface: rgb(c.getPropertyValue('--surface-elevated')), background: c.backgroundImage, border: c.borderWidth };
      }));
      const hover = [];
      for (const button of await page.locator('[data-variante]').all()) {
        await button.hover();
        const c = await button.evaluate(el => {
          const s = getComputedStyle(el), rgb = v => v.match(/[\d.]+/g).slice(0, 3).map(Number);
          const convert = hex => hex.trim().replace('#', '').match(/../g).map(x => parseInt(x, 16));
          return { variant: el.dataset.variante, text: rgb(s.color), from: convert(s.getPropertyValue('--action-from')), to: convert(s.getPropertyValue('--action-to')) };
        });
        hover.push({ variant: c.variant, contrast: Math.min(ratio(c.text, c.from), ratio(c.text, c.to)) });
      }
      await page.mouse.move(0, 0);
      await page.screenshot({ path: path.join(evidence, `botones-${theme}-${width}.png`), fullPage: true });
      await page.locator('#abrir-muestra').click();
      await page.getByRole('dialog').waitFor({ state: 'visible' });
      const dialog = page.getByRole('dialog');
      await page.waitForFunction(() => { const c = getComputedStyle(document.querySelector('[role=dialog]')); return Number(c.opacity) === 1 && (c.transform === 'none' || Math.abs(new DOMMatrix(c.transform).a - 1) < .001); });
      const modal = await dialog.evaluate(el => {
        const c = getComputedStyle(el), input = el.querySelector('input'), cs = getComputedStyle(input);
        const close = el.querySelector('[aria-label="Cerrar diálogo"]'), b = close.getBoundingClientRect(), r = el.getBoundingClientRect();
        const rgb = s => s.trim().startsWith('#') ? s.trim().slice(1).match(/../g).map(x => parseInt(x, 16)) : s.match(/[\d.]+/g).slice(0, 3).map(Number);
        return { name: el.getAttribute('aria-labelledby'), colorScheme: c.colorScheme, color: rgb(c.color), inputColor: rgb(cs.color), inputBg: rgb(cs.backgroundColor), border: c.borderStyle, x: r.x, right: r.right, closeSize: [b.width, b.height], scrollWidth: document.documentElement.scrollWidth, clientWidth: document.documentElement.clientWidth, tones: [...el.querySelectorAll('[class^="identity-"]')].map(n => getComputedStyle(n).color) };
      });
      // El diálogo realmente renderizado recibe el foco y retiene Tab mediante el plugin incluido de Livewire/Alpine.
      await page.keyboard.press('Tab');
      const focus = await page.evaluate(() => ({ inside: !!document.activeElement.closest('[role="dialog"]'), outline: getComputedStyle(document.activeElement).outlineStyle }));
      for (let n = 0; n < 9; n++) await page.keyboard.press('Tab');
      focus.trapped = await page.evaluate(() => !!document.activeElement.closest('[role="dialog"]'));
      await page.screenshot({ path: path.join(evidence, `modal-${theme}-${width}.png`), fullPage: true });
      await page.keyboard.press('Escape');
      await dialog.waitFor({ state: 'hidden' });
      const escaped = await dialog.isHidden();
      await page.locator('#abrir-muestra').click();
      await page.getByRole('button', { name: 'Cerrar diálogo', exact: true }).click();
      await dialog.waitFor({ state: 'hidden' });
      const closed = await dialog.isHidden();
      const item = { theme, width, normal: normal.map(c => ({ variant: c.variant, contrast: ratio(c.text, c.surface), outline: c.background.includes('linear-gradient') && c.border === '2px' })), hover, modal, focus, escaped, closed, errors, blocked };
      results.push(item);
      await page.close();
    }
  } finally { await browser.close(); }
  fs.writeFileSync(path.join(evidence, 'verificacion-render.json'), JSON.stringify(results, null, 2));
  const failures = results.filter(r => r.errors.length || r.blocked.length || !r.escaped || !r.closed || !r.focus.inside || !r.focus.trapped || r.modal.colorScheme !== r.theme || r.modal.x < 0 || r.modal.right > r.width || r.modal.scrollWidth > r.modal.clientWidth || Math.min(...r.modal.closeSize) < 44 || r.normal.some(b => b.contrast < 4.5 || !b.outline) || r.hover.some(b => b.contrast < 4.5) || ratio(r.modal.inputColor, r.modal.inputBg) < 4.5);
  console.log(JSON.stringify({ cases: results.length, screenshots: results.length * 2, failures: failures.map(r => ({ theme: r.theme, width: r.width, hover: r.hover, modal: r.modal, focus: r.focus, escaped: r.escaped, closed: r.closed, errors: r.errors, blocked: r.blocked })) }, null, 2));
  process.exitCode = failures.length ? 1 : 0;
})().catch(e => { console.error(e.message); process.exitCode = 1; });
