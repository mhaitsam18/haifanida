import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
await page.goto("http://127.0.0.1:8016/visi-misi", { waitUntil: "networkidle" });
for (let y = 0; y < 2000; y += 350) { await page.evaluate((sy)=>window.scrollTo(0,sy), y); await page.waitForTimeout(120); }
await page.waitForTimeout(500);
const misiVisible = await page.evaluate(() => {
  const cards = [...document.querySelectorAll('[data-reveal]')].filter(el => /^\d\./.test(el.innerText) || el.querySelector('.rounded-full'));
  const misiCards = [...document.querySelectorAll('.grid [data-reveal]')];
  return { misiCardCount: misiCards.length, allVisible: misiCards.every(c => getComputedStyle(c).opacity === '1') };
});
await page.evaluate(() => [...document.querySelectorAll('h2')].find(h=>h.textContent.trim()==='Misi')?.scrollIntoView({block:'start'}));
await page.waitForTimeout(500);
await page.screenshot({ path: "scripts/out/p5-visi-misi-misi.png" });
console.log(JSON.stringify(misiVisible));
await browser.close();
