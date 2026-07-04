@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="border-b border-cream-200 bg-cream-50">
        <div class="mx-auto max-w-3xl px-4 py-4 text-sm text-stone-500">
            <a href="/" class="hover:text-maroon-700">Home</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <a href="{{ route('home.kajian') }}" class="hover:text-maroon-700">Kajian</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <span class="text-stone-700">{{ $kajian->judul }}</span>
        </div>
    </div>

    <section class="py-12">
        <div class="mx-auto max-w-3xl px-4">
            @if ($kajian->gambar_sampul)
                <div class="overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                    <img src="{{ asset('storage/' . $kajian->gambar_sampul) }}" alt="{{ $kajian->judul }}" class="aspect-video w-full object-cover">
                </div>
            @endif

            <div class="mt-8">
                <ul class="flex flex-wrap items-center gap-4 text-sm text-stone-500">
                    <li class="flex items-center gap-1.5"><i class="bx bxs-user text-maroon-700"></i> {{ $kajian->author?->user?->name ?? 'Admin' }}</li>
                    <li class="flex items-center gap-1.5"><i class="bx bx-show-alt text-maroon-700"></i> {{ $kajian->jumlah_pembaca }} Dibaca</li>
                    @if ($kajian->tanggal_publikasi)
                        <li class="flex items-center gap-1.5"><i class="bx bx-calendar text-maroon-700"></i> {{ Carbon::parse($kajian->tanggal_publikasi)->translatedFormat('d F Y') }}</li>
                    @endif
                    @if ($kajian->kategori)
                        <li class="flex items-center gap-1.5"><i class="bx bx-purchase-tag-alt text-maroon-700"></i> {{ $kajian->kategori }}</li>
                    @endif
                </ul>
                <h1 class="font-display mt-3 text-2xl font-semibold text-maroon-900 md:text-3xl">{{ $kajian->judul }}</h1>
            </div>

            <div class="prose mt-8 max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600">
                {!! nl2br(e($kajian->isi_kajian)) !!}
            </div>

            @if ($kajian->sumber_referensi)
                <div class="mt-8 rounded-xl border border-cream-200 bg-cream-50 p-4 text-sm text-stone-500">
                    <span class="font-medium text-stone-700">Sumber referensi:</span> {{ $kajian->sumber_referensi }}
                </div>
            @endif

            <a href="{{ route('home.kajian') }}" class="mt-10 inline-flex items-center gap-2 text-sm font-semibold text-maroon-700 hover:text-maroon-900">
                <i class="bx bx-chevron-left"></i> Kembali ke Kajian
            </a>
        </div>
    </section>
@endsection
