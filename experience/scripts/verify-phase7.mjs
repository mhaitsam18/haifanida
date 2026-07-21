import { chromium } from "playwright";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};
for (const [name, path] of [["panduan","/panduan"],["syarat","/syarat-ketentuan"],["privasi","/kebijakan-privasi"]]) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto("http://127.0.0.1:8016"+path, { waitUntil: "networkidle" });
  await page.waitForTimeout(800);
  await page.screenshot({ path: `scripts/out/p7-${name}.png` });
  out[name] = { errors };
  await page.context().close();
}
// Scroll-spy test on syarat-ketentuan: scroll to section C and check active TOC link
{
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  await page.goto("http://127.0.0.1:8016/syarat-ketentuan", { waitUntil: "networkidle" });
  await page.evaluate(() => document.querySelector('#perjalanan').scrollIntoView({ block: 'start' }));
  await page.waitForTimeout(700);
  const active = await page.evaluate(() => {
    const a = document.querySelector('[data-legal-toc] a.is-active');
    return a ? a.getAttribute('data-toc-link') : null;
  });
  // Click a TOC link and verify it jumps
  await page.click('[data-toc-link="visa"]');
  await page.waitForTimeout(600);
  const scrolledToVisa = await page.evaluate(() => {
    const r = document.querySelector('#visa').getBoundingClientRect();
    return r.top < 200 && r.top > -50; // near top under sticky header
  });
  await page.evaluate(() => document.querySelector('#perjalanan').scrollIntoView({ block: 'start' }));
  await page.waitForTimeout(600);
  await page.screenshot({ path: "scripts/out/p7-syarat-scrollspy.png" });
  out.scrollSpy = { activeAtPerjalanan: active, tocJumpWorks: scrolledToVisa };
  await page.context().close();
}
await browser.close();
console.log(JSON.stringify(out, null, 2));
