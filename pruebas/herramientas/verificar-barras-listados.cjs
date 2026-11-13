const { chromium } = require('C:/Users/Python/AppData/Local/npm-cache/_npx/9833c18b2d85bc59/node_modules/playwright');
const fs = require('node:fs');
const path = require('node:path');
const { pathToFileURL } = require('node:url');
const root = path.resolve('pruebas/prototipos/estandar');
const evidence = path.resolve('pruebas/evidencias/ajustes-20261113/barras');
fs.mkdirSync(evidence, { recursive: true });
const manifest = JSON.parse(fs.readFileSync('public/build/manifest.json', 'utf8'));
const css = fs.readFileSync(path.join('public/build', manifest['resources/css/app.css'].file), 'utf8').replaceAll('/build/assets/', '');
fs.writeFileSync(path.join(root, 'assets/app.css'), css);
for (const font of fs.readdirSync('public/build/assets').filter(n => /\.woff2?$/.test(n))) fs.copyFileSync(path.join('public/build/assets', font), path.join(root, 'assets', font));

(async () => {
  const browser = await chromium.launch({ executablePath: 'C:/Users/Python/AppData/Local/Google/Chrome SxS/Application/chrome.exe', headless: true });
  const results = [];
  try {
    for (const name of ['reportgral', 'agen.index']) for (const theme of ['dark', 'light']) for (const width of [375, 768, 1366]) {
      const page = await browser.newPage({ viewport: { width, height: 900 }, colorScheme: theme });
      await page.route('**/*', route => route.request().url().startsWith(pathToFileURL(root).href) ? route.continue() : route.abort());
      await page.goto(pathToFileURL(path.join(root, `${name}-${theme}.html`)).href);
      await page.evaluate(() => document.fonts.ready);
      const m = await page.evaluate(() => {
        const all = [...document.querySelectorAll('[aria-label="Agregar registro"]')];
        const add = all[0], pdf = document.querySelector('[aria-label="Exportar a PDF"]');
        const body = document.getElementById('accordion-collapse-body-1');
        const grid = body.querySelector('.grid'), cards = [...grid.children];
        const a = add.getBoundingClientRect(), p = pdf.getBoundingClientRect();
        return { count: all.length, toolbar: !!add.closest('#accordion-collapse-heading-1'), inFilters: body.contains(add), addTop: a.top, pdfTop: p.top, href: add.getAttribute('href'), action: add.getAttribute('wire:click'), filterCards: cards.length, rows: new Set(cards.map(c => Math.round(c.getBoundingClientRect().top))).size, scrollWidth: document.documentElement.scrollWidth, clientWidth: document.documentElement.clientWidth, buttons: [a.width, a.height, p.width, p.height] };
      });
      results.push({ page: name, theme, width, ...m });
      await page.screenshot({ path: path.join(evidence, `${name}-${theme}-${width}.png`), fullPage: true });
      await page.close();
    }
  } finally { await browser.close(); }
  fs.writeFileSync(path.join(evidence, 'medidas.json'), JSON.stringify(results, null, 2));
  const failed = results.filter(r => r.count !== 1 || !r.toolbar || r.inFilters || Math.abs(r.addTop - r.pdfTop) > 1 || r.scrollWidth > r.clientWidth || r.filterCards !== (r.page === 'reportgral' ? 8 : 4) || (r.width === 1366 && r.rows !== (r.page === 'reportgral' ? 2 : 1)) || (r.page === 'reportgral' ? !r.href?.endsWith('/rg/create') : r.action !== 'openInsertModal'));
  console.log(JSON.stringify({ cases: results.length, failures: failed }, null, 2));
  process.exitCode = failed.length ? 1 : 0;
})().catch(error => { console.error(error.message); process.exitCode = 1; });
