@extends('admin.layouts.app')

@section('content')
    @php
        $namaBulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button variant="secondary" :href="route('admin.laporan-keuangan.export')"><i class="bx bx-download"></i> Export CSV</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <h3 class="font-display mb-4 text-lg font-semibold text-maroon-900">Pemasukan Bulanan {{ $tahun }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Bulan</th>
                        <th class="px-4 py-3 text-right">Diterima</th>
                        <th class="px-4 py-3 text-right">Tertunda</th>
                        <th class="px-4 py-3 text-right">Ditolak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        @php $rows = $pemasukanPerBulan->get($bulan, collect()); @endphp
                        <tr>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $namaBulan[$bulan] }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($rows->firstWhere('status_pembayaran', 'diterima')->total ?? 0, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($rows->firstWhere('status_pembayaran', 'tertunda')->total ?? 0, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($rows->firstWhere('status_pembayaran', 'ditolak')->total ?? 0, 2, ',', '.') }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </x-card>

    <x-card>
        <div class="mb-4 flex items-center justify-between">
            <h3 class="font-display text-lg font-semibold text-maroon-900">Saldo Tertunggak</h3>
            <x-badge variant="danger">Total: Rp.{{ number_format($totalTertunggak, 2, ',', '.') }}</x-badge>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Pemesan</th>
                        <th class="px-4 py-3">Paket</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Total Tagihan</th>
                        <th class="px-4 py-3 text-right">Sudah Dibayar</th>
                        <th class="px-4 py-3 text-right">Saldo</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($saldoTertunggak as $item)
                        <tr>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $item['pemesanan']->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item['pemesanan']->paket->nama_paket ?? '-' }}</td>
                            <td class="px-4 py-3"><x-badge variant="warning">{{ $item['pemesanan']->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($item['subtotal'] + $item['tax'], 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($item['pembayaran'], 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-maroon-800">Rp.{{ number_format($item['balance'], 2, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.pemesanan.tagihan', $item['pemesanan']->id) }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Tagihan</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-stone-500">Tidak ada saldo tertunggak.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
@endsection
