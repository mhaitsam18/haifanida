@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">
            <form id="filterForm" action="/umroh" method="GET"
                class="mb-12 grid gap-4 rounded-2xl border border-cream-200 bg-cream-50 p-5 shadow-sm md:grid-cols-2 lg:grid-cols-5 lg:items-end">
                <div>
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Range Harga</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="harga_min" placeholder="Min" value="{{ request('harga_min') }}"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <span class="text-stone-400">&ndash;</span>
                        <input type="number" name="harga_max" placeholder="Max" value="{{ request('harga_max') }}"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Tanggal Keberangkatan</label>
                    <div class="flex items-center gap-2">
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <span class="text-stone-400">&ndash;</span>
                        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Durasi Paket</label>
                    <select name="durasi" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="">Pilih Durasi</option>
                        @foreach ($durasiOptions as $durasi)
                            <option value="{{ $durasi }}" {{ request('durasi') == $durasi ? 'selected' : '' }}>{{ $durasi }} Hari</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Urutkan</label>
                    <select name="urutkan" onchange="document.getElementById('filterForm').submit()"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="">Pilih Urutan</option>
                        <option value="harga_terendah" {{ request('urutkan') == 'harga_terendah' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="harga_tertinggi" {{ request('urutkan') == 'harga_tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="durasi_terpendek" {{ request('urutkan') == 'durasi_terpendek' ? 'selected' : '' }}>Durasi Terpendek</option>
                        <option value="durasi_terpanjang" {{ request('urutkan') == 'durasi_terpanjang' ? 'selected' : '' }}>Durasi Terpanjang</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-search"></i> Cari
                    </button>
                    <a href="/umroh" class="inline-flex items-center justify-center rounded-lg border border-cream-300 px-3 py-2 text-stone-600 hover:bg-cream-100">
                        <i class="bx bx-refresh"></i>
                    </a>
                </div>
            </form>

            <div class="mb-8 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Paket Pilihan</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Pilih Paket Umroh Anda</h2>
            </div>

            @if ($pakets->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pakets as $paket)
                        <a href="/paket/{{ $paket->id }}" class="group flex flex-col overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm transition hover:shadow-lg">
                            <div class="relative aspect-4/3 overflow-hidden">
                                @if ($paket->gambar)
                                    <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                @else
                                    <img src="/assets/img/mekkah/aviator70.jpg" alt="{{ $paket->nama_paket }}" loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                @endif
                                <div class="absolute left-3 top-3 rounded-lg bg-maroon-900/90 px-2.5 py-1.5 text-center text-cream-50 backdrop-blur">
                                    <div class="font-display text-lg leading-none font-semibold">{{ Carbon::parse($paket->tanggal_mulai)->format('d') }}</div>
                                    <div class="text-[10px] uppercase tracking-wide">{{ Carbon::parse($paket->tanggal_mulai)->format('M') }}</div>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="font-display text-lg font-semibold text-maroon-900">{{ $paket->nama_paket }}</h3>
                                <p class="mt-1 text-lg font-semibold text-maroon-700">Rp {{ number_format($paket->harga, 0, ',', '.') }} <span class="text-xs font-normal text-stone-500">/orang</span></p>
                                <ul class="mt-3 space-y-1.5 text-sm text-stone-600">
                                    <li class="flex items-center gap-2"><i class="bx bx-purchase-tag-alt text-maroon-600"></i> {{ ucfirst($paket->jenis_paket) }}</li>
                                    <li class="flex items-center gap-2"><i class="bx bx-time text-maroon-600"></i> {{ $paket->durasi }} Hari</li>
                                    <li class="flex items-center gap-2"><i class="bx bx-calendar text-maroon-600"></i> Pulang {{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</li>
                                    <li class="flex items-center gap-2"><i class="bx bxs-plane-take-off text-maroon-600"></i> Dari {{ $paket->tempat_keberangkatan }}</li>
                                </ul>
                                <div class="mt-auto pt-4">
                                    <span class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg bg-maroon-700 py-2.5 text-sm font-semibold text-cream-50 transition group-hover:bg-maroon-800">
                                        <i class="bx bx-shopping-bag"></i> Pesan Sekarang
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="py-16 text-center text-stone-500">Tidak ada paket umroh yang tersedia saat ini.</p>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInputs = document.querySelectorAll('input[name="harga_min"], input[name="harga_max"]');
            priceInputs.forEach(input => {
                input.addEventListener('input', function () {
                    let value = this.value.replace(/\D/g, '');
                    if (value === '') return;
                    this.value = parseInt(value).toLocaleString('id-ID');
                });
            });
        });
    </script>
@endsection
