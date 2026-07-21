import { chromium } from "playwright";

const base = process.argv[2] ?? "http://127.0.0.1:8014";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};

// --- Homepage, wide viewport: thread + dawn bridge + chapters --------------
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(3200);

  await page.evaluate(() => document.querySelector('[data-home-experience]').scrollIntoView({ block: 'start' }));
  await page.waitForTimeout(1800);
  await page.screenshot({ path: "scripts/out/thread-01-chapter2.png" });

  await page.evaluate(() => document.querySelectorAll('[data-journey-node]')[1].scrollIntoView({ block: 'center' }));
  await page.waitForTimeout(1800);
  await page.screenshot({ path: "scripts/out/thread-02-chapter3.png" });

  const thread = await page.evaluate(() => {
    const path = document.querySelector('[data-journey-path]');
    const svg = document.querySelector('[data-journey-svg]');
    return {
      hasD: !!path.getAttribute('d') && path.getAttribute('d').length > 20,
      dashOffset: parseFloat(getComputedStyle(path).strokeDashoffset),
      totalLength: path.getTotalLength(),
      circleCount: svg.querySelectorAll('circle').length,
      svgDisplay: getComputedStyle(svg).display,
    };
  });
  out.homeWide = { thread, errors };
  await page.context().close();
}

// --- Homepage, laptop viewport (no gutter): thread hidden ------------------
{
  const page = await (await browser.newContext({ viewport: { width: 1280, height: 800 } })).newPage();
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(1500);
  const thread = await page.evaluate(() => {
    const svg = document.querySelector('[data-journey-svg]');
    const path = document.querySelector('[data-journey-path]');
    return { svgDisplay: getComputedStyle(svg).display, hasD: !!path.getAttribute('d') };
  });
  out.homeLaptop = { thread, errors };
  await page.context().close();
}

// --- Homepage, reduced motion: thread fully drawn --------------------------
{
  const context = await browser.newContext({ viewport: { width: 1600, height: 900 } });
  const page = await context.newPage();
  await page.emulateMedia({ reducedMotion: "reduce" });
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(1200);
  const thread = await page.evaluate(() => {
    const path = document.querySelector('[data-journey-path]');
    return {
      hasD: !!path.getAttribute('d'),
      dashOffset: parseFloat(getComputedStyle(path).strokeDashoffset),
      circlesVisible: [...document.querySelectorAll('[data-journey-svg] circle')].every(
        (c) => getComputedStyle(c).opacity === '1'
      ),
    };
  });
  out.homeReducedMotion = { thread, errors };
  await context.close();
}

// --- Other page: global nav works, no homepage leakage ---------------------
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + "/umroh", { waitUntil: "networkidle" });
  await page.waitForTimeout(800);

  const header = await page.$("header");
  const heightTop = Math.round(await header.evaluate((el) => el.getBoundingClientRect().height));
  await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight / 2));
  await page.waitForTimeout(500);
  const heightScrolled = Math.round(await header.evaluate((el) => el.getBoundingClientRect().height));

  const nav = await page.evaluate(() => {
    const progress = document.querySelector('[data-nav-progress]');
    return {
      hasPremiumNav: !!document.querySelector('[data-premium-nav]'),
      progressTransform: getComputedStyle(progress).transform,
      journeySvg: !!document.querySelector('[data-journey-svg]'),
    };
  });
  await page.screenshot({ path: "scripts/out/thread-03-umroh-globalnav.png" });
  out.umroh = { nav, heightTop, heightScrolled, errors };
  await page.context().close();
}

await browser.close();
console.log(JSON.stringify(out, null, 2));
