import { chromium } from "playwright";
const base = process.argv[2] || "http://127.0.0.1:8017";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
for (const rm of ["reduce", "no-preference"]) {
  const ctx = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await ctx.newPage();
  await page.emulateMedia({ reducedMotion: rm });
  await page.goto(base+"/faq", { waitUntil: "networkidle" });
  await page.waitForTimeout(400);
  const prop = await page.evaluate(() => {
    const btn = document.querySelector('button[aria-controls^="faq-panel"]');
    const panel = document.getElementById(btn.getAttribute('aria-controls'));
    return getComputedStyle(panel).transitionProperty;
  });
  console.log(`reducedMotion=${rm}: transition-property = ${prop}`);
  await ctx.close();
}
await browser.close();
