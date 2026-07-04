@extends('layouts.app')

@section('content')
    <section class="py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Tagihan</h2>
            </div>

            @if ($tagihan->isEmpty())
                <div class="rounded-2xl border border-cream-200 bg-cream-50 p-10 text-center text-stone-500">
                    <i class="bx bx-receipt text-3xl"></i>
                    <p class="mt-2">Belum ada tagihan.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($tagihan as $item)
                        <x-card>
                            <h3 class="font-display text-lg font-semibold text-maroon-900">
                                Tagihan untuk Perjalanan {{ ucfirst($item->pemesanan->paket->jenis_paket) }} "{{ $item->pemesanan->paket->nama_paket ?? 'Tidak Diketahui' }}"
                            </h3>
                            <p class="mt-2 text-sm text-stone-600">Jumlah: Rp{{ number_format($item->pemesanan->total_harga, 0, ',', '.') }}</p>
                            <p class="mt-1 text-sm"><x-badge variant="danger">Belum Lunas</x-badge></p>
                            <div class="mt-4 text-right">
                                <x-button href="">Bayar</x-button>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
