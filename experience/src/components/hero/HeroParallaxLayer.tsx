import Image from "next/image";
import { forwardRef } from "react";

type HeroParallaxLayerProps = {
  src: string;
  alt: string;
  priority?: boolean;
  /** Extra classes for color grading / blend modes layered on top of the raw photo. */
  className?: string;
  objectPosition?: string;
};

/**
 * One photographic depth layer of the parallax stack. GSAP animates the
 * forwarded wrapper's transform/opacity — never the <img> itself — so
 * next/image keeps full control of its own loading/layout behavior.
 */
const HeroParallaxLayer = forwardRef<HTMLDivElement, HeroParallaxLayerProps>(
  function HeroParallaxLayer(
    { src, alt, priority, className, objectPosition = "center" },
    ref
  ) {
    return (
      <div
        ref={ref}
        className={`absolute inset-0 h-full w-full ${className ?? ""}`}
        style={{ willChange: "transform, opacity" }}
      >
        <Image
          src={src}
          alt={alt}
          fill
          priority={priority}
          sizes="100vw"
          quality={80}
          style={{ objectFit: "cover", objectPosition }}
        />
      </div>
    );
  }
);

export default HeroParallaxLayer;
