import { forwardRef } from "react";
import { splitWords } from "@/lib/text/splitWords";
import { HERO_COPY } from "./heroConfig";

export type HeroTypographyRefs = {
  eyebrowRef: React.Ref<HTMLSpanElement>;
  headlineRef: React.Ref<HTMLHeadingElement>;
  subheadRef: React.Ref<HTMLParagraphElement>;
  ctaRef: React.Ref<HTMLAnchorElement>;
  scrollCueRef: React.Ref<HTMLDivElement>;
};

/**
 * Pure markup — every animated property (opacity/transform/filter on the
 * refs below) is driven by useHeroTimeline, not by this component. Keeps
 * copy/markup changes and choreography changes independent of each other.
 */
const HeroTypography = forwardRef<HTMLDivElement, HeroTypographyRefs>(function HeroTypography(
  { eyebrowRef, headlineRef, subheadRef, ctaRef, scrollCueRef },
  containerRef
) {
  return (
    <div
      ref={containerRef}
      className="relative z-20 flex h-full flex-col items-center justify-end gap-5 px-6 pb-24 text-center sm:pb-28"
    >
      {/* Legibility scrim — a lower-third band, independent of the global
          vignette, sized specifically to guarantee text contrast regardless
          of what's busy/bright in the underlying photo at this position. */}
      <div
        className="pointer-events-none absolute inset-x-0 bottom-0 h-[70%]"
        style={{
          background:
            "linear-gradient(to top, rgba(8,6,4,0.85) 0%, rgba(8,6,4,0.6) 30%, rgba(8,6,4,0.22) 65%, transparent 100%)",
        }}
      />

      <span
        ref={eyebrowRef}
        className="font-sans text-xs uppercase tracking-[0.4em] text-gold-bright/90 drop-shadow-[0_1px_6px_rgba(0,0,0,0.6)]"
      >
        {HERO_COPY.eyebrow}
      </span>

      {/*
        The gradient+clip lives on each word span, not this <h1> — Chromium
        fails to keep a parent's `background-clip: text` visible once its
        child spans get individually layer-promoted by GSAP's filter/
        transform animation, silently rendering the text fully invisible.
        Each span owning its own clip avoids the cross-element compositing
        entirely.
      */}
      <h1
        ref={headlineRef}
        className="font-display max-w-3xl text-4xl italic leading-tight sm:text-6xl md:text-7xl"
      >
        {splitWords(HERO_COPY.headline, "text-gradient-gold drop-shadow-[0_4px_14px_rgba(0,0,0,0.6)]")}
      </h1>

      <p
        ref={subheadRef}
        className="max-w-xl font-sans text-sm text-cream/90 drop-shadow-[0_2px_8px_rgba(0,0,0,0.6)] sm:text-base"
      >
        {HERO_COPY.subhead}
      </p>

      <a
        ref={ctaRef}
        href="#introduction"
        className="glass-panel mt-2 rounded-full px-8 py-3 font-sans text-sm uppercase tracking-[0.2em] text-ivory transition-colors hover:border-gold-bright/60 hover:text-gold-bright"
      >
        {HERO_COPY.cta}
      </a>

      <div
        ref={scrollCueRef}
        className="absolute bottom-10 left-1/2 flex -translate-x-1/2 flex-col items-center gap-2 text-cream/70"
      >
        <span className="font-sans text-[10px] uppercase tracking-[0.3em]">Scroll</span>
        <span className="hero-scrollcue-bob block h-8 w-px bg-gradient-to-b from-cream/70 to-transparent" />
      </div>
    </div>
  );
});

export default HeroTypography;
