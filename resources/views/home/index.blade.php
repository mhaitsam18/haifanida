@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $slides = [$beranda1, $beranda2, $beranda3];
        $startDate = Carbon::create(2007, 8, 2);
        $experienceYears = now()->year - 2007;
    @endphp

    {{-- Hero --}}
    <section
        x-data="{ active: 0, count: {{ count($slides) }}, timer: null, start() { this.timer = setInterval(() => this.active = (this.active + 1) % this.count, 7000) } }"
        x-init="start()" class="relative overflow-hidden bg-maroon-950">
        @foreach ($slides as $i => $slide)
            <div x-show="active === {{ $i }}" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100" x-cloak
                class="relative flex min-h-125 items-center bg-cover bg-center sm:min-h-150"
                style="background-image: linear-gradient(120deg, rgba(46,0,11,0.92) 0%, rgba(46,0,11,0.55) 55%, rgba(46,0,11,0.25) 100%), url('{{ asset('storage/' . $slide->gambar) }}')">
                <div class="mx-auto w-full max-w-7xl px-4 py-20 sm:py-28">
                    <div class="max-w-xl">
                        <span class="mb-4 inline-flex items-center gap-2 text-sm font-semibold uppercase tracking-widest text-cream-300">
                            <i class="bx bxs-moon text-maroon-300"></i> Haifa Nida Wisata
                        </span>
                        <h1 class="font-display mb-5 text-4xl font-semibold leading-tight text-cream-50 sm:text-5xl">{{ $slide->judul }}</h1>
                        <div class="prose prose-invert mb-8 max-w-lg text-cream-200/90">{!! $slide->isi_konten !!}</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <x-button href="/profil" variant="primary">Tentang Kami <i class="bx bx-chevron-right"></i></x-button>
                            <x-button href="/kontak-kami" variant="outline"
                                class="border-cream-200! text-cream-100! hover:bg-cream-50/10!">Hubungi Kami</x-button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Slide progress indicators --}}
        <div class="absolute bottom-6 left-1/2 flex -translate-x-1/2 gap-2">
            @foreach ($slides as $i => $slide)
                <button @click="active = {{ $i }}"
                    class="h-1 w-10 overflow-hidden rounded-full bg-cream-50/25 transition">
                    <span class="block h-full bg-cream-50 transition-all"
                        :style="active === {{ $i }} ? 'width: 100%; transition: width 7s linear' : 'width: 0%'"></span>
                </button>
            @endforeach
        </div>

        {{-- Floating experience badge, bridges into next section --}}
        <div class="pointer-events-none absolute -bottom-8 left-1/2 hidden -translate-x-1/2 sm:block">
            <div class="pointer-events-auto flex items-center gap-4 rounded-2xl bg-cream-50 px-6 py-4 shadow-xl">
                <span class="font-display text-3xl font-bold text-maroon-700">{{ $experienceYears }}+</span>
                <span class="max-w-36 text-sm leading-snug text-stone-600">Tahun melayani perjalanan ibadah jema'ah Indonesia</span>
            </div>
        </div>
    </section>

    {{-- Pilihan perjalanan: bento layout --}}
    <section class="pb-16 pt-20 sm:pt-24">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-10 max-w-xl">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Pilihan Perjalanan Anda</span>
                <h2 class="font-display mt-2 text-3xl font-semibold text-maroon-900">Jelajahi Umroh, Haji, dan Wisata Halal</h2>
                <p class="mt-3 text-stone-600">Wujudkan perjalanan ibadah dan wisata halal Anda dengan pelayanan terbaik dari Haifa Nida Wisata.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <a href="/umroh" class="group relative col-span-1 overflow-hidden rounded-2xl shadow-sm lg:col-span-2 lg:row-span-2">
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
                    <a href="{{ $item['href'] }}" class="group relative overflow-hidden rounded-2xl shadow-sm">
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

    {{-- Sejarah singkat --}}
    <section class="bg-cream-50 py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 lg:grid-cols-2">
            <div class="order-2 lg:order-1">
                <span class="text-6xl leading-none text-maroon-200">&ldquo;</span>
                <span class="-mt-4 block text-sm font-semibold uppercase tracking-widest text-maroon-700">{{ $experienceYears }} Tahun Pengalaman</span>
                <h2 class="font-display mt-2 mb-4 text-3xl font-semibold text-maroon-900">{{ $beranda4->judul }}</h2>
                <div class="prose max-w-none text-stone-600">{!! $beranda4->isi_konten !!}</div>
                <a href="/sejarah" class="mt-5 inline-flex items-center gap-1 font-semibold text-maroon-700 hover:text-maroon-800">
                    Baca Selengkapnya <i class="bx bx-chevron-right"></i>
                </a>
            </div>
            <div class="relative order-1 lg:order-2">
                <div class="absolute -inset-3 -z-10 rounded-2xl border-2 border-maroon-200"></div>
                <img src="{{ asset('storage/' . $beranda4->gambar) }}" alt="Tentang Kami" class="w-full rounded-2xl object-cover shadow-sm">
                <div class="absolute -bottom-5 -right-5 flex h-24 w-24 flex-col items-center justify-center rounded-full bg-maroon-700 text-center text-cream-50 shadow-lg">
                    <span class="font-display text-lg font-bold leading-none">2007</span>
                    <span class="text-[0.6rem] uppercase tracking-wide text-cream-200">Berdiri</span>
                </div>
            </div>
        </div>
    </section>
@endsection
