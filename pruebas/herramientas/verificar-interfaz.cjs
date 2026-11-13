const { chromium } = require('C:/Users/Python/AppData/Local/npm-cache/_npx/9833c18b2d85bc59/node_modules/playwright');
const fs = require('node:fs');
const path = require('node:path');
const { pathToFileURL } = require('node:url');

// Solo snapshots locales exportados desde SQLite sintético. Sin aplicación ni red.
const root = path.resolve('pruebas/prototipos/estandar');
const evidence = path.resolve('pruebas/evidencias/estandar-visual');
fs.mkdirSync(evidence, { recursive: true });
const pages = ['dark', 'light', ...['dashboard', 'catalogos', 'usuario.index', 'agen.index', 'user-groups.index', 'reportgral', 'rg.create'].flatMap(p => [p + '-dark', p + '-light'])];
const sizes = [{ width: 375, height: 812 }, { width: 768, height: 1024 }, { width: 1366, height: 768 }];

(async () => {
  const browser = await chromium.launch({ executablePath: 'C:/Users/Python/AppData/Local/Google/Chrome SxS/Application/chrome.exe', headless: true });
  const results = [];
  try {
    for (const size of sizes) {
      const context = await browser.newContext({ viewport: size });
      await context.route('**/*', route => route.request().url().startsWith(pathToFileURL(root).href) ? route.continue() : route.abort());
      const page = await context.newPage();
      for (const name of pages) {
        await page.goto(pathToFileURL(path.join(root, name + '.html')).href);
        await page.evaluate(() => document.fonts.ready);
        const metrics = await page.evaluate(() => {
          const css = el => getComputedStyle(el);
          const width = document.documentElement.clientWidth;
          const overflow = [...document.querySelectorAll('body *')].filter(el => {
            const r = el.getBoundingClientRect();
            return r.width > 0 && r.height > 0 && (r.right > width + 1 || r.left < -1) && css(el).position !== 'fixed' && !el.closest('.bg-institucional');
          }).map(el => ({ tag: el.tagName, class: el.className, right: Math.round(el.getBoundingClientRect().right) })).slice(0, 12);
          return {
            clientWidth: width, scrollWidth: document.documentElement.scrollWidth, overflow,
            scheme: css(document.documentElement).colorScheme,
            inputs: [...document.querySelectorAll('input:not([type=hidden]), select, textarea')].slice(0, 8).map(el => ({ type: el.type, bg: css(el).backgroundColor, color: css(el).color, scheme: css(el).colorScheme })),
            buttons: [...document.querySelectorAll('.btn-icon')].slice(0, 12).map(el => ({ label: el.getAttribute('aria-label'), bg: css(el).backgroundImage, color: css(el).color, width: el.offsetWidth, height: el.offsetHeight })),
          };
        });
        await page.screenshot({ path: path.join(evidence, name + '-' + size.width + '.png'), fullPage: true });
        results.push({ page: name, viewport: size, ...metrics });
      }
      await context.close();
    }
    fs.writeFileSync(path.join(evidence, 'medidas.json'), JSON.stringify(results, null, 2));
    const failures = results.filter(r => r.scrollWidth > r.clientWidth || r.overflow.length);
    console.log(JSON.stringify({ captures: results.length, overflowFailures: failures.map(r => ({ page: r.page, width: r.viewport.width, overflow: r.overflow })) }));
    process.exitCode = failures.length ? 1 : 0;
  } finally { await browser.close(); }
})().catch(error => { console.error(error.message); process.exitCode = 1; });
