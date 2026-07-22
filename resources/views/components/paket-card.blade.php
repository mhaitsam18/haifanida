@props(['paket', 'reveal' => false, 'delay' => 0])

@php
    use Carbon\Carbon;
@endphp

<a href="/paket/{{ $paket->id }}"
    @if ($reveal) data-reveal data-reveal-delay="{{ $delay }}" @endif
    {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl']) }}>
    <div class="relative aspect-4/3 overflow-hidden">
        <img src="{{ $paket->gambar ? asset('storage/' . $paket->gambar) : '/assets/img/mekkah/aviator70.jpg' }}"
            alt="{{ $paket->nama_paket }}" loading="lazy" decoding="async"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        {{-- Warm gradient wash so white text/badges stay legible on any photo --}}
        <div class="pointer-events-none absolute inset-0 bg-linear-to-t from-maroon-950/40 via-transparent to-transparent"></div>

        @if ($paket->tanggal_mulai)
            <div class="absolute left-3 top-3 rounded-lg bg-maroon-900/90 px-2.5 py-1.5 text-center text-cream-50 shadow-sm backdrop-blur">
                <div class="font-display text-lg leading-none font-semibold">{{ Carbon::parse($paket->tanggal_mulai)->format('d') }}</div>
                <div class="text-[10px] uppercase tracking-wide">{{ Carbon::parse($paket->tanggal_mulai)->translatedFormat('M') }}</div>
            </div>
        @endif

        <span class="absolute right-3 top-3 rounded-full bg-cream-50/90 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-maroon-800 backdrop-blur">
            {{ ucwords($paket->jenis_paket) }}
        </span>
    </div>

    <div class="flex flex-1 flex-col p-5">
        <h3 class="font-display text-lg font-semibold text-maroon-900">{{ $paket->nama_paket }}</h3>

        @if ($paket->harga)
            <p class="mt-1 text-lg font-semibold text-maroon-700">
                Rp {{ number_format($paket->harga, 0, ',', '.') }}
                <span class="text-xs font-normal text-stone-500">/orang</span>
            </p>
        @endif

        <ul class="mt-3 space-y-1.5 text-sm text-stone-600">
            @if ($paket->durasi)
                <li class="flex items-center gap-2"><i class="bx bx-time text-maroon-600"></i> {{ $paket->durasi }} Hari</li>
            @endif
            @if ($paket->tanggal_selesai)
                <li class="flex items-center gap-2"><i class="bx bx-calendar text-maroon-600"></i> Pulang {{ Carbon::parse($paket->tanggal_selesai)->translatedFormat('d M Y') }}</li>
            @endif
            @if ($paket->tempat_keberangkatan)
                <li class="flex items-center gap-2"><i class="bx bxs-plane-take-off text-maroon-600"></i> Dari {{ $paket->tempat_keberangkatan }}</li>
            @endif
        </ul>

        <div class="mt-auto pt-4">
            <span class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg bg-maroon-700 py-2.5 text-sm font-semibold text-cream-50 transition group-hover:bg-maroon-800">
                <i class="bx bx-shopping-bag"></i> Lihat Detail
            </span>
        </div>
    </div>
</a>
