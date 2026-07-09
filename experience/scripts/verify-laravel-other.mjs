import { chromium } from "playwright";

const base = process.argv[2] ?? "http://127.0.0.1:8010";

const browser = await chromium.launch({ args: ["--no-sandbox"] });

// Reduced motion on the homepage.
{
  const context = await browser.newContext({ viewport: { width: 1600, height: 900 } });
  const page = await context.newPage();
  await page.emulateMedia({ reducedMotion: "reduce" });
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(1000);
  await page.screenshot({ path: "scripts/out/laravel-05-reduced-motion.png" });
  await page.evaluate(() => window.scrollTo(0, window.innerHeight * 2));
  const scrollY = await page.evaluate(() => window.scrollY);
  console.log(JSON.stringify({ page: "home-reduced-motion", scrollY, errors }));
  await context.close();
}

// A different public page, to confirm the global bundle doesn't break anything there.
{
  const context = await browser.newContext({ viewport: { width: 1600, height: 900 } });
  const page = await context.newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  const response = await page.goto(base + "/umroh", { waitUntil: "networkidle" });
  await page.waitForTimeout(500);
  const hasHeroMarker = await page.evaluate(() => !!document.querySelector('[data-cinematic-hero]'));
  await page.screenshot({ path: "scripts/out/laravel-06-umroh-page.png" });
  console.log(JSON.stringify({ page: "umroh", status: response.status(), hasHeroMarker, errors }));
  await context.close();
}

await browser.close();
