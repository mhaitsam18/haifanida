import { chromium } from "playwright";

const base = process.argv[2] ?? "http://127.0.0.1:8013";
const browser = await chromium.launch({ args: ["--no-sandbox"] });
const out = {};

// --- 1. Homepage, normal motion ------------------------------------------
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));

  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(3200);
  await page.screenshot({ path: "scripts/out/homeexp-01-arrival.png" });

  // Header height stability across the scroll range (paint-only promise).
  const header = await page.$("header");
  const heights = new Set();
  for (let y = 0; y <= 400; y += 25) {
    await page.evaluate((sy) => window.scrollTo(0, sy), y);
    await page.waitForTimeout(25);
    heights.add(Math.round(await header.evaluate((el) => el.getBoundingClientRect().height)));
  }

  // Scroll to Chapter 2 (past the 260% pin) and let reveals play.
  await page.evaluate(() => {
    document.querySelector('[data-home-experience]').scrollIntoView({ block: 'start' });
  });
  await page.waitForTimeout(1600);
  await page.screenshot({ path: "scripts/out/homeexp-02-chapter2.png" });

  const chapter2 = await page.evaluate(() => {
    const card = document.querySelector('[data-unfold]');
    const headerEl = document.querySelector('[data-reveal]');
    return {
      cardOpacity: getComputedStyle(card).opacity,
      headerOpacity: getComputedStyle(headerEl).opacity,
    };
  });

  // Chapter 3: counter + seal.
  await page.evaluate(() => {
    document.querySelectorAll('section')[2]?.scrollIntoView({ block: 'center' });
  });
  await page.waitForTimeout(2200);
  await page.screenshot({ path: "scripts/out/homeexp-03-chapter3.png" });

  const chapter3 = await page.evaluate(() => ({
    counters: [...document.querySelectorAll('[data-counter]')].map((el) => ({
      shown: el.textContent.trim(),
      target: el.dataset.counter,
    })),
    sealOpacity: getComputedStyle(document.querySelector('[data-seal]')).opacity,
  }));

  const nav = await page.evaluate(() => ({
    hasHomeNav: !!document.querySelector('[data-home-nav]'),
    hasProgress: !!document.querySelector('[data-nav-progress]'),
    progressScaleX: getComputedStyle(document.querySelector('[data-nav-progress]')).transform,
  }));

  out.home = { headerHeights: [...heights], chapter2, chapter3, nav, errors };
  await page.context().close();
}

// --- 2. Homepage, reduced motion ------------------------------------------
{
  const context = await browser.newContext({ viewport: { width: 1600, height: 900 } });
  const page = await context.newPage();
  await page.emulateMedia({ reducedMotion: "reduce" });
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(base + "/", { waitUntil: "networkidle" });
  await page.waitForTimeout(800);
  // Without scrolling at all, chapter content must already be fully visible.
  const visible = await page.evaluate(() => {
    const card = document.querySelector('[data-unfold]');
    const counter = document.querySelector('[data-counter]');
    return {
      cardOpacity: getComputedStyle(card).opacity,
      counterText: counter.textContent.trim(),
    };
  });
  out.homeReducedMotion = { ...visible, errors };
  await context.close();
}

// --- 3. Another page: byte-level absence of homepage markers ---------------
{
  const page = await (await browser.newContext({ viewport: { width: 1600, height: 900 } })).newPage();
  const errors = [];
  page.on("console", (m) => { if (m.type() === "error") errors.push(m.text()); });
  page.on("pageerror", (e) => errors.push(`pageerror: ${e.message}`));
  await page.goto(base + "/umroh", { waitUntil: "networkidle" });
  const markers = await page.evaluate(() => ({
    homeNav: !!document.querySelector('[data-home-nav]'),
    progress: !!document.querySelector('[data-nav-progress]'),
    experience: !!document.querySelector('[data-home-experience]'),
    hero: !!document.querySelector('[data-cinematic-hero]'),
  }));
  await page.screenshot({ path: "scripts/out/homeexp-04-umroh-unchanged.png" });
  out.umroh = { markers, errors };
  await page.context().close();
}

await browser.close();
console.log(JSON.stringify(out, null, 2));
