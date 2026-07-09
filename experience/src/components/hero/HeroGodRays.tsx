"use client";

type HeroGodRaysProps = {
  xPercent: number;
  yPercent: number;
  animate?: boolean;
};

/**
 * Volumetric light beams as a pure CSS conic-gradient, screen-blended onto
 * the scene — no canvas/WebGL needed for a static-ish light source. Reused
 * by any future scene that has a visible sun/light source by passing a
 * different anchor position.
 *
 * The positioning transform (anchor to xPercent/yPercent) and the rotation
 * animation live on separate elements — a CSS animation on `transform`
 * fully replaces any inline `transform`, so they can't share one element.
 */
export default function HeroGodRays({ xPercent, yPercent, animate = true }: HeroGodRaysProps) {
  return (
    <div className="pointer-events-none absolute inset-0" style={{ mixBlendMode: "screen" }}>
      <div
        style={{
          position: "absolute",
          left: `${xPercent}%`,
          top: `${yPercent}%`,
          width: "140vmax",
          height: "140vmax",
          transform: "translate(-50%, -50%)",
        }}
      >
        <div
          className={animate ? "hero-godrays-spin" : undefined}
          style={{
            width: "100%",
            height: "100%",
            background: `conic-gradient(from 0deg,
              transparent 0deg,
              rgba(255, 226, 160, 0.5) 5deg,
              transparent 15deg,
              transparent 40deg,
              rgba(255, 226, 160, 0.38) 47deg,
              transparent 57deg,
              transparent 96deg,
              rgba(232, 200, 119, 0.45) 103deg,
              transparent 113deg,
              transparent 180deg,
              rgba(255, 226, 160, 0.32) 189deg,
              transparent 199deg,
              transparent 360deg)`,
          }}
        />
      </div>
      <div
        style={{
          position: "absolute",
          left: `${xPercent}%`,
          top: `${yPercent}%`,
          width: "50vmax",
          height: "50vmax",
          transform: "translate(-50%, -50%)",
          borderRadius: "50%",
          background:
            "radial-gradient(circle, rgba(255,250,235,0.85) 0%, rgba(255,244,214,0.6) 18%, rgba(232,200,119,0.4) 40%, rgba(232,200,119,0) 72%)",
        }}
      />
      <div
        style={{
          position: "absolute",
          left: `${xPercent}%`,
          top: `${yPercent}%`,
          width: "6vmax",
          height: "6vmax",
          transform: "translate(-50%, -50%)",
          borderRadius: "50%",
          background: "radial-gradient(circle, rgba(255,255,250,0.95) 0%, rgba(255,255,250,0) 100%)",
        }}
      />
    </div>
  );
}
