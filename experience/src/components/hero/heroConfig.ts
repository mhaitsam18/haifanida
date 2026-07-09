/**
 * Fixed asset paths — replacing the Hero's imagery later means dropping
 * new files at these exact paths in /public/hero/, nothing in the
 * component tree references a filename directly. Keep the aspect ratios
 * close to the current placeholders (landscape, ~16:10) when swapping so
 * the parallax framing doesn't need retuning.
 */
export const HERO_ASSETS = {
  sky: "/hero/sky.jpg",
  haramFar: "/hero/haram-far.jpg",
  kaabaMid: "/hero/kaaba-mid.jpg",
} as const;

export const HERO_COPY = {
  eyebrow: "Haifa Nida Wisata",
  headline: "Setiap langkah adalah awal dari perjalanan suci.",
  subhead:
    "Rasakan momen sebelum tiba di Tanah Suci — dari halaman rumah Anda, hingga Ka'bah di hadapan mata.",
  cta: "Mulai Perjalanan Anda",
} as const;

/** Approximate position (in %) of the sun disc within sky.jpg, used to anchor the god-ray overlay. */
export const HERO_SUN_POSITION = { xPercent: 46, yPercent: 18 } as const;

export const HERO_TUNING = {
  pinDistance: "+=260%",
  scrub: 1,
  dustCountDesktop: 46,
  dustCountMobile: 18,
  birdCount: 4,
} as const;
