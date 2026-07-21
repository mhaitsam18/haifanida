@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Kenangan perjalanan ibadah bersama Haifa Nida Wisata — temukan album rombongan keberangkatan Anda." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4">
            <div data-reveal class="mb-10 max-w-xl">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Galeri Kami</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Album Perjalanan Jema'ah</h2>
                <p class="mt-3 text-stone-600">Setiap keberangkatan memiliki cerita. Buka album untuk melihat dokumentasi lengkap perjalanan rombongan.</p>
            </div>

            @if ($albums->isEmpty())
                <div data-reveal class="rounded-2xl border border-cream-200 bg-cream-50 px-6 py-16 text-center">
                    <i class="bx bx-photo-album text-5xl text-maroon-300"></i>
                    <h3 class="font-display mt-4 text-xl font-semibold text-maroon-900">Belum ada album</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">Dokumentasi perjalanan akan segera hadir di sini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($albums as $album)
                        <a href="/galeri/{{ $album->id }}" data-reveal data-reveal-delay="{{ ($loop->index % 3) * 0.08 }}" data-sheen
                            class="group relative overflow-hidden rounded-2xl shadow-sm transition-shadow hover:shadow-xl">
                            <div class="aspect-4/3 overflow-hidden bg-maroon-950">
                                @if ($album->cover)
                                    <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->judul }}" loading="lazy"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-cream-300/40">
                                        <i class="bx bx-photo-album text-6xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute inset-0 flex flex-col justify-end bg-linear-to-t from-maroon-950/90 via-maroon-950/25 to-transparent p-5">
                                @if ($album->tanggal)
                                    <span class="mb-1.5 inline-flex w-fit items-center gap-1.5 rounded-full bg-cream-50/15 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-cream-200 backdrop-blur-sm">
                                        <i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                @endif
                                <h3 class="font-display text-xl font-semibold text-cream-50">{{ $album->judul }}</h3>
                                <div class="mt-1.5 flex items-center justify-between text-sm text-cream-200/90">
                                    <span class="inline-flex items-center gap-1.5"><i class="bx bx-image"></i> {{ $album->galeris_count }} foto</span>
                                    <span class="inline-flex items-center gap-1 font-semibold text-cream-50">
                                        Buka Album <i class="bx bx-chevron-right transition group-hover:translate-x-1"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
