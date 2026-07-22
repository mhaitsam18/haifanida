import { chromium } from "playwright";
const base = process.argv[2] || "http://127.0.0.1:8017";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const pages = ["/","/umroh","/haji","/wisata-halal","/paket/1","/sejarah","/visi-misi","/kontak-kami","/kuesioner","/keluhan","/panduan","/syarat-ketentuan","/kebijakan-privasi","/faq","/profil","/galeri","/galeri/1","/artikel"];
const benign = (e) => /google|gstatic|ERR_FILE_NOT_FOUND|400 \(\)|403 \(\)|maps|recaptcha/i.test(e);
const results = {};
for (const path of pages) {
  const page = await (await browser.newContext({ viewport: { width: 1440, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type()==="error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push("pageerror: "+e.message));
  let status = 0;
  try { const r = await page.goto(base+path, { waitUntil: "networkidle", timeout: 20000 }); status = r.status(); }
  catch(e){ status = "TIMEOUT"; }
  await page.waitForTimeout(300);
  const struct = await page.evaluate(() => ({ nav: !!document.querySelector('[data-premium-nav]'), footer: !!document.querySelector('footer') }));
  results[path] = { status, nav: struct.nav, footer: struct.footer, realErrors: errors.filter(e => !benign(e)) };
  await page.context().close();
}
await browser.close();
const bad = Object.entries(results).filter(([k,v])=>v.status!==200||!v.nav||!v.footer||v.realErrors.length);
console.log(bad.length ? 'ISSUES:\n'+JSON.stringify(Object.fromEntries(bad),null,1) : 'ALL 18 PAGES OK: 200 + nav + footer + no real console errors');
