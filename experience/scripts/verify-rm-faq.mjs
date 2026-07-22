import { chromium } from "playwright";
const base = process.argv[2] || "http://127.0.0.1:8017";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const ctx = await browser.newContext({ viewport: { width: 1440, height: 900 } });
const page = await ctx.newPage();
await page.emulateMedia({ reducedMotion: "reduce" });
await page.goto(base+"/faq", { waitUntil: "networkidle" });
await page.waitForTimeout(600);
// grid-rows transition should be 'none' under reduced motion (motion-reduce:transition-none)
const t = await page.evaluate(() => {
  const btn = document.querySelector('button[aria-controls^="faq-panel"]');
  const panel = document.getElementById(btn.getAttribute('aria-controls'));
  return getComputedStyle(panel).transitionDuration;
});
await ctx.close(); await browser.close();
console.log("reduced-motion FAQ panel transition-duration:", t);
