import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
await page.goto("http://127.0.0.1:8016/sejarah", { waitUntil: "networkidle" });
// Scroll through in steps to trigger all reveals
for (let y = 0; y < 4000; y += 400) {
  await page.evaluate((sy) => window.scrollTo(0, sy), y);
  await page.waitForTimeout(120);
}
await page.waitForTimeout(600);
// Now check opacity of all 6 chapters
const opacities = await page.evaluate(() =>
  [...document.querySelectorAll('[data-reveal] .rounded-2xl')].slice(0,6).map(el => getComputedStyle(el.closest('[data-reveal]')).opacity)
);
// Screenshot chapter 6 (komitmen) region
await page.evaluate(() => document.body.innerText.includes("Komitmen") && [...document.querySelectorAll('h3')].find(h=>h.textContent.includes("Komitmen"))?.scrollIntoView({block:'center'}));
await page.waitForTimeout(500);
await page.screenshot({ path: "scripts/out/p5-sejarah-chapter6.png" });
console.log(JSON.stringify({ chapterOpacities: opacities }));
await browser.close();
