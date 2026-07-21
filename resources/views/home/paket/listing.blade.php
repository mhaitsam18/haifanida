@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" :subtitle="$subtitle ?? null" />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-4">
            {{--
                Shared package listing (umroh / haji / wisata-halal). Filter bar:
                paired-input fields (Range Harga, Tanggal) span 2 columns so the
                native date inputs — which have a large intrinsic min-width the
                browser won't shrink — never overflow their track (see the umroh
                filter fix). Price fields are type=text + inputmode=numeric so the
                thousand-separator formatting below actually renders; the server
                strips separators back to digits when filtering.
            --}}
            <form id="filterForm" action="{{ $action }}" method="GET"
                class="mb-12 grid grid-cols-1 gap-4 rounded-2xl border border-cream-200 bg-cream-50 p-5 shadow-sm md:grid-cols-2 lg:grid-cols-4 lg:items-end">
                <div class="md:col-span-2 lg:col-span-2">
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Range Harga</label>
                    <div class="flex items-center gap-2">
                        <input type="text" inputmode="numeric" name="harga_min" placeholder="Min" value="{{ request('harga_min') }}"
                            class="w-full min-w-0 rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <span class="text-stone-400">&ndash;</span>
                        <input type="text" inputmode="numeric" name="harga_max" placeholder="Max" value="{{ request('harga_max') }}"
                            class="w-full min-w-0 rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    </div>
                </div>
                <div class="md:col-span-2 lg:col-span-2">
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Tanggal Keberangkatan</label>
                    <div class="flex items-center gap-2">
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                            class="w-full min-w-0 rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <span class="text-stone-400">&ndash;</span>
                        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                            class="w-full min-w-0 rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    </div>
                </div>
                <div class="lg:col-span-1">
                    <label class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-stone-500">Durasi Paket</label>
                    <select name="durasi" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="">Pilih Durasi</option>
                        @foreach ($durasiOptions as $durasi)
                            <option value="{{ $durasi }}" {{ request('durasi') == $durasi ? 'selected' : '' }}>{{ $durasi }} Hari</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-1">
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
                <div class="flex gap-2 md:col-span-2 lg:col-span-2">
                    <button type="submit" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                        <i class="bx bx-search"></i> Cari
                    </button>
                    <a href="{{ $action }}" title="Reset filter" class="inline-flex items-center justify-center rounded-lg border border-cream-300 px-3 py-2 text-stone-600 hover:bg-cream-100">
                        <i class="bx bx-refresh"></i>
                    </a>
                </div>
            </form>

            <div data-reveal class="mb-8 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Paket Pilihan</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Pilih {{ $title }} Anda</h2>
            </div>

            @if ($pakets->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pakets as $paket)
                        <x-paket-card :paket="$paket" :reveal="true" :delay="($loop->index % 3) * 0.08" />
                    @endforeach
                </div>
            @else
                {{-- Premium contextual empty state. Doubles as a graceful
                     "coming soon" for haji / wisata halal (no published packages
                     yet) and as a "no results" for an over-narrow filter. --}}
                @php $isFiltered = collect(request()->only(['harga_min', 'harga_max', 'tanggal_mulai', 'tanggal_akhir', 'durasi']))->filter()->isNotEmpty(); @endphp
                <div data-reveal class="mx-auto max-w-2xl rounded-2xl border border-cream-200 bg-cream-50 px-6 py-16 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-maroon-50 text-maroon-600">
                        <i class="bx {{ $isFiltered ? 'bx-search-alt' : 'bx-calendar-star' }} text-3xl"></i>
                    </div>
                    @if ($isFiltered)
                        <h3 class="font-display mt-5 text-xl font-semibold text-maroon-900">Tidak ada paket yang cocok</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">Coba longgarkan filter pencarian Anda, atau lihat semua paket yang tersedia.</p>
                        <x-button href="{{ $action }}" variant="primary" class="mt-6"><i class="bx bx-refresh"></i> Lihat Semua Paket</x-button>
                    @else
                        <h3 class="font-display mt-5 text-xl font-semibold text-maroon-900">Jadwal {{ $title }} Segera Hadir</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">Kami sedang menyiapkan jadwal keberangkatan terbaru. Hubungi kami untuk informasi paket dan pemberangkatan berikutnya.</p>
                        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                            <x-button href="https://wa.me/6282299198002" target="_blank" variant="primary"><i class="bx bxl-whatsapp"></i> Tanya via WhatsApp</x-button>
                            <x-button href="/kontak-kami" variant="outline">Kontak Kami</x-button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[name="harga_min"], input[name="harga_max"]').forEach(input => {
                input.addEventListener('input', function () {
                    const digits = this.value.replace(/\D/g, '');
                    this.value = digits === '' ? '' : parseInt(digits, 10).toLocaleString('id-ID');
                });
            });
        });
    </script>
@endsection
