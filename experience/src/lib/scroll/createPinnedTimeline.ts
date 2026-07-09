import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export type PinnedTimelineOptions = {
  trigger: Element;
  /** Scroll distance the pin lasts for, as a viewport-height multiple or a GSAP end string (e.g. "+=250%"). */
  distance?: string;
  scrub?: number | boolean;
  onLeave?: () => void;
  onEnterBack?: () => void;
};

/**
 * Every cinematic scene in this app (Hero today, Nabawi/etc. later) needs
 * the same shape: pin a section, scrub a GSAP timeline against scroll
 * progress across it. Centralizing that wiring here means each scene file
 * only supplies the actual `.fromTo`/`.to` choreography, not the
 * ScrollTrigger boilerplate.
 */
export function createPinnedTimeline({
  trigger,
  distance = "+=200%",
  scrub = 1,
  onLeave,
  onEnterBack,
}: PinnedTimelineOptions): gsap.core.Timeline {
  return gsap.timeline({
    scrollTrigger: {
      trigger,
      start: "top top",
      end: distance,
      scrub,
      pin: true,
      anticipatePin: 1,
      onLeave,
      onEnterBack,
    },
  });
}
