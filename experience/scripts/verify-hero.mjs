import { chromium } from "playwright";

const url = process.argv[2] ?? "http://localhost:3200";

const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();

const consoleErrors = [];
page.on("console", (msg) => {
  if (msg.type() === "error") consoleErrors.push(msg.text());
});
page.on("pageerror", (err) => consoleErrors.push(`pageerror: ${err.message}`));

await page.goto(url, { waitUntil: "networkidle" });
await page.waitForSelector('[aria-label="Perjalanan Anda menuju Tanah Suci dimulai di sini"]');

// Let the autoplay arrival timeline finish (~2.8s) before the first shot.
await page.waitForTimeout(3200);
await page.screenshot({ path: "scripts/out/hero-01-arrival.png" });

// Scroll partway through the pinned section's scroll distance.
await page.evaluate(() => window.scrollTo(0, window.innerHeight * 1.3));
await page.waitForTimeout(600);
await page.screenshot({ path: "scripts/out/hero-02-midscroll.png" });

// Scroll to (roughly) the end of the pin distance.
await page.evaluate(() => window.scrollTo(0, window.innerHeight * 2.5));
await page.waitForTimeout(600);
await page.screenshot({ path: "scripts/out/hero-03-endscroll.png" });

// Mobile viewport check.
await page.setViewportSize({ width: 390, height: 844 });
await page.evaluate(() => window.scrollTo(0, 0));
await page.waitForTimeout(3200);
await page.screenshot({ path: "scripts/out/hero-04-mobile.png" });

await browser.close();

console.log("CONSOLE_ERRORS_JSON_START");
console.log(JSON.stringify(consoleErrors));
console.log("CONSOLE_ERRORS_JSON_END");
