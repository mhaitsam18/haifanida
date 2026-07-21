import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};
for (const [name, path] of [["sejarah","/sejarah"],["visi-misi","/visi-misi"]]) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto("http://127.0.0.1:8016"+path, { waitUntil: "networkidle" });
  await page.waitForTimeout(1400);
  await page.screenshot({ path: `scripts/out/p5-${name}.png`, fullPage: true });
  // verify all content preserved
  const bodyText = await page.evaluate(() => document.body.innerText);
  out[name] = {
    errors,
    hasKomitmen: bodyText.includes("Komitmen Kami"),
    hasAkreditasi: bodyText.includes("akreditasi A"),
    misiCount: (bodyText.match(/tamu-tamu Allah/g) || []).length,
  };
  await page.context().close();
}
await browser.close();
console.log(JSON.stringify(out, null, 2));
