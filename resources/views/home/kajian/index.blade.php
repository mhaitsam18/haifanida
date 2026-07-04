@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;
    @endphp

    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            @if ($kajians->isEmpty())
                <p class="py-16 text-center text-stone-500">Belum ada kajian yang dipublikasikan saat ini.</p>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($kajians as $kajian)
                        <a href="{{ route('home.kajian.show', $kajian) }}" class="group flex flex-col overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm transition hover:shadow-lg">
                            <div class="relative aspect-4/3 overflow-hidden bg-cream-200">
                                @if ($kajian->gambar_sampul)
                                    <img src="{{ asset('storage/' . $kajian->gambar_sampul) }}" alt="{{ $kajian->judul }}" loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-stone-400"><i class="bx bx-book-open text-3xl"></i></div>
                                @endif
                                @if ($kajian->tanggal_publikasi)
                                    <div class="absolute left-3 top-3 rounded-lg bg-maroon-900/90 px-2.5 py-1.5 text-center text-cream-50 backdrop-blur">
                                        <div class="font-display text-lg leading-none font-semibold">{{ Carbon::parse($kajian->tanggal_publikasi)->format('d') }}</div>
                                        <div class="text-[10px] uppercase tracking-wide">{{ Carbon::parse($kajian->tanggal_publikasi)->format('M') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <ul class="flex flex-wrap items-center gap-3 text-xs text-stone-500">
                                    <li class="flex items-center gap-1"><i class="bx bxs-user"></i> {{ $kajian->author?->user?->name ?? 'Admin' }}</li>
                                    <li class="flex items-center gap-1"><i class="bx bx-show-alt"></i> {{ $kajian->jumlah_pembaca }} Dibaca</li>
                                    @if ($kajian->kategori)
                                        <li class="flex items-center gap-1"><i class="bx bx-purchase-tag-alt"></i> {{ $kajian->kategori }}</li>
                                    @endif
                                </ul>
                                <h3 class="font-display mt-2 text-lg font-semibold text-maroon-900">{{ $kajian->judul }}</h3>
                                <p class="mt-2 line-clamp-3 text-sm text-stone-600">{{ Str::limit(strip_tags($kajian->isi_kajian), 140) }}</p>
                                <span class="mt-auto inline-flex items-center gap-1 pt-4 text-sm font-semibold text-maroon-700 group-hover:text-maroon-900">
                                    Baca Selengkapnya <i class="bx bx-chevron-right"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $kajians->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
