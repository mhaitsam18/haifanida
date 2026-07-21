import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Experience choreography. Two scopes:
 *  - [data-premium-nav] (site-wide): nav stagger-in, journey-line hover
 *    sweep (CSS), reading-progress thread, glass-over-hero toggle.
 *  - [data-home-experience] (homepage only): chapter reveals, counters,
 *    card tilt, image parallax, and the Golden Thread journey line.
 *
 * Philosophy: markup is fully visible by default — all "hidden" initial
 * states are applied by GSAP at runtime (gsap.from), never by CSS. With JS
 * off or prefers-reduced-motion on, the page reads as a normal static page.
 *
 * Note: on the homepage the Lenis instance is created by cinematic-hero.js;
 * on other pages ScrollTrigger simply listens to native scroll.
 */

/**
 * The Golden Thread: a gold route-line drawn down the page's left gutter as
 * the visitor scrolls, with a waypoint marker at each [data-journey-node].
 * Geometry is computed at runtime (the gutter width and chapter positions
 * depend on viewport and DB content), so the SVG only gets a path when
 * there's a real gutter to live in — otherwise it stays empty/hidden.
 */
function initJourneyThread(reducedMotion) {
    const wrap = document.querySelector('[data-journey-wrap]');
    if (!wrap) return;
    const svg = wrap.querySelector('[data-journey-svg]');
    const path = wrap.querySelector('[data-journey-path]');
    const nodes = [...wrap.querySelectorAll('[data-journey-node]')];
    if (!svg || !path || !nodes.length) return;

    const SVG_NS = 'http://www.w3.org/2000/svg';
    const CONTENT_MAX_WIDTH = 1280; // matches the chapters' max-w-7xl
    let drawTween = null;
    let nodeTriggers = [];
    let circles = [];

    function clear() {
        drawTween?.scrollTrigger?.kill();
        drawTween?.kill();
        drawTween = null;
        nodeTriggers.forEach((t) => t.kill());
        nodeTriggers = [];
        circles.forEach((c) => c.remove());
        circles = [];
        path.removeAttribute('d');
    }

    function build() {
        clear();

        // The thread needs genuine empty gutter beside the centered content;
        // below that width it would cross text, so it simply doesn't render.
        const gutter = (window.innerWidth - CONTENT_MAX_WIDTH) / 2;
        if (gutter < 140) {
            svg.style.display = 'none';
            return;
        }
        svg.style.display = '';

        const wrapRect = wrap.getBoundingClientRect();
        const width = wrap.clientWidth;
        const height = wrap.scrollHeight;
        svg.setAttribute('viewBox', `0 0 ${width} ${height}`);

        const baseX = gutter * 0.5;
        const amp = Math.min(gutter * 0.2, 30);

        // Main points: the thread lives entirely in the left gutter — it
        // enters at the top edge, passes a waypoint per chapter, and runs
        // off the bottom toward the footer. Never routed toward center:
        // any excursion out of the gutter would cross real content.
        const points = [{ x: baseX, y: 0 }];
        nodes.forEach((el, i) => {
            const rect = el.getBoundingClientRect();
            points.push({
                x: baseX + (i % 2 ? amp : -amp * 0.3),
                y: rect.top - wrapRect.top + rect.height / 2,
            });
        });
        points.push({ x: baseX, y: height });

        // Weave: a midpoint between each pair, alternating sides.
        const woven = [points[0]];
        for (let i = 1; i < points.length; i++) {
            woven.push({
                x: baseX + (i % 2 ? -amp : amp),
                y: (points[i - 1].y + points[i].y) / 2,
            });
            woven.push(points[i]);
        }

        let d = `M ${woven[0].x.toFixed(1)},${woven[0].y.toFixed(1)}`;
        for (let i = 1; i < woven.length; i++) {
            const p0 = woven[i - 1];
            const p1 = woven[i];
            const dy = (p1.y - p0.y) / 2;
            d += ` C ${p0.x.toFixed(1)},${(p0.y + dy).toFixed(1)} ${p1.x.toFixed(1)},${(p1.y - dy).toFixed(1)} ${p1.x.toFixed(1)},${p1.y.toFixed(1)}`;
        }
        path.setAttribute('d', d);

        nodes.forEach((_, i) => {
            const circle = document.createElementNS(SVG_NS, 'circle');
            circle.setAttribute('cx', points[i + 1].x);
            circle.setAttribute('cy', points[i + 1].y);
            circle.setAttribute('r', '5');
            circle.setAttribute('fill', 'var(--color-cream-500)');
            circle.setAttribute('stroke', 'var(--color-maroon-700)');
            circle.setAttribute('stroke-width', '2');
            svg.appendChild(circle);
            circles.push(circle);
        });

        const length = path.getTotalLength();
        path.style.strokeDasharray = `${length}`;

        if (reducedMotion) {
            path.style.strokeDashoffset = '0';
            return;
        }

        path.style.strokeDashoffset = `${length}`;
        drawTween = gsap.to(path, {
            strokeDashoffset: 0,
            ease: 'none',
            scrollTrigger: { trigger: wrap, start: 'top 75%', end: 'bottom 90%', scrub: 0.6 },
        });

        circles.forEach((circle, i) => {
            gsap.set(circle, {
                opacity: 0,
                scale: 0,
                svgOrigin: `${points[i + 1].x} ${points[i + 1].y}`,
            });
            nodeTriggers.push(
                ScrollTrigger.create({
                    trigger: nodes[i],
                    start: 'top 75%',
                    once: true,
                    onEnter: () => gsap.to(circle, { opacity: 1, scale: 1, duration: 0.5, ease: 'back.out(2)' }),
                })
            );
        });
    }

    build();

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            build();
            ScrollTrigger.refresh();
        }, 300);
    });

    // Late-loading images change section heights — rebuild once settled.
    if (document.readyState !== 'complete') {
        window.addEventListener('load', () => {
            build();
            ScrollTrigger.refresh();
        }, { once: true });
    }
}
function initHomeExperience() {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // --- Prologue: the navigation frame -----------------------------------
    const header = document.querySelector('[data-premium-nav]');
    if (header) {
        const hero = document.querySelector('[data-cinematic-hero]');
        if (hero) {
            // Paint-only class toggle (background/border) — never geometry.
            ScrollTrigger.create({
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                toggleClass: { targets: header, className: 'nav-on-hero' },
            });
        }

        if (!reducedMotion) {
            const links = header.querySelectorAll('[data-nav-links] > li');
            if (links.length) {
                gsap.from(links, {
                    opacity: 0,
                    y: -10,
                    duration: 0.5,
                    ease: 'power2.out',
                    stagger: 0.06,
                    delay: 0.2,
                    clearProps: 'all',
                });
            }

            const progress = header.querySelector('[data-nav-progress]');
            if (progress) {
                gsap.fromTo(
                    progress,
                    { scaleX: 0 },
                    { scaleX: 1, ease: 'none', scrollTrigger: { start: 0, end: 'max', scrub: 0.3 } }
                );
            }
        }
    }

    if (!document.querySelector('[data-home-experience]')) return;

    // The thread renders (fully drawn) even under reduced motion — it's
    // wayfinding, not just decoration.
    initJourneyThread(reducedMotion);

    if (reducedMotion) return; // everything below is decorative motion

    // --- Chapter reveals ---------------------------------------------------
    document.querySelectorAll('[data-reveal]').forEach((el) => {
        gsap.from(el, {
            opacity: 0,
            y: 28,
            duration: 0.8,
            delay: parseFloat(el.dataset.revealDelay || '0'),
            ease: 'power2.out',
            clearProps: 'all',
            scrollTrigger: { trigger: el, start: 'top 85%', once: true },
        });
    });

    // Gateway cards unfold upward with a hint of perspective, staggered via
    // each card's data-unfold delay, all triggered by the shared grid.
    document.querySelectorAll('[data-unfold]').forEach((el) => {
        gsap.from(el, {
            opacity: 0,
            y: 48,
            rotateX: 8,
            transformPerspective: 900,
            transformOrigin: 'center bottom',
            duration: 0.9,
            delay: parseFloat(el.dataset.unfold || '0'),
            ease: 'power3.out',
            clearProps: 'all',
            scrollTrigger: { trigger: el.parentElement, start: 'top 80%', once: true },
        });
    });

    // The "2007 Berdiri" seal settles into place.
    document.querySelectorAll('[data-seal]').forEach((el) => {
        gsap.from(el, {
            opacity: 0,
            scale: 0.5,
            rotate: -12,
            duration: 0.7,
            ease: 'back.out(1.7)',
            clearProps: 'all',
            scrollTrigger: { trigger: el, start: 'top 90%', once: true },
        });
    });

    // The bridge badge dissolves just before it would slide beneath the
    // translucent nav (a bright card showing through the backdrop blur
    // reads as a glitch). Scrubbed so reversing scroll brings it back.
    document.querySelectorAll('[data-bridge-badge]').forEach((el) => {
        gsap.to(el, {
            opacity: 0,
            y: -12,
            ease: 'none',
            scrollTrigger: { trigger: el, start: 'top 130', end: 'top 78', scrub: true },
        });
    });

    // --- Counters (experience years) --------------------------------------
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = parseInt(el.dataset.counter, 10);
        if (Number.isNaN(target)) return;
        ScrollTrigger.create({
            trigger: el,
            start: 'top 88%',
            once: true,
            onEnter: () => {
                const state = { value: 0 };
                gsap.to(state, {
                    value: target,
                    duration: 1.6,
                    ease: 'power2.out',
                    onUpdate: () => { el.textContent = Math.round(state.value); },
                });
            },
        });
    });

    // --- Sejarah photo drifts inside its overflow-hidden frame -------------
    document.querySelectorAll('[data-parallax-img]').forEach((img) => {
        gsap.fromTo(
            img,
            { yPercent: -5 },
            {
                yPercent: 5,
                ease: 'none',
                scrollTrigger: { trigger: img.parentElement, start: 'top bottom', end: 'bottom top', scrub: 0.5 },
            }
        );
    });

    // --- 3D tilt toward the cursor (fine pointers only) --------------------
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        document.querySelectorAll('[data-tilt]').forEach((card) => {
            gsap.set(card, { transformPerspective: 900 });
            const toRotX = gsap.quickTo(card, 'rotationX', { duration: 0.4, ease: 'power2.out' });
            const toRotY = gsap.quickTo(card, 'rotationY', { duration: 0.4, ease: 'power2.out' });

            card.addEventListener('pointermove', (event) => {
                const rect = card.getBoundingClientRect();
                const px = (event.clientX - rect.left) / rect.width - 0.5;
                const py = (event.clientY - rect.top) / rect.height - 0.5;
                toRotX(py * -5);
                toRotY(px * 6);
            });
            card.addEventListener('pointerleave', () => {
                toRotX(0);
                toRotY(0);
            });
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeExperience);
} else {
    initHomeExperience();
}
