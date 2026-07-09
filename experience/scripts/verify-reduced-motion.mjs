import { chromium } from "playwright";

const url = process.argv[2] ?? "http://localhost:3100";

const browser = await chromium.launch({ args: ["--no-sandbox"] });
const context = await browser.newContext({ viewport: { width: 1600, height: 900 } });
const page = await context.newPage();
await page.emulateMedia({ reducedMotion: "reduce" });

const consoleErrors = [];
page.on("console", (msg) => { if (msg.type() === "error") consoleErrors.push(msg.text()); });
page.on("pageerror", (err) => consoleErrors.push(`pageerror: ${err.message}`));

await page.goto(url, { waitUntil: "networkidle" });
await page.waitForTimeout(1200);
await page.screenshot({ path: "scripts/out/hero-05-reduced-motion.png" });

// Scroll well past the pin distance and confirm the page does NOT pin/scroll-jack.
await page.evaluate(() => window.scrollTo(0, window.innerHeight * 1.5));
await page.waitForTimeout(300);
const scrollY = await page.evaluate(() => window.scrollY);
await page.screenshot({ path: "scripts/out/hero-06-reduced-motion-scrolled.png" });

console.log(JSON.stringify({ scrollY, consoleErrors }));
await browser.close();
