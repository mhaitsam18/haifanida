@extends('layouts.app')

@section('content')
    <x-page-banner :title="$album->judul"
        :subtitle="$album->deskripsi ?: 'Dokumentasi perjalanan bersama Haifa Nida Wisata.'" />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4"
            x-data="{
                lightbox: false,
                current: 0,
                images: {{ Illuminate\Support\Js::from(
                    $galeries->where('jenis', 'gambar')->values()->map(fn ($g) => [
                        'src' => asset('storage/' . $g->file_path),
                        'nama' => $g->nama,
                    ])
                ) }},
                open(index) { this.current = index; this.lightbox = true; },
                next() { this.current = (this.current + 1) % this.images.length; },
                prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; },
            }"
            @keydown.escape.window="lightbox = false"
            @keydown.arrow-right.window="lightbox && next()"
            @keydown.arrow-left.window="lightbox && prev()">

            <div data-reveal class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <a href="/galeri" class="inline-flex items-center gap-1.5 text-sm font-semibold text-maroon-700 hover:text-maroon-800">
                        <i class="bx bx-arrow-back"></i> Semua Album
                    </a>
                    <div class="mt-2 flex items-center gap-3 text-sm text-stone-600">
                        @if ($album->tanggal)
                            <span class="inline-flex items-center gap-1.5"><i class="bx bx-calendar text-maroon-600"></i>
                                {{ \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') }}</span>
                        @endif
                        <span class="inline-flex items-center gap-1.5"><i class="bx bx-image text-maroon-600"></i> {{ $galeries->count() }} foto/video</span>
                    </div>
                </div>
            </div>

            @if ($galeries->isEmpty())
                <div data-reveal class="rounded-2xl border border-cream-200 bg-cream-50 px-6 py-16 text-center">
                    <i class="bx bx-image text-5xl text-maroon-300"></i>
                    <h3 class="font-display mt-4 text-xl font-semibold text-maroon-900">Album ini masih kosong</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">Foto-foto akan segera ditambahkan.</p>
                </div>
            @else
                @php $imageIndex = 0; @endphp
                <div class="columns-2 gap-4 sm:columns-3 lg:columns-4 [&>*]:mb-4 [&>*]:break-inside-avoid">
                    @foreach ($galeries as $galeri)
                        @if ($galeri->jenis === 'video')
                            <div data-reveal class="overflow-hidden rounded-xl border border-cream-200 bg-maroon-950 shadow-sm">
                                <video src="{{ asset('storage/' . $galeri->file_path) }}" controls preload="metadata" class="w-full"></video>
                            </div>
                        @else
                            <button type="button" data-reveal @click="open({{ $imageIndex }})"
                                class="group block w-full cursor-zoom-in overflow-hidden rounded-xl border border-cream-200 shadow-sm">
                                <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" loading="lazy"
                                    class="w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                            </button>
                            @php $imageIndex++; @endphp
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Lightbox --}}
            <div x-show="lightbox" x-cloak x-transition.opacity
                class="fixed inset-0 z-50 flex items-center justify-center bg-maroon-950/95 p-4 backdrop-blur-sm"
                @click.self="lightbox = false" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
                <button type="button" @click="lightbox = false" aria-label="Tutup"
                    class="absolute right-4 top-4 rounded-full bg-cream-50/10 p-2.5 text-cream-100 transition hover:bg-cream-50/20">
                    <i class="bx bx-x text-2xl"></i>
                </button>
                <button type="button" @click="prev()" aria-label="Sebelumnya" x-show="images.length > 1"
                    class="absolute left-3 rounded-full bg-cream-50/10 p-2.5 text-cream-100 transition hover:bg-cream-50/20 sm:left-6">
                    <i class="bx bx-chevron-left text-2xl"></i>
                </button>
                <figure class="max-h-full max-w-5xl">
                    <img :src="images[current]?.src" :alt="images[current]?.nama" class="max-h-[85vh] w-auto rounded-lg object-contain shadow-2xl">
                    <figcaption class="mt-3 text-center text-sm text-cream-200/80">
                        <span x-text="images[current]?.nama"></span>
                        <span class="mx-2 text-cream-200/40">&middot;</span>
                        <span x-text="(current + 1) + ' / ' + images.length"></span>
                    </figcaption>
                </figure>
                <button type="button" @click="next()" aria-label="Berikutnya" x-show="images.length > 1"
                    class="absolute right-3 rounded-full bg-cream-50/10 p-2.5 text-cream-100 transition hover:bg-cream-50/20 sm:right-6">
                    <i class="bx bx-chevron-right text-2xl"></i>
                </button>
            </div>
        </div>
    </section>
@endsection
