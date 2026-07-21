import { chromium } from "playwright";
const base = "http://127.0.0.1:8016";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const pages = ["/","/umroh","/haji","/wisata-halal","/paket/1","/sejarah","/visi-misi","/kontak-kami","/kuesioner","/keluhan","/panduan","/syarat-ketentuan","/kebijakan-privasi","/faq","/profil","/galeri","/galeri/1","/artikel"];
// Ignore benign errors from external embeds (Google Maps/Forms) — not our code.
const benign = (e) => /google|gstatic|ERR_FILE_NOT_FOUND|400 \(\)|maps|recaptcha/i.test(e);
const results = {};
for (const path of pages) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push("pageerror: "+e.message));
  let status = 0;
  try { const r = await page.goto(base+path, { waitUntil: "networkidle", timeout: 20000 }); status = r.status(); }
  catch(e){ status = "TIMEOUT"; }
  await page.waitForTimeout(400);
  const struct = await page.evaluate(() => ({
    nav: !!document.querySelector('[data-premium-nav]'),
    footer: !!document.querySelector('footer'),
    title: document.title,
  }));
  const realErrors = errors.filter(e => !benign(e));
  results[path] = { status, nav: struct.nav, footer: struct.footer, realErrors };
  await page.context().close();
}
await browser.close();
console.log(JSON.stringify(results, null, 2));
