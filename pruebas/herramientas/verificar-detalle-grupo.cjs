const { chromium } = require('C:/Users/Python/AppData/Local/npm-cache/_npx/9833c18b2d85bc59/node_modules/playwright');
const fs = require('node:fs');
const path = require('node:path');
const { pathToFileURL } = require('node:url');
const root = path.resolve('pruebas/prototipos');
const evidence = path.resolve('pruebas/evidencias/ajustes-20261113/grupo-detalle');
fs.mkdirSync(evidence, { recursive: true });
(async () => {
  const browser = await chromium.launch({ executablePath: 'C:/Users/Python/AppData/Local/Google/Chrome SxS/Application/chrome.exe', headless: true });
  const results = [];
  try {
    for (const theme of ['dark', 'light']) for (const size of [{ width: 375, height: 667 }, { width: 768, height: 1024 }, { width: 1366, height: 768 }]) {
      const page = await browser.newPage({ viewport: size, colorScheme: theme });
      const errors = [];
      page.on('pageerror', e => errors.push(e.message));
      await page.route('**/*', r => r.request().url().startsWith(pathToFileURL(root).href) ? r.continue() : r.abort());
      await page.goto(pathToFileURL(path.join(root, 'grupo-detalle', theme + '.html')).href);
      await page.evaluate(() => document.fonts.ready);
      const metrics = await page.evaluate(() => {
        const p = document.querySelector('[data-group-detail-panel]'), box = e => { const r = e.getBoundingClientRect(); return { x: r.x, y: r.y, right: r.right, bottom: r.bottom, width: r.width, height: r.height }; };
        const panel = box(p), header = box(p.querySelector('header')), body = box(p.querySelector('dl')), footer = box(p.querySelector('footer')), close = box(p.querySelector('.modal-close'));
        const title = box(p.querySelector('h3'));
        const inside = r => r.x >= panel.x && r.right <= panel.right && r.y >= panel.y && r.bottom <= panel.bottom;
        return { panel, header, body, footer, close, title, enclosed: [header, body, footer, close].every(inside), rightAligned: close.x >= title.right, children: [...p.children].map(e => e.tagName), scrollWidth: document.documentElement.scrollWidth, clientWidth: document.documentElement.clientWidth, visible: panel.x >= 0 && panel.y >= 0 && panel.right <= innerWidth && panel.bottom <= innerHeight };
      });
      await page.screenshot({ path: path.join(evidence, `${theme}-${size.width}.png`), fullPage: true });
      results.push({ theme, ...size, ...metrics, errors });
      await page.close();
    }
  } finally { await browser.close(); }
  fs.writeFileSync(path.join(evidence, 'medidas.json'), JSON.stringify(results, null, 2));
  const failed = results.filter(r => !r.enclosed || !r.rightAligned || !r.visible || r.scrollWidth !== r.clientWidth || r.errors.length || r.close.width < 44 || r.close.height < 44);
  console.log(JSON.stringify({ cases: results.length, failures: failed }, null, 2));
  process.exitCode = failed.length ? 1 : 0;
})().catch(e => { console.error(e.message); process.exitCode = 1; });
