import { chromium } from "playwright";
const base = "http://127.0.0.1:8016";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const benign = (e) => /google|gstatic|ERR_FILE_NOT_FOUND|400 \(\)|403 \(\)|maps|recaptcha/i.test(e);
const out = {};
// Mobile pass on a representative subset
const mobilePages = ["/","/umroh","/sejarah","/kontak-kami","/syarat-ketentuan","/galeri","/faq"];
for (const path of mobilePages) {
  const page = await (await browser.newContext({ viewport: { width: 390, height: 844 } })).newPage();
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(base+path, { waitUntil: "networkidle" });
  await page.waitForTimeout(500);
  // check no horizontal overflow
  const overflow = await page.evaluate(() => document.documentElement.scrollWidth > window.innerWidth + 2);
  out["mobile "+path] = { hOverflow: overflow, errors: errors.filter(e=>!benign(e)) };
  await page.context().close();
}
// Reduced-motion: homepage + a content page must be fully visible without scrolling
for (const path of ["/","/sejarah","/faq"]) {
  const ctx = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await ctx.newPage();
  await page.emulateMedia({ reducedMotion: "reduce" });
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(base+path, { waitUntil: "networkidle" });
  await page.waitForTimeout(700);
  // Every [data-reveal] must be visible (opacity 1) without scrolling
  const allVisible = await page.evaluate(() =>
    [...document.querySelectorAll('[data-reveal]')].every(el => getComputedStyle(el).opacity === '1')
  );
  out["reduced "+path] = { allRevealVisible: allVisible, errors: errors.filter(e=>!benign(e)) };
  await ctx.close();
}
await browser.close();
console.log(JSON.stringify(out, null, 2));
