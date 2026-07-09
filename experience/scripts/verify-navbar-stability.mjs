import { chromium } from "playwright";

const url = process.argv[2] ?? "http://127.0.0.1:8011";

const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();

const errors = [];
page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));

await page.goto(url, { waitUntil: "networkidle" });
await page.waitForSelector('[data-cinematic-hero]');
await page.waitForTimeout(500); // before the intro timeline finishes, matching real early-scroll behavior

const header = await page.$("header");

async function headerHeight() {
  return await header.evaluate((el) => el.getBoundingClientRect().height);
}

const heightBeforeScroll = await headerHeight();

// Sample header height across many small scroll steps through the exact
// zone where `scrolled` flips true (scrollY > 12) and the Hero pin engages.
const samples = [];
for (let y = 0; y <= 300; y += 10) {
  await page.evaluate((sy) => window.scrollTo(0, sy), y);
  await page.waitForTimeout(30);
  samples.push({ y, height: await headerHeight() });
}

await page.screenshot({ path: "scripts/out/navbar-01-scrolled.png" });

// Back to top, confirm it returns to the exact same height (no residual state).
await page.evaluate(() => window.scrollTo(0, 0));
await page.waitForTimeout(300);
const heightAfterReturn = await headerHeight();

const distinctHeights = [...new Set(samples.map((s) => Math.round(s.height)))];

await browser.close();

console.log(JSON.stringify({
  heightBeforeScroll,
  heightAfterReturn,
  distinctHeightsDuringScroll: distinctHeights,
  errors,
}, null, 2));
