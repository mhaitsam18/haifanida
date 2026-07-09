"use client";

import dynamic from "next/dynamic";
import { useRef } from "react";
import { usePrefersReducedMotion } from "@/hooks/usePrefersReducedMotion";
import { useIsMobile } from "@/hooks/useIsMobile";
import HeroParallaxLayer from "./HeroParallaxLayer";
import HeroGodRays from "./HeroGodRays";
import HeroBirds from "./HeroBirds";
import HeroTypography from "./HeroTypography";
import { useHeroTimeline } from "./useHeroTimeline";
import { HERO_ASSETS, HERO_SUN_POSITION, HERO_TUNING } from "./heroConfig";

// Canvas particle loop is the one genuinely heavy piece here — keep it out
// of the initial client bundle and never render it on the server.
const HeroAtmosphere = dynamic(() => import("./HeroAtmosphere"), { ssr: false });

export default function Hero() {
  const reducedMotion = usePrefersReducedMotion();
  const isMobile = useIsMobile();

  const section = useRef<HTMLElement>(null);
  const sky = useRef<HTMLDivElement>(null);
  const haramFar = useRef<HTMLDivElement>(null);
  const kaabaMid = useRef<HTMLDivElement>(null);
  const godRays = useRef<HTMLDivElement>(null);
  const vignette = useRef<HTMLDivElement>(null);
  const atmosphere = useRef<HTMLDivElement>(null);
  const birds = useRef<HTMLDivElement>(null);
  const typographyContainer = useRef<HTMLDivElement>(null);
  const eyebrow = useRef<HTMLSpanElement>(null);
  const headline = useRef<HTMLHeadingElement>(null);
  const subhead = useRef<HTMLParagraphElement>(null);
  const cta = useRef<HTMLAnchorElement>(null);
  const scrollCue = useRef<HTMLDivElement>(null);

  useHeroTimeline(
    {
      section, sky, haramFar, kaabaMid, godRays, vignette, atmosphere, birds,
      typographyContainer, eyebrow, headline, subhead, cta, scrollCue,
    },
    reducedMotion
  );

  return (
    <section
      ref={section}
      aria-label="Perjalanan Anda menuju Tanah Suci dimulai di sini"
      className="relative h-screen w-full overflow-hidden bg-void"
    >
      <HeroParallaxLayer
        ref={sky}
        src={HERO_ASSETS.sky}
        alt=""
        priority
        objectPosition="center 30%"
      />

      <div ref={godRays} className="absolute inset-0">
        <HeroGodRays
          xPercent={HERO_SUN_POSITION.xPercent}
          yPercent={HERO_SUN_POSITION.yPercent}
          animate={!reducedMotion}
        />
      </div>

      <HeroParallaxLayer
        ref={haramFar}
        src={HERO_ASSETS.haramFar}
        alt="Halaman Masjidil Haram saat golden hour"
        priority
      />

      <HeroParallaxLayer
        ref={kaabaMid}
        src={HERO_ASSETS.kaabaMid}
        alt="Ka'bah dan area Mataf dilihat dari atas"
      />

      {/* Golden-hour color grade: unifies three disparate source photos (one shot at
          midday, one aerial in flat white light) into one warm, consistent mood. */}
      <div
        className="pointer-events-none absolute inset-0"
        style={{
          background:
            "linear-gradient(160deg, rgba(210, 130, 40, 0.32) 0%, rgba(232, 180, 90, 0.14) 30%, rgba(120, 40, 15, 0.08) 65%, rgba(74, 20, 10, 0.28) 100%)",
          mixBlendMode: "multiply",
        }}
      />
      <div
        className="pointer-events-none absolute inset-0"
        style={{
          background:
            "radial-gradient(ellipse 70% 60% at 46% 22%, rgba(255, 214, 140, 0.4) 0%, transparent 60%)",
          mixBlendMode: "soft-light",
        }}
      />

      <div ref={atmosphere} className="absolute inset-0">
        <HeroAtmosphere
          count={isMobile ? HERO_TUNING.dustCountMobile : HERO_TUNING.dustCountDesktop}
          reducedMotion={reducedMotion}
        />
      </div>

      <div ref={birds} className="absolute inset-0">
        <HeroBirds count={HERO_TUNING.birdCount} animate={!reducedMotion} />
      </div>

      {/* Vignette: sized so the dark ring actually falls inside the viewport
          (a farthest-corner radial on a wide screen never gets dark enough
          to notice) and dark enough at the bottom to quiet the mundane
          foreground detail in the placeholder photo. */}
      <div
        ref={vignette}
        className="pointer-events-none absolute inset-0"
        style={{
          background:
            "radial-gradient(ellipse 80% 70% at 50% 45%, transparent 30%, rgba(11,9,6,0.55) 80%, rgba(11,9,6,0.85) 100%), linear-gradient(180deg, rgba(11,9,6,0.25) 0%, transparent 22%, transparent 55%, rgba(11,9,6,0.7) 100%)",
        }}
      />

      <HeroTypography
        ref={typographyContainer}
        eyebrowRef={eyebrow}
        headlineRef={headline}
        subheadRef={subhead}
        ctaRef={cta}
        scrollCueRef={scrollCue}
      />
    </section>
  );
}
