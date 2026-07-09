"use client";

import { ReactNode, useEffect, useRef } from "react";
import { ReactLenis, useLenis, type LenisRef } from "lenis/react";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { usePrefersReducedMotion } from "@/hooks/usePrefersReducedMotion";

gsap.registerPlugin(ScrollTrigger);

/**
 * Renders inside the Lenis context (as a child of <ReactLenis>) so every
 * Lenis scroll tick nudges ScrollTrigger to recompute pinned/scrubbed
 * animations. Without this, GSAP listens to native scroll events, which
 * Lenis intercepts, and every ScrollTrigger in the app silently desyncs.
 */
function ScrollTriggerSync() {
  useLenis(() => {
    ScrollTrigger.update();
  });
  return null;
}

export default function SmoothScroll({ children }: { children: ReactNode }) {
  const lenisRef = useRef<LenisRef | null>(null);
  const reducedMotion = usePrefersReducedMotion();

  useEffect(() => {
    if (reducedMotion) return;

    function syncRaf(time: number) {
      // gsap.ticker time is in seconds, Lenis expects milliseconds.
      lenisRef.current?.lenis?.raf(time * 1000);
    }

    gsap.ticker.add(syncRaf);
    gsap.ticker.lagSmoothing(0);

    return () => gsap.ticker.remove(syncRaf);
  }, [reducedMotion]);

  // Motion-sensitive visitors get plain native scrolling — no inertia
  // layer, no scroll-jacking risk — instead of a "gentler" smooth scroll.
  if (reducedMotion) {
    return <>{children}</>;
  }

  return (
    <ReactLenis
      root
      ref={lenisRef}
      options={{
        autoRaf: false,
        lerp: 0.1,
        duration: 1.3,
        wheelMultiplier: 1,
        smoothWheel: true,
      }}
    >
      {children}
      <ScrollTriggerSync />
    </ReactLenis>
  );
}
