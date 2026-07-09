"use client";

import { useEffect, useRef } from "react";

type Particle = {
  x: number;
  y: number;
  radius: number;
  speed: number;
  swayAmplitude: number;
  swayFrequency: number;
  phase: number;
  opacity: number;
};

type HeroAtmosphereProps = {
  count?: number;
  reducedMotion?: boolean;
  /** RGB triplet used for the particle glow, e.g. "232, 200, 119" (gold). */
  tintRgb?: string;
};

/**
 * Floating dust/light-particle canvas. Purely decorative motion, so under
 * prefers-reduced-motion it renders nothing at all rather than a static
 * frame — there's no information here worth keeping.
 */
export default function HeroAtmosphere({
  count = 40,
  reducedMotion = false,
  tintRgb = "232, 200, 119",
}: HeroAtmosphereProps) {
  const canvasRef = useRef<HTMLCanvasElement>(null);

  useEffect(() => {
    if (reducedMotion) return;

    const canvas = canvasRef.current;
    if (!canvas) return;
    const ctx = canvas.getContext("2d");
    if (!ctx) return;

    let width = 0;
    let height = 0;
    const dpr = Math.min(window.devicePixelRatio || 1, 1.5);

    const particles: Particle[] = Array.from({ length: count }, () => makeParticle());

    function makeParticle(): Particle {
      return {
        x: Math.random() * width,
        y: Math.random() * height,
        radius: 1.4 + Math.random() * 3,
        speed: 6 + Math.random() * 14,
        swayAmplitude: 10 + Math.random() * 24,
        swayFrequency: 0.2 + Math.random() * 0.4,
        phase: Math.random() * Math.PI * 2,
        opacity: 0.35 + Math.random() * 0.45,
      };
    }

    function resize() {
      width = canvas!.clientWidth;
      height = canvas!.clientHeight;
      canvas!.width = width * dpr;
      canvas!.height = height * dpr;
      ctx!.scale(dpr, dpr);
    }

    resize();
    window.addEventListener("resize", resize);

    let rafId = 0;
    let lastTime = performance.now();

    function tick(time: number) {
      const dt = Math.min((time - lastTime) / 1000, 0.05);
      lastTime = time;

      ctx!.clearRect(0, 0, width, height);

      for (const particle of particles) {
        particle.y -= particle.speed * dt;
        if (particle.y < -10) {
          particle.y = height + 10;
          particle.x = Math.random() * width;
        }

        const sway = Math.sin(time / 1000 * particle.swayFrequency + particle.phase) * particle.swayAmplitude * dt;
        particle.x += sway;

        const gradient = ctx!.createRadialGradient(
          particle.x,
          particle.y,
          0,
          particle.x,
          particle.y,
          particle.radius * 4
        );
        gradient.addColorStop(0, `rgba(255, 250, 235, ${particle.opacity})`);
        gradient.addColorStop(0.4, `rgba(${tintRgb}, ${particle.opacity * 0.7})`);
        gradient.addColorStop(1, `rgba(${tintRgb}, 0)`);

        ctx!.fillStyle = gradient;
        ctx!.beginPath();
        ctx!.arc(particle.x, particle.y, particle.radius * 4, 0, Math.PI * 2);
        ctx!.fill();
      }

      rafId = requestAnimationFrame(tick);
    }

    function handleVisibility() {
      if (document.hidden) {
        cancelAnimationFrame(rafId);
      } else {
        lastTime = performance.now();
        rafId = requestAnimationFrame(tick);
      }
    }

    rafId = requestAnimationFrame(tick);
    document.addEventListener("visibilitychange", handleVisibility);

    return () => {
      cancelAnimationFrame(rafId);
      window.removeEventListener("resize", resize);
      document.removeEventListener("visibilitychange", handleVisibility);
    };
  }, [count, reducedMotion, tintRgb]);

  if (reducedMotion) return null;

  return (
    <canvas
      ref={canvasRef}
      className="pointer-events-none absolute inset-0 h-full w-full"
      style={{ mixBlendMode: "screen" }}
    />
  );
}
