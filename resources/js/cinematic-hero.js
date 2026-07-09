import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

// Color grade + blur combined into single `filter` strings — an animated
// inline `filter` fully replaces whatever a CSS class set, so GSAP has to
// own the whole string for grade and blur to coexist. GSAP tweens these as
// "complex strings": matching function order, only the numbers change.
const SKY_FILTER = 'saturate(1.25) brightness(0.98)';
const HARAM_GRADE = 'sepia(0.25) saturate(1.4) brightness(0.9)';
const KAABA_GRADE = 'sepia(0.22) saturate(1.35) brightness(0.92)';
const HARAM_SHARP = `${HARAM_GRADE} blur(0px)`;
const HARAM_SOFT = `${HARAM_GRADE} blur(22px)`;
const KAABA_SHARP = `${KAABA_GRADE} blur(0px)`;
const KAABA_SOFT = `${KAABA_GRADE} blur(22px)`;

/** Floating dust/light-particle canvas. Ported 1:1 from the validated React prototype's imperative logic. */
class DustAtmosphere {
    constructor(canvas, { count = 40, tintRgb = '232, 200, 119' } = {}) {
        this.canvas = canvas;
        this.count = count;
        this.tintRgb = tintRgb;
        this.ctx = canvas.getContext('2d');
        this.particles = [];
        this.rafId = 0;
        this.width = 0;
        this.height = 0;
        this.dpr = Math.min(window.devicePixelRatio || 1, 1.5);

        this.resize = this.resize.bind(this);
        this.tick = this.tick.bind(this);
        this.handleVisibility = this.handleVisibility.bind(this);
    }

    makeParticle() {
        return {
            x: Math.random() * this.width,
            y: Math.random() * this.height,
            radius: 1.4 + Math.random() * 3,
            speed: 6 + Math.random() * 14,
            swayAmplitude: 10 + Math.random() * 24,
            swayFrequency: 0.2 + Math.random() * 0.4,
            phase: Math.random() * Math.PI * 2,
            opacity: 0.35 + Math.random() * 0.45,
        };
    }

    resize() {
        this.width = this.canvas.clientWidth;
        this.height = this.canvas.clientHeight;
        this.canvas.width = this.width * this.dpr;
        this.canvas.height = this.height * this.dpr;
        this.ctx.scale(this.dpr, this.dpr);
    }

    tick(time) {
        const dt = Math.min((time - (this.lastTime ?? time)) / 1000, 0.05);
        this.lastTime = time;

        this.ctx.clearRect(0, 0, this.width, this.height);

        for (const particle of this.particles) {
            particle.y -= particle.speed * dt;
            if (particle.y < -10) {
                particle.y = this.height + 10;
                particle.x = Math.random() * this.width;
            }

            const sway = Math.sin((time / 1000) * particle.swayFrequency + particle.phase) * particle.swayAmplitude * dt;
            particle.x += sway;

            const gradient = this.ctx.createRadialGradient(particle.x, particle.y, 0, particle.x, particle.y, particle.radius * 4);
            gradient.addColorStop(0, `rgba(255, 250, 235, ${particle.opacity})`);
            gradient.addColorStop(0.4, `rgba(${this.tintRgb}, ${particle.opacity * 0.7})`);
            gradient.addColorStop(1, `rgba(${this.tintRgb}, 0)`);

            this.ctx.fillStyle = gradient;
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.radius * 4, 0, Math.PI * 2);
            this.ctx.fill();
        }

        this.rafId = requestAnimationFrame(this.tick);
    }

    handleVisibility() {
        if (document.hidden) {
            cancelAnimationFrame(this.rafId);
        } else {
            this.lastTime = performance.now();
            this.rafId = requestAnimationFrame(this.tick);
        }
    }

    start() {
        this.resize();
        this.particles = Array.from({ length: this.count }, () => this.makeParticle());
        window.addEventListener('resize', this.resize);
        document.addEventListener('visibilitychange', this.handleVisibility);
        this.lastTime = performance.now();
        this.rafId = requestAnimationFrame(this.tick);
    }

    stop() {
        cancelAnimationFrame(this.rafId);
        window.removeEventListener('resize', this.resize);
        document.removeEventListener('visibilitychange', this.handleVisibility);
    }
}

