import type { CSSProperties } from "react";

type HeroBirdsProps = {
  count?: number;
  animate?: boolean;
};

type BirdStyle = CSSProperties & { "--bird-drift": string; "--bird-scale": number };

/**
 * A handful of small birds drifting across the sky on independent CSS
 * motion paths. Per-bird variety comes from deterministic index-based
 * math (not Math.random()) so server and client render identically and
 * hydration never mismatches.
 */
export default function HeroBirds({ count = 4, animate = true }: HeroBirdsProps) {
  const birds = Array.from({ length: count }, (_, i) => {
    const startX = 8 + ((i * 21) % 70);
    const startY = 14 + ((i * 13) % 30);
    const drift = 26 + (i % 3) * 10;
    const duration = 22 + i * 6;
    const delay = -(i * 5.5);
    const scale = 0.6 + (i % 3) * 0.18;

    return { id: i, startX, startY, drift, duration, delay, scale };
  });

  return (
    <div className="pointer-events-none absolute inset-0 overflow-hidden">
      {birds.map((bird) => (
        <div
          key={bird.id}
          className={animate ? "hero-bird-fly" : undefined}
          style={{
            position: "absolute",
            left: `${bird.startX}%`,
            top: `${bird.startY}%`,
            transform: `scale(${bird.scale})`,
            animationDuration: `${bird.duration}s`,
            animationDelay: `${bird.delay}s`,
            "--bird-drift": `${bird.drift}vw`,
            "--bird-scale": bird.scale,
          } as BirdStyle}
        >
          <svg
            width="28"
            height="14"
            viewBox="0 0 28 14"
            className={animate ? "hero-bird-flap" : undefined}
            style={{ opacity: 0.55 }}
          >
            <path
              d="M0 7 C 6 0, 11 2, 14 7 C 17 2, 22 0, 28 7"
              stroke="#f7f2e7"
              strokeWidth="1.6"
              fill="none"
              strokeLinecap="round"
            />
          </svg>
        </div>
      ))}
    </div>
  );
}
