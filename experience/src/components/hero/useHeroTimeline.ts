"use client";

import { useEffect, type RefObject } from "react";
import gsap from "gsap";
import { createPinnedTimeline } from "@/lib/scroll/createPinnedTimeline";
import { HERO_TUNING } from "./heroConfig";

export type HeroTimelineRefs = {
  section: RefObject<HTMLElement | null>;
  sky: RefObject<HTMLDivElement | null>;
  haramFar: RefObject<HTMLDivElement | null>;
  kaabaMid: RefObject<HTMLDivElement | null>;
  godRays: RefObject<HTMLDivElement | null>;
  vignette: RefObject<HTMLDivElement | null>;
  atmosphere: RefObject<HTMLDivElement | null>;
  birds: RefObject<HTMLDivElement | null>;
  typographyContainer: RefObject<HTMLDivElement | null>;
  eyebrow: RefObject<HTMLSpanElement | null>;
  headline: RefObject<HTMLHeadingElement | null>;
  subhead: RefObject<HTMLParagraphElement | null>;
  cta: RefObject<HTMLAnchorElement | null>;
  scrollCue: RefObject<HTMLDivElement | null>;
};

// Color grade + blur are combined into single `filter` strings (rather than
// grade-via-Tailwind-class + blur-via-GSAP) because an animated inline
// `filter` style fully replaces whatever `filter` a CSS class set — GSAP
// has to own the whole string so grade and blur can coexist. GSAP tweens
// these as "complex strings": matching function order, only the numbers
// change, so it interpolates each number independently.
const SKY_FILTER = "saturate(1.25) brightness(0.98)";
const HARAM_GRADE = "sepia(0.25) saturate(1.4) brightness(0.9)";
const KAABA_GRADE = "sepia(0.22) saturate(1.35) brightness(0.92)";
const HARAM_SHARP = `${HARAM_GRADE} blur(0px)`;
const HARAM_SOFT = `${HARAM_GRADE} blur(22px)`;
const KAABA_SHARP = `${KAABA_GRADE} blur(0px)`;
const KAABA_SOFT = `${KAABA_GRADE} blur(22px)`;

/**
 * All Hero choreography lives here — HeroTypography/HeroParallaxLayer etc.
 * only render markup and forward refs. Two phases, deliberately separate:
 *
 *  1. An autoplay "arrival" timeline on mount (environment fades in, then
 *     typography reveals) — this happens whether or not the visitor ever
 *     scrolls, because the emotional hook shouldn't be gated behind an
 *     interaction.
 *  2. A scroll-scrubbed "camera moves toward the Kaaba" timeline, pinned
 *     for the section's scroll distance — typography recedes, the
 *     exterior shot dissolves (via a blur-through, not a naive opacity
 *     crossfade — two sharp detailed photos overlapping mid-fade reads as
 *     ghosting) into the Kaaba/Mataf shot, and the vignette tightens.
 *
 * Under reduced motion, phase 2 (the pin + parallax) is skipped entirely
 * and phase 1 becomes a single short cross-fade with no scale/blur/stagger.
 */
