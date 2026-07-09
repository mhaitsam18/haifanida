import { chromium } from "playwright";

const url = process.argv[2] ?? "http://127.0.0.1:8010";

const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();

const consoleErrors = [];
page.on("console", (msg) => { if (msg.type() === "error") consoleErrors.push(msg.text()); });
page.on("pageerror", (err) => consoleErrors.push(`pageerror: ${err.message}`));

await page.goto(url, { waitUntil: "networkidle" });
await page.waitForSelector('[data-cinematic-hero]');
await page.waitForTimeout(3200);
await page.screenshot({ path: "scripts/out/laravel-01-arrival.png" });

await page.evaluate(() => window.scrollTo(0, window.innerHeight * 1.3));
await page.waitForTimeout(600);
await page.screenshot({ path: "scripts/out/laravel-02-midscroll.png" });

await page.evaluate(() => window.scrollTo(0, window.innerHeight * 3.0));
await page.waitForTimeout(600);
await page.screenshot({ path: "scripts/out/laravel-03-afterhero.png" });

await page.setViewportSize({ width: 390, height: 844 });
await page.evaluate(() => window.scrollTo(0, 0));
await page.waitForTimeout(3200);
await page.screenshot({ path: "scripts/out/laravel-04-mobile.png" });

await browser.close();
console.log(JSON.stringify({ consoleErrors }));
