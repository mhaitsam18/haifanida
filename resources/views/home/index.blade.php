@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $slides = [$beranda1, $beranda2, $beranda3];
        $startDate = Carbon::create(2007, 8, 2);
        $experienceYears = Carbon::now()->diffInYears($startDate);
    @endphp

    {{-- Hero / banner slider --}}
    <section x-data="{ active: 0, slides: {{ count($slides) }} }" x-init="setInterval(() => active = (active + 1) % slides, 6000)" class="relative overflow-hidden">
        @foreach ($slides as $i => $slide)
            <div x-show="active === {{ $i }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-cloak
                class="relative flex min-h-105 items-center bg-cover bg-center sm:min-h-130"
                style="background-image: linear-gradient(rgba(46,0,11,0.55), rgba(46,0,11,0.55)), url('{{ asset('storage/' . $slide->gambar) }}')">
                <div class="mx-auto max-w-3xl px-4 py-16 text-center text-cream-50">
                    <h1 class="mb-4 text-3xl font-bold sm:text-4xl">{{ $slide->judul }}</h1>
                    <div class="prose prose-invert mx-auto mb-6 max-w-2xl text-cream-100">{!! $slide->isi_konten !!}</div>
                    <x-button href="/profil" variant="primary">Tentang Kami <i class="bx bx-chevron-right"></i></x-button>
                </div>
            </div>
        @endforeach

        <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
            @foreach ($slides as $i => $slide)
                <button @click="active = {{ $i }}" :class="active === {{ $i }} ? 'bg-cream-50' : 'bg-cream-50/40'" class="h-2 w-2 rounded-full transition"></button>
            @endforeach
        </div>
    </section>

    {{-- Pilihan perjalanan --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-wide text-maroon-700">Pilihan Perjalanan Anda</span>
                <h2 class="mt-2 text-2xl font-bold text-maroon-900 sm:text-3xl">Jelajahi Umroh, Haji, dan Wisata Halal</h2>
                <p class="mx-auto mt-3 max-w-2xl text-stone-600">Wujudkan perjalanan ibadah dan wisata halal Anda dengan pelayanan terbaik dari Haifa Nida Wisata.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['img' => 'umroh.jpg', 'label' => 'Ingin Umroh? Pesan Sekarang', 'href' => '/umroh'],
                    ['img' => 'haji.jpg', 'label' => 'Ingin Haji? Pesan Sekarang', 'href' => '/haji'],
                    ['img' => 'wisata-halal.jpg', 'label' => 'Wisata Halal? Jelajahi Sekarang', 'href' => '/wisata-halal'],
                ] as $item)
                    <div class="group relative overflow-hidden rounded-xl shadow-sm">
                        <img src="{{ asset('storage/paket-galeri/' . $item['img']) }}" alt="{{ $item['label'] }}"
                            class="h-72 w-full object-cover transition duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 flex flex-col items-start justify-end bg-linear-to-t from-maroon-950/85 via-maroon-950/10 to-transparent p-5">
                            <h3 class="mb-3 text-lg font-semibold text-cream-50">{{ $item['label'] }}</h3>
                            <x-button :href="$item['href']" variant="primary">Lihat Paket <i class="bx bx-chevron-right"></i></x-button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sejarah singkat --}}
    <section class="bg-cream-50 py-16">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-4 lg:grid-cols-2">
            <div>
                <span class="text-sm font-semibold uppercase tracking-wide text-maroon-700">{{ $experienceYears }} Tahun Pengalaman</span>
                <h2 class="mt-2 mb-4 text-2xl font-bold text-maroon-900 sm:text-3xl">{{ $beranda4->judul }}</h2>
                <div class="prose max-w-none text-stone-600">{!! $beranda4->isi_konten !!}</div>
                <a href="/sejarah" class="mt-4 inline-flex items-center gap-1 font-semibold text-maroon-700 hover:text-maroon-800">
                    Baca Selengkapnya <i class="bx bx-chevron-right"></i>
                </a>
            </div>
            <div>
                <img src="{{ asset('storage/' . $beranda4->gambar) }}" alt="Tentang Kami" class="w-full rounded-xl object-cover shadow-sm">
            </div>
        </div>
    </section>
@endsection