export function useHeroTimeline(refs: HeroTimelineRefs, reducedMotion: boolean) {
  useEffect(() => {
    const {
      section, sky, haramFar, kaabaMid, godRays, vignette, atmosphere, birds,
      eyebrow, headline, subhead, cta, scrollCue,
    } = refs;

    if (!section.current) return;

    const headlineWords = headline.current?.querySelectorAll("[data-word]") ?? [];
    const ctx = gsap.context(() => {
      if (reducedMotion) {
        gsap.set(
          [eyebrow.current, headline.current, subhead.current, cta.current, scrollCue.current],
          { clearProps: "all" }
        );
        gsap.set(sky.current, { opacity: 1, scale: 1, filter: SKY_FILTER });
        gsap.set(haramFar.current, { opacity: 1, scale: 1, filter: HARAM_SHARP });
        gsap.set(kaabaMid.current, { opacity: 0 });
        gsap.set(atmosphere.current, { opacity: 0 });
        gsap.set(birds.current, { opacity: 1 });
        gsap.set(godRays.current, { opacity: 0.4 });
        gsap.set(vignette.current, { opacity: 0.55 });
        gsap.from(
          [sky.current, haramFar.current, eyebrow.current, headline.current, subhead.current, cta.current],
          { opacity: 0, duration: 0.5, ease: "power1.out" }
        );
        return;
      }

      // --- Phase 1: arrival (autoplay, not scroll-linked) ---
      gsap.set(sky.current, { opacity: 0, scale: 1.06, filter: SKY_FILTER });
      gsap.set(haramFar.current, { opacity: 0, scale: 1.1, filter: HARAM_SHARP });
      gsap.set(kaabaMid.current, { opacity: 0, scale: 1.3, filter: KAABA_SOFT });
      gsap.set(godRays.current, { opacity: 0 });
      gsap.set(vignette.current, { opacity: 0.5 });
      gsap.set(atmosphere.current, { opacity: 0 });
      gsap.set(birds.current, { opacity: 0 });
      gsap.set([eyebrow.current, subhead.current, cta.current], { opacity: 0, y: 24 });
      gsap.set(headlineWords, { opacity: 0, y: 24, filter: "blur(8px)" });
      gsap.set(scrollCue.current, { opacity: 0 });

      const intro = gsap.timeline({ delay: 0.15 });
      intro
        .to(sky.current, { opacity: 1, scale: 1, duration: 1.4, ease: "power2.out" }, 0)
        .to(haramFar.current, { opacity: 1, scale: 1, duration: 1.4, ease: "power2.out" }, 0.15)
        .to(godRays.current, { opacity: 0.7, duration: 1.2, ease: "power1.out" }, 0.4)
        .to(atmosphere.current, { opacity: 1, duration: 1.2, ease: "power1.out" }, 0.5)
        .to(birds.current, { opacity: 1, duration: 1, ease: "power1.out" }, 0.6)
        .to(eyebrow.current, { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" }, 0.85)
        .to(
          headlineWords,
          { opacity: 1, y: 0, filter: "blur(0px)", duration: 0.7, ease: "power2.out", stagger: 0.07 },
          1.05
        )
        .to(subhead.current, { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" }, 1.65)
        .to(cta.current, { opacity: 1, y: 0, duration: 0.5, ease: "power2.out" }, 1.9)
        .to(scrollCue.current, { opacity: 1, duration: 0.6, ease: "power1.out" }, 2.15);

      // --- Phase 2: scroll-scrubbed camera move into the Mataf ---
      const scrollTl = createPinnedTimeline({
        trigger: section.current!,
        distance: HERO_TUNING.pinDistance,
        scrub: HERO_TUNING.scrub,
      });

      scrollTl
        .fromTo(scrollCue.current, { opacity: 1 }, { opacity: 0, duration: 0.06, ease: "none" }, 0)
        .fromTo(
          [eyebrow.current, headline.current, subhead.current, cta.current],
          { opacity: 1, y: 0, filter: "blur(0px)" },
          { opacity: 0, y: -50, filter: "blur(6px)", duration: 0.22, ease: "power1.in" },
          0
        )
        .fromTo(sky.current, { scale: 1, opacity: 1 }, { scale: 1.12, opacity: 0.5, duration: 1, ease: "none" }, 0)
        // Outgoing exterior shot: fades AND softens together (0 -> 0.55) so
        // it's already indistinct by the time the incoming shot is visible.
        .fromTo(
          haramFar.current,
          { scale: 1, opacity: 1, filter: HARAM_SHARP },
          { scale: 1.2, opacity: 0, filter: HARAM_SOFT, duration: 0.55, ease: "power1.in" },
          0
        )
        // Incoming Kaaba/Mataf shot: starts soft+hidden, only sharpens in
        // the back half (0.45 -> 1) once the exterior has mostly cleared —
        // the two are never both sharp at the same scroll position.
        .fromTo(
          kaabaMid.current,
          { scale: 1.3, opacity: 0, filter: KAABA_SOFT },
          { scale: 1, opacity: 1, filter: KAABA_SHARP, duration: 0.75, ease: "power1.out" },
          0.35
        )
        .fromTo(godRays.current, { opacity: 0.7 }, { opacity: 0.25, duration: 1, ease: "none" }, 0)
        .fromTo(vignette.current, { opacity: 0.5 }, { opacity: 0.8, duration: 1, ease: "none" }, 0)
        .fromTo(
          [atmosphere.current, birds.current],
          { opacity: 1 },
          { opacity: 0.3, duration: 1, ease: "none" },
          0
        );
    }, section.current);

    return () => ctx.revert();
  }, [refs, reducedMotion]);
}
