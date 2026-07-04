@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Riwayat Perjalanan</h2>
                <p class="mt-1 text-sm text-stone-500">Daftar perjalanan yang telah selesai</p>
            </div>

            @if ($pemesanan && count($pemesanan) > 0)
                <div class="space-y-6">
                    @foreach ($pemesanan as $item)
                        @php
                            $returnDate = Carbon::parse($item->paket->tanggal_selesai);
                            $sisa_hari = Carbon::today()->diffInDays($returnDate, false);
                        @endphp

                        <x-card>
                            <div class="flex items-center justify-between">
                                <h3 class="font-display text-lg font-semibold text-maroon-900">{{ $item->paket->nama_paket }}</h3>
                                <x-badge variant="neutral">Selesai</x-badge>
                            </div>
                            <div class="mt-4 flex flex-col gap-4 sm:flex-row">
                                <img src="{{ $item->paket->gambar ? asset('storage/' . $item->paket->gambar) : asset('storage/paket-gambar/default.jpg') }}"
                                    alt="{{ $item->paket->nama_paket }}" class="h-40 w-full shrink-0 rounded-xl object-cover sm:w-56">
                                <div>
                                    <h4 class="text-sm font-medium text-stone-500">Selesai {{ abs($sisa_hari) }} hari yang lalu</h4>
                                    <p class="mt-2 text-sm font-medium text-stone-700">
                                        Tanggal Perjalanan: {{ Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} &ndash; {{ Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}
                                    </p>
                                    <div class="mt-3 grid gap-1.5 text-sm text-stone-600 sm:grid-cols-2">
                                        <p class="flex items-center gap-2"><i class="bx bx-group text-maroon-700"></i> Jumlah Orang: {{ $item->jumlah_orang }} Orang</p>
                                        <p class="flex items-center gap-2"><i class="bx bx-briefcase text-maroon-700"></i> Jenis: {{ ucfirst($item->paket->jenis_paket) }}</p>
                                        <p class="flex items-center gap-2"><i class="bx bxs-plane-take-off text-maroon-700"></i> Keberangkatan: {{ ucfirst($item->paket->tempat_keberangkatan) }}</p>
                                        <p class="flex items-center gap-2"><i class="bx bxs-plane-land text-maroon-700"></i> Kepulangan: {{ ucfirst($item->paket->tempat_kepulangan) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <x-button :href="route('pemesanan.detail', $item->id)">
                                    <i class="bx bx-info-circle"></i> Detail
                                </x-button>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-cream-200 bg-cream-50 p-10 text-center">
                    <i class="bx bx-info-circle text-3xl text-maroon-700"></i>
                    <h4 class="font-display mt-2 text-lg font-semibold text-maroon-900">Belum ada riwayat perjalanan</h4>
                    <p class="mt-1 text-sm text-stone-500">Anda belum memiliki perjalanan yang telah selesai dan terkonfirmasi.</p>
                    <x-button :href="route('umroh.index')" class="mt-4">
                        <i class="bx bx-search"></i> Cari Paket Perjalanan
                    </x-button>
                </div>
            @endif
        </div>
    </section>
@endsection
