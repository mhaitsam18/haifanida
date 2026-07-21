import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
const errors = [];
page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
page.on("pageerror", (e) => errors.push(e.message));
await page.goto("http://127.0.0.1:8015/galeri", { waitUntil: "networkidle" });
await page.waitForTimeout(1400);
await page.screenshot({ path: "scripts/out/p3-gallery-albums.png" });
await page.click('a[href*="/galeri/"]');
await page.waitForLoadState("networkidle");
await page.waitForTimeout(1400);
await page.screenshot({ path: "scripts/out/p3-gallery-album-detail.png" });
// Open lightbox on first photo
await page.click('button.cursor-zoom-in');
await page.waitForTimeout(700);
await page.screenshot({ path: "scripts/out/p3-gallery-lightbox.png" });
console.log(JSON.stringify({ errors }));
await browser.close();
