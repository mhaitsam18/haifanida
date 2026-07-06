@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Selamat Datang, {{ $user->name }}</h2>
                <p class="mt-1 text-sm text-stone-500">Ringkasan akun dan perjalanan Anda</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <x-card>
                    <h3 class="font-display mb-3 text-base font-semibold text-maroon-900">
                        <i class="bx bx-calendar-check align-middle text-maroon-700"></i> Keberangkatan Terdekat
                    </h3>
                    @if ($keberangkatanTerdekat)
                        @php $departure = Carbon::parse($keberangkatanTerdekat->paket->tanggal_mulai); @endphp
                        <p class="text-lg font-semibold text-stone-800">{{ $keberangkatanTerdekat->paket->nama_paket }}</p>
                        <p class="mt-1 text-sm text-stone-500">{{ $departure->isoFormat('LL') }}</p>
                        <p class="mt-2 text-2xl font-bold text-maroon-800">
                            {{ max(0, Carbon::now()->diffInDays($departure, false)) }} hari lagi
                        </p>
                        <a href="{{ route('member.daftar-keberangkatan') }}" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-maroon-700 hover:underline">
                            Lihat detail <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    @else
                        <p class="text-sm text-stone-500">Belum ada keberangkatan yang akan datang.</p>
                        <a href="{{ route('umroh.index') }}" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-maroon-700 hover:underline">
                            Lihat paket umroh <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    @endif
                </x-card>

                <x-card>
                    <h3 class="font-display mb-3 text-base font-semibold text-maroon-900">
                        <i class="bx bx-wallet align-middle text-maroon-700"></i> Ringkasan Tagihan
                    </h3>
                    <p class="text-sm text-stone-500">Total saldo tertunggak dari seluruh pemesanan aktif</p>
                    <p class="mt-2 text-2xl font-bold {{ $totalSaldoTertunggak > 0 ? 'text-maroon-800' : 'text-emerald-700' }}">
                        Rp.{{ number_format($totalSaldoTertunggak, 2, ',', '.') }}
                    </p>
                    <a href="{{ route('member.perjalanan-saya') }}" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-maroon-700 hover:underline">
                        Lihat semua pemesanan <i class="bx bx-right-arrow-alt"></i>
                    </a>
                </x-card>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <a href="{{ route('member.daftar-keberangkatan') }}" class="flex items-center gap-3 rounded-xl border border-cream-200 bg-cream-50 p-4 hover:shadow-sm">
                    <i class="bx bx-plane-alt text-2xl text-maroon-700"></i>
                    <span class="text-sm font-medium text-stone-700">Daftar Keberangkatan</span>
                </a>
                <a href="{{ route('member.perjalanan-saya') }}" class="flex items-center gap-3 rounded-xl border border-cream-200 bg-cream-50 p-4 hover:shadow-sm">
                    <i class="bx bx-history text-2xl text-maroon-700"></i>
                    <span class="text-sm font-medium text-stone-700">Riwayat Perjalanan</span>
                </a>
                <a href="{{ route('member.identitas') }}" class="flex items-center gap-3 rounded-xl border border-cream-200 bg-cream-50 p-4 hover:shadow-sm">
                    <i class="bx bx-id-card text-2xl text-maroon-700"></i>
                    <span class="text-sm font-medium text-stone-700">Identitas & Berkas</span>
                </a>
            </div>
        </div>
    </section>
@endsection
