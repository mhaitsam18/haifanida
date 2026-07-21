@extends('layouts.app')

@section('content')
    @php
        $experienceYears = now()->year - 2007;
        $heroHeadline = "Setiap langkah adalah awal dari perjalanan suci.";
        $heroWords = explode(' ', $heroHeadline);
    @endphp

    {{--
        Cinematic hero — a fixed Masjidil Haram -> Ka'bah sequence rather than
        the old 3-slide Konten carousel (beranda1-3's isi_konten is company
        registration/license text, not marketing copy, so it doesn't fit as a
        hero tagline). beranda1-3 remain fully intact and editable in the
        admin panel; they're just no longer sourced into this hero.

        Choreography lives in resources/js/cinematic-hero.js, gated entirely
        behind the [data-cinematic-hero] marker below — it does nothing on
        any other page. Imagery paths are fixed filenames under
        public/assets/img/hero/ — swap those three files for real photography
        later without touching this markup.
    --}}
    <section data-cinematic-hero class="relative h-screen w-full overflow-hidden bg-maroon-950">
        <div data-hero-layer="sky" class="absolute inset-0">
            <img src="{{ asset('assets/img/hero/sky.jpg') }}" alt="" class="h-full w-full object-cover"
                style="object-position: center 30%" fetchpriority="high">
        </div>

        {{-- Volumetric light (god rays), anchored near the sun position in sky.jpg --}}
        <div data-hero-layer="godrays" class="pointer-events-none absolute inset-0" style="mix-blend-mode: screen">
            <div style="position:absolute; left:46%; top:18%; width:140vmax; height:140vmax; transform:translate(-50%,-50%)">
                <div class="hero-godrays-spin" style="width:100%; height:100%; background: conic-gradient(from 0deg,
                    transparent 0deg, rgba(255,226,160,0.5) 5deg, transparent 15deg, transparent 40deg,
                    rgba(255,226,160,0.38) 47deg, transparent 57deg, transparent 96deg,
                    rgba(232,200,119,0.45) 103deg, transparent 113deg, transparent 180deg,
                    rgba(255,226,160,0.32) 189deg, transparent 199deg, transparent 360deg)"></div>
            </div>
            <div style="position:absolute; left:46%; top:18%; width:50vmax; height:50vmax; transform:translate(-50%,-50%); border-radius:50%;
                background: radial-gradient(circle, rgba(255,250,235,0.85) 0%, rgba(255,244,214,0.6) 18%, rgba(232,200,119,0.4) 40%, rgba(232,200,119,0) 72%)"></div>
            <div style="position:absolute; left:46%; top:18%; width:6vmax; height:6vmax; transform:translate(-50%,-50%); border-radius:50%;
                background: radial-gradient(circle, rgba(255,255,250,0.95) 0%, rgba(255,255,250,0) 100%)"></div>
        </div>

        <div data-hero-layer="haram" class="absolute inset-0">
            <img src="{{ asset('assets/img/hero/haram-far.jpg') }}" alt="Halaman Masjidil Haram saat golden hour"
                class="h-full w-full object-cover" fetchpriority="high">
        </div>

        {{-- Golden-hour color grade: unifies the placeholder photos (shot in flat daylight) into one warm mood --}}
        <div class="pointer-events-none absolute inset-0" style="mix-blend-mode: multiply; background: linear-gradient(160deg,
            rgba(210,130,40,0.32) 0%, rgba(232,180,90,0.14) 30%, rgba(120,40,15,0.08) 65%, rgba(46,0,11,0.35) 100%)"></div>
        <div class="pointer-events-none absolute inset-0" style="mix-blend-mode: soft-light;
            background: radial-gradient(ellipse 70% 60% at 46% 22%, rgba(255,214,140,0.4) 0%, transparent 60%)"></div>

        <div data-hero-layer="kaaba" class="absolute inset-0">
            <img src="{{ asset('assets/img/hero/kaaba-mid.jpg') }}" alt="Ka'bah dan area Mataf dilihat dari atas"
                class="h-full w-full object-cover">
        </div>

        <div data-hero-layer="atmosphere" class="absolute inset-0">
            <canvas data-hero-canvas class="pointer-events-none absolute inset-0 h-full w-full" style="mix-blend-mode: screen"></canvas>
        </div>

        <div data-hero-layer="birds" class="pointer-events-none absolute inset-0 overflow-hidden">
            @for ($i = 0; $i < 4; $i++)
                @php
                    $birdStartX = 8 + ($i * 21) % 70;
                    $birdStartY = 14 + ($i * 13) % 30;
                    $birdDrift = 26 + ($i % 3) * 10;
                    $birdDuration = 22 + $i * 6;
                    $birdDelay = -($i * 5.5);
                    $birdScale = 0.6 + ($i % 3) * 0.18;
                @endphp
                <div class="hero-bird-fly"
                    style="position:absolute; left:{{ $birdStartX }}%; top:{{ $birdStartY }}%; transform: scale({{ $birdScale }});
                        animation-duration: {{ $birdDuration }}s; animation-delay: {{ $birdDelay }}s;
                        --bird-drift: {{ $birdDrift }}vw; --bird-scale: {{ $birdScale }}">
                    <svg width="28" height="14" viewBox="0 0 28 14" class="hero-bird-flap" style="opacity:0.55">
                        <path d="M0 7 C 6 0, 11 2, 14 7 C 17 2, 22 0, 28 7" stroke="#f7f2e7" stroke-width="1.6" fill="none" stroke-linecap="round" />
                    </svg>
                </div>
            @endfor
        </div>

        {{-- Vignette: darkens edges + bottom, also quiets the mundane foreground detail in the placeholder photo --}}
        <div data-hero-layer="vignette" class="pointer-events-none absolute inset-0" style="background:
            radial-gradient(ellipse 80% 70% at 50% 45%, transparent 30%, rgba(46,0,11,0.55) 80%, rgba(46,0,11,0.85) 100%),
            linear-gradient(180deg, rgba(46,0,11,0.25) 0%, transparent 22%, transparent 55%, rgba(46,0,11,0.7) 100%)"></div>

        <div class="relative z-20 flex h-full flex-col items-center justify-end gap-5 px-6 pb-24 text-center sm:pb-28">
            {{-- Legibility scrim: guarantees text contrast regardless of what's busy/bright in the photo at this position --}}
            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-[70%]" style="background: linear-gradient(to top,
                rgba(8,6,4,0.85) 0%, rgba(8,6,4,0.6) 30%, rgba(8,6,4,0.22) 65%, transparent 100%)"></div>

            <span data-hero-eyebrow class="inline-flex items-center gap-2 font-sans text-xs uppercase tracking-[0.4em] text-cream-300"
                style="filter: drop-shadow(0 1px 6px rgba(0,0,0,0.6))">
                <i class="bx bxs-moon text-maroon-300"></i> Haifa Nida Wisata
            </span>

            <h1 data-hero-headline class="font-display max-w-3xl text-4xl italic leading-tight sm:text-6xl md:text-7xl">
                @foreach ($heroWords as $word)
                    <span data-word class="text-gradient-hero inline-block">{{ $word }}</span>{{ !$loop->last ? ' ' : '' }}
                @endforeach
            </h1>

            <p data-hero-subhead class="max-w-xl font-sans text-sm text-cream-100/90 sm:text-base"
                style="filter: drop-shadow(0 2px 8px rgba(0,0,0,0.6))">
                Rasakan momen sebelum tiba di Tanah Suci &mdash; dari halaman rumah Anda, hingga Ka'bah di hadapan mata.
            </p>

            <div data-hero-cta class="mt-2 flex flex-wrap items-center justify-center gap-3">
                <x-button href="/profil" variant="primary">Tentang Kami <i class="bx bx-chevron-right"></i></x-button>
                <x-button href="/kontak-kami" variant="outline"
                    class="border-cream-200! text-cream-100! hover:bg-cream-50/10!">Hubungi Kami</x-button>
            </div>

            <div data-hero-scrollcue class="absolute bottom-10 left-1/2 flex -translate-x-1/2 flex-col items-center gap-2 text-cream-200/70">
                <span class="font-sans text-[10px] uppercase tracking-[0.3em]">Scroll</span>
                <span class="hero-scrollcue-bob block h-8 w-px bg-linear-to-b from-cream-200/70 to-transparent"></span>
            </div>
        </div>
    </section>

    {{-- Floating experience badge, bridges hero into the next section. Kept
         as a sibling rather than a hero child so it isn't swept up in the
         hero's pin/scroll animation. --}}
    {{-- data-bridge-badge: fades out shortly before sliding under the
         translucent sticky nav — a bright card showing through the nav's
         backdrop blur reads as a rendering glitch otherwise. --}}
    <div data-bridge-badge class="relative z-30 hidden -mt-8 justify-center px-4 sm:-mt-10 sm:flex">
        <div class="flex items-center gap-4 rounded-2xl bg-cream-50 px-6 py-4 shadow-xl">
            <span class="font-display text-3xl font-bold text-maroon-700"><span data-counter="{{ $experienceYears }}">{{ $experienceYears }}</span>+</span>
            <span class="max-w-36 text-sm leading-snug text-stone-600">Tahun melayani perjalanan ibadah jema'ah Indonesia</span>
        </div>
    </div>

    {{-- Chapter 2 — Pilihan perjalanan: bento layout. Same cards/copy/links;
         data-* attributes drive the homepage-only choreography in
         resources/js/home-experience.js (unfold on arrival, 3D tilt + gold
         sheen on hover). Without JS or with reduced motion everything is
         plainly visible. --}}
    <section data-home-experience class="pb-16 pt-20 sm:pt-24">
        <div class="mx-auto max-w-7xl px-4">
            <div data-reveal class="mb-10 max-w-xl">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Pilihan Perjalanan Anda</span>
                <h2 class="font-display mt-2 text-3xl font-semibold text-maroon-900">Jelajahi Umroh, Haji, dan Wisata Halal</h2>
                <p class="mt-3 text-stone-600">Wujudkan perjalanan ibadah dan wisata halal Anda dengan pelayanan terbaik dari Haifa Nida Wisata.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <a href="/umroh" data-unfold="0" data-tilt data-sheen
                    class="group relative col-span-1 overflow-hidden rounded-2xl shadow-sm lg:col-span-2 lg:row-span-2">
                    <img src="{{ asset('storage/paket-galeri/umroh.jpg') }}" alt="Umroh"
                        class="h-80 w-full object-cover transition duration-500 group-hover:scale-105 lg:h-full">
                    <div class="absolute inset-0 flex flex-col justify-end bg-linear-to-t from-maroon-950/90 via-maroon-950/20 to-transparent p-7">
                        <span class="mb-2 text-xs font-semibold uppercase tracking-widest text-cream-300">01 &mdash; Populer</span>
                        <h3 class="font-display mb-3 text-2xl font-semibold text-cream-50">Ingin Umroh? Pesan Sekarang</h3>
                        <span class="inline-flex w-fit items-center gap-1 font-semibold text-cream-50">
                            Lihat Paket <i class="bx bx-chevron-right transition group-hover:translate-x-1"></i>
                        </span>
                    </div>
                </a>

                @foreach ([
                    ['img' => 'haji.jpg', 'label' => 'Ingin Haji? Pesan Sekarang', 'href' => '/haji', 'no' => '02'],
                    ['img' => 'wisata-halal.jpg', 'label' => 'Wisata Halal? Jelajahi Sekarang', 'href' => '/wisata-halal', 'no' => '03'],
                ] as $item)
                    <a href="{{ $item['href'] }}" data-unfold="{{ 0.12 * $loop->iteration }}" data-tilt data-sheen
                        class="group relative overflow-hidden rounded-2xl shadow-sm">
                        <img src="{{ asset('storage/paket-galeri/' . $item['img']) }}" alt="{{ $item['label'] }}"
                            class="h-44 w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 flex flex-col justify-end bg-linear-to-t from-maroon-950/90 via-maroon-950/10 to-transparent p-5">
                            <span class="mb-1 text-xs font-semibold uppercase tracking-widest text-cream-300">{{ $item['no'] }}</span>
                            <h3 class="font-display text-lg font-semibold text-cream-50">{{ $item['label'] }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Chapter 3 — Sejarah singkat: same content; text column reveals on
         arrival, the year counts up, the photo drifts inside its frame
         (parallax), and the "2007 Berdiri" seal settles into place. --}}
    <section class="bg-cream-50 py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 lg:grid-cols-2">
            <div data-reveal class="order-2 lg:order-1">
                <span class="text-6xl leading-none text-maroon-200">&ldquo;</span>
                <span class="-mt-4 block text-sm font-semibold uppercase tracking-widest text-maroon-700"><span data-counter="{{ $experienceYears }}">{{ $experienceYears }}</span> Tahun Pengalaman</span>
                <h2 class="font-display mt-2 mb-4 text-3xl font-semibold text-maroon-900">{{ $beranda4->judul }}</h2>
                <div class="prose max-w-none text-stone-600">{!! $beranda4->isi_konten !!}</div>
                <a href="/sejarah" class="mt-5 inline-flex items-center gap-1 font-semibold text-maroon-700 hover:text-maroon-800">
                    Baca Selengkapnya <i class="bx bx-chevron-right"></i>
                </a>
            </div>
            <div data-reveal data-reveal-delay="0.1" class="relative order-1 lg:order-2">
                <div class="absolute -inset-3 -z-10 rounded-2xl border-2 border-maroon-200"></div>
                {{-- overflow-hidden frame + slight overscale so the parallax drift never exposes edges --}}
                <div class="overflow-hidden rounded-2xl shadow-sm">
                    <img src="{{ asset('storage/' . $beranda4->gambar) }}" alt="Tentang Kami"
                        data-parallax-img class="w-full scale-[1.12] rounded-2xl object-cover">
                </div>
                <div data-seal class="absolute -bottom-5 -right-5 flex h-24 w-24 flex-col items-center justify-center rounded-full bg-maroon-700 text-center text-cream-50 shadow-lg">
                    <span class="font-display text-lg font-bold leading-none">2007</span>
                    <span class="text-[0.6rem] uppercase tracking-wide text-cream-200">Berdiri</span>
                </div>
            </div>
        </div>
    </section>
@endsection
