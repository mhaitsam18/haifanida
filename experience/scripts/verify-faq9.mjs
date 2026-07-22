import { chromium } from "playwright";
const base = process.argv[2] || "http://127.0.0.1:8017";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
await page.goto(base+"/faq", { waitUntil: "networkidle" });
await page.waitForTimeout(1000);
// Detect columns by distinct x-positions of accordion cards (desktop)
const layout = await page.evaluate(() => {
  const btns = [...document.querySelectorAll('button[aria-controls^="faq-panel"]')];
  const xs = [...new Set(btns.map(b => Math.round(b.getBoundingClientRect().left)))];
  return { items: btns.length, distinctColumnX: xs.length };
});
await page.click('button[aria-controls^="faq-panel"]');
await page.waitForTimeout(500);
const opened = await page.evaluate(() => {
  const btn = document.querySelector('button[aria-controls^="faq-panel"]');
  const panel = document.getElementById(btn.getAttribute('aria-controls'));
  return {
    ariaExpanded: btn.getAttribute('aria-expanded'),
    panelIsGrid: getComputedStyle(panel).display === 'grid',
    gridRowsOpen: getComputedStyle(panel).gridTemplateRows !== '0px',
  };
});
await page.screenshot({ path: "scripts/out/p9-faq-2col.png" });
await page.setViewportSize({ width: 390, height: 844 });
await page.waitForTimeout(300);
const mobileCols = await page.evaluate(() => {
  const btns = [...document.querySelectorAll('button[aria-controls^="faq-panel"]')];
  return [...new Set(btns.map(b => Math.round(b.getBoundingClientRect().left)))].length;
});
await page.screenshot({ path: "scripts/out/p9-faq-mobile.png" });
await browser.close();
console.log(JSON.stringify({ desktop: layout, opened, mobileDistinctColumnX: mobileCols }, null, 2));
