import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};
for (const [name, path] of [["umroh-empty","/umroh"],["haji-empty","/haji"],["detail","/paket/1"]]) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(e.message));
  const resp = await page.goto("http://127.0.0.1:8016"+path, { waitUntil: "networkidle" });
  await page.waitForTimeout(1400);
  await page.screenshot({ path: `scripts/out/p4-${name}.png`, fullPage: name==="detail" });
  out[name] = { status: resp.status(), errors };
  await page.context().close();
}
// mobile detail
{
  const page = await (await browser.newContext({ viewport: { width: 390, height: 844 } })).newPage();
  await page.goto("http://127.0.0.1:8016/paket/1", { waitUntil: "networkidle" });
  await page.waitForTimeout(1000);
  await page.screenshot({ path: "scripts/out/p4-detail-mobile.png" });
  await page.context().close();
}
await browser.close();
console.log(JSON.stringify(out, null, 2));
