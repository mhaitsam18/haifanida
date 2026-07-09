import { chromium } from "playwright";

const url = (process.argv[2] ?? "http://127.0.0.1:8012") + "/umroh";
const browser = await chromium.launch({ args: ["--no-sandbox"] });

const viewports = [
  { name: "desktop", width: 1440, height: 900 },
  { name: "tablet", width: 820, height: 1180 },
  { name: "mobile", width: 390, height: 844 },
];

const results = {};

for (const vp of viewports) {
  const page = await (await browser.newContext({ viewport: { width: vp.width, height: vp.height } })).newPage();
  const errors = [];
  page.on("pageerror", (e) => errors.push(e.message));
  await page.goto(url, { waitUntil: "networkidle" });
  await page.waitForSelector("#filterForm");
  await page.screenshot({ path: `scripts/out/umroh-filter-${vp.name}.png` });

  // Overlap detection: for each pair of filter controls, check their bounding
  // boxes don't intersect (allowing a 1px rounding tolerance).
  const overlap = await page.evaluate(() => {
    const controls = [...document.querySelectorAll('#filterForm input, #filterForm select, #filterForm button, #filterForm a')];
    const boxes = controls.map((el) => ({
      name: el.name || el.tagName.toLowerCase() + (el.type ? `[${el.type}]` : ''),
      r: el.getBoundingClientRect(),
    }));
    const hits = [];
    for (let i = 0; i < boxes.length; i++) {
      for (let j = i + 1; j < boxes.length; j++) {
        const a = boxes[i].r, b = boxes[j].r;
        const intersect = a.left < b.right - 1 && a.right > b.left + 1 && a.top < b.bottom - 1 && a.bottom > b.top + 1;
        if (intersect) hits.push(`${boxes[i].name} <-> ${boxes[j].name}`);
      }
    }
    // Also flag any control overflowing the form's right edge.
    const formR = document.querySelector('#filterForm').getBoundingClientRect();
    const overflow = boxes.filter((b) => b.r.right > formR.right + 1).map((b) => b.name);
    return { hits, overflow };
  });

  results[vp.name] = { ...overlap, errors };
}

await browser.close();
console.log(JSON.stringify(results, null, 2));