function initCinematicHero() {
    const section = document.querySelector('[data-cinematic-hero]');
    if (!section) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const lenis = new Lenis({
        autoRaf: false,
        lerp: 0.1,
        duration: 1.3,
        wheelMultiplier: 1,
        smoothWheel: !reducedMotion,
    });
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
    lenis.on('scroll', ScrollTrigger.update);

    const sky = section.querySelector('[data-hero-layer="sky"]');
    const godRays = section.querySelector('[data-hero-layer="godrays"]');
    const haram = section.querySelector('[data-hero-layer="haram"]');
    const kaaba = section.querySelector('[data-hero-layer="kaaba"]');
    const atmosphereEl = section.querySelector('[data-hero-layer="atmosphere"]');
    const canvas = atmosphereEl ? atmosphereEl.querySelector('[data-hero-canvas]') : null;
    const birds = section.querySelector('[data-hero-layer="birds"]');
    const vignette = section.querySelector('[data-hero-layer="vignette"]');
    const eyebrow = section.querySelector('[data-hero-eyebrow]');
    const headline = section.querySelector('[data-hero-headline]');
    const headlineWords = headline ? headline.querySelectorAll('[data-word]') : [];
    const subhead = section.querySelector('[data-hero-subhead]');
    const cta = section.querySelector('[data-hero-cta]');
    const scrollCue = section.querySelector('[data-hero-scrollcue]');

    let dust = null;
    if (canvas && !reducedMotion) {
        dust = new DustAtmosphere(canvas, {
            count: window.innerWidth < 768 ? 18 : 46,
            tintRgb: '232, 200, 119',
        });
    }

    gsap.context(() => {
        if (reducedMotion) {
            gsap.set([eyebrow, headline, subhead, cta, scrollCue], { clearProps: 'all' });
            gsap.set(sky, { opacity: 1, scale: 1, filter: SKY_FILTER });
            gsap.set(haram, { opacity: 1, scale: 1, filter: HARAM_SHARP });
            gsap.set(kaaba, { opacity: 0 });
            gsap.set(birds, { opacity: 1 });
            gsap.set(godRays, { opacity: 0.4 });
            gsap.set(vignette, { opacity: 0.55 });
            gsap.from([sky, haram, eyebrow, headline, subhead, cta], {
                opacity: 0,
                duration: 0.5,
                ease: 'power1.out',
            });
            return;
        }

        // --- Phase 1: arrival (autoplay, not scroll-linked) ---
        gsap.set(sky, { opacity: 0, scale: 1.06, filter: SKY_FILTER });
        gsap.set(haram, { opacity: 0, scale: 1.1, filter: HARAM_SHARP });
        gsap.set(kaaba, { opacity: 0, scale: 1.3, filter: KAABA_SOFT });
        gsap.set(godRays, { opacity: 0 });
        gsap.set(vignette, { opacity: 0.5 });
        gsap.set(birds, { opacity: 0 });
        gsap.set([eyebrow, subhead, cta], { opacity: 0, y: 24 });
        gsap.set(headlineWords, { opacity: 0, y: 24, filter: 'blur(8px)' });
        gsap.set(scrollCue, { opacity: 0 });

        const intro = gsap.timeline({ delay: 0.15 });
        intro
            .to(sky, { opacity: 1, scale: 1, duration: 1.4, ease: 'power2.out' }, 0)
            .to(haram, { opacity: 1, scale: 1, duration: 1.4, ease: 'power2.out' }, 0.15)
            .to(godRays, { opacity: 0.7, duration: 1.2, ease: 'power1.out' }, 0.4)
            .to(birds, { opacity: 1, duration: 1, ease: 'power1.out' }, 0.6)
            .to(eyebrow, { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }, 0.85)
            .to(headlineWords, { opacity: 1, y: 0, filter: 'blur(0px)', duration: 0.7, ease: 'power2.out', stagger: 0.07 }, 1.05)
            .to(subhead, { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }, 1.65)
            .to(cta, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }, 1.9)
            .to(scrollCue, { opacity: 1, duration: 0.6, ease: 'power1.out' }, 2.15);

        if (dust) {
            intro.call(() => dust.start(), null, 0.5);
        }

        // --- Phase 2: scroll-scrubbed camera move into the Mataf ---
        const scrollTl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: '+=260%',
                scrub: 1,
                pin: true,
                anticipatePin: 1,
            },
        });

        scrollTl
            .fromTo(scrollCue, { opacity: 1 }, { opacity: 0, duration: 0.06, ease: 'none' }, 0)
            .fromTo(
                [eyebrow, headline, subhead, cta],
                { opacity: 1, y: 0, filter: 'blur(0px)' },
                { opacity: 0, y: -50, filter: 'blur(6px)', duration: 0.22, ease: 'power1.in' },
                0
            )
            .fromTo(sky, { scale: 1, opacity: 1 }, { scale: 1.12, opacity: 0.5, duration: 1, ease: 'none' }, 0)
            .fromTo(
                haram,
                { scale: 1, opacity: 1, filter: HARAM_SHARP },
                { scale: 1.2, opacity: 0, filter: HARAM_SOFT, duration: 0.55, ease: 'power1.in' },
                0
            )
            .fromTo(
                kaaba,
                { scale: 1.3, opacity: 0, filter: KAABA_SOFT },
                { scale: 1, opacity: 1, filter: KAABA_SHARP, duration: 0.75, ease: 'power1.out' },
                0.35
            )
            .fromTo(godRays, { opacity: 0.7 }, { opacity: 0.25, duration: 1, ease: 'none' }, 0)
            .fromTo(vignette, { opacity: 0.5 }, { opacity: 0.8, duration: 1, ease: 'none' }, 0)
            .fromTo(
                [atmosphereEl, birds],
                { opacity: 1 },
                { opacity: 0.3, duration: 1, ease: 'none' },
                0
            );
    }, section);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCinematicHero);
} else {
    initCinematicHero();
}
