import { chromium } from "playwright";

const base = process.argv[2] ?? "http://127.0.0.1:8015";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};

// Banner pages: new banner renders, reveal plays, no errors.
for (const [name, path] of [["sejarah", "/sejarah"], ["faq", "/faq"], ["kontak", "/kontak-kami"]]) {
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + path, { waitUntil: "networkidle" });
  await page.waitForTimeout(1200);
  const banner = await page.evaluate(() => {
    const el = document.querySelector('[data-reveal]');
    return el ? { opacity: getComputedStyle(el).opacity, text: el.querySelector('h1')?.textContent.trim() } : null;
  });
  if (name === "sejarah") await page.screenshot({ path: "scripts/out/p1-banner-sejarah.png" });
  out[name] = { banner, errors };
  await page.context().close();
}

// Nav links updated.
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  await page.goto(base + "/", { waitUntil: "networkidle" });
  const links = await page.evaluate(() => {
    const all = [...document.querySelectorAll('header a')];
    return {
      artikel: all.find((a) => a.textContent.trim() === 'Artikel')?.getAttribute('href'),
      kajian: all.find((a) => a.textContent.trim() === 'Kajian')?.getAttribute('href'),
    };
  });
  out.navLinks = links;
  await page.context().close();
}

// Profil iframe src updated.
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  await page.goto(base + "/profil", { waitUntil: "domcontentloaded" });
  out.profilIframe = await page.evaluate(() =>
    document.querySelector('iframe[src*="drive.google.com"]')?.getAttribute('src')
  );
  await page.context().close();
}

// Homepage regression: hero + thread + reveals still fine.
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(3200);
  await page.evaluate(() => document.querySelector('[data-home-experience]').scrollIntoView());
  await page.waitForTimeout(1500);
  out.homeRegression = {
    cardOpacity: await page.evaluate(() => getComputedStyle(document.querySelector('[data-unfold]')).opacity),
    threadHasD: await page.evaluate(() => !!document.querySelector('[data-journey-path]')?.getAttribute('d')),
    errors,
  };
  await page.context().close();
}

await browser.close();
console.log(JSON.stringify(out, null, 2));
