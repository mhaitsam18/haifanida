import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};
for (const [name, path] of [["kontak","/kontak-kami"],["kuesioner","/kuesioner"],["keluhan","/keluhan"]]) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto("http://127.0.0.1:8016"+path, { waitUntil: "domcontentloaded" });
  await page.waitForTimeout(1600);
  await page.screenshot({ path: `scripts/out/p6-${name}.png` });
  out[name] = { errors };
  await page.context().close();
}
// Test contact form loading state (fill + submit interception check)
{
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  await page.goto("http://127.0.0.1:8016/kontak-kami", { waitUntil: "networkidle" });
  const btnBefore = await page.evaluate(() => document.querySelector('#contactForm button[type=submit]').innerText.trim());
  out.contactSubmitButton = { label: btnBefore };
  await page.context().close();
}
await browser.close();
console.log(JSON.stringify(out, null, 2));
