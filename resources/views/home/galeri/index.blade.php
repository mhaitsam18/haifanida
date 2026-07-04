@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Galeri Kami</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Umroh dan Haji bersama PT. Haifa Nida Wisata</h2>
            </div>

            @if ($galeries->isEmpty())
                <p class="py-16 text-center text-stone-500">Belum ada galeri yang tersedia saat ini.</p>
            @else
                <div class="columns-1 gap-5 sm:columns-2 lg:columns-3 [&>div]:mb-5 [&>div]:break-inside-avoid">
                    @foreach ($galeries as $galeri)
                        <div class="group overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                            <div class="relative overflow-hidden">
                                @if ($galeri->jenis === 'video')
                                    <video src="{{ asset('storage/' . $galeri->file_path) }}" controls class="w-full"></video>
                                @else
                                    <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" loading="lazy"
                                        class="w-full object-cover transition duration-300 group-hover:scale-105">
                                @endif
                            </div>
                            @if ($galeri->nama || $galeri->deskripsi)
                                <div class="p-4">
                                    <span class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-maroon-700">
                                        <img src="/assets/img/icons/haji-umroh.png" class="h-4 w-4" alt=""> {{ $galeri->nama }}
                                    </span>
                                    @if ($galeri->deskripsi)
                                        <p class="mt-1.5 text-sm text-stone-600">{{ $galeri->deskripsi }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
