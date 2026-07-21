import { chromium } from "playwright";

const base = process.argv[2] ?? "http://127.0.0.1:8013";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
await page.goto(base + "/", { waitUntil: "networkidle" });
await page.waitForTimeout(3200);
await page.evaluate(() => {
  document.querySelector('[data-home-experience]').scrollIntoView({ block: 'start' });
});
await page.waitForTimeout(2500); // let ALL reveal animations fully finish

const probe = await page.evaluate(() => {
  const results = [];
  for (const [x, y] of [[800, 10], [800, 30], [700, 15], [900, 15]]) {
    const el = document.elementFromPoint(x, y);
    results.push({
      x, y,
      tag: el?.tagName,
      cls: (el?.className || '').toString().slice(0, 120),
      bg: el ? getComputedStyle(el).backgroundColor : null,
    });
  }
  return results;
});
await page.screenshot({ path: "scripts/out/probe-settled.png" });
console.log(JSON.stringify(probe, null, 2));
await browser.close();
