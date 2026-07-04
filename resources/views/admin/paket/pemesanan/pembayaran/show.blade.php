@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/pembayaran/' . $pembayaran->id . '/edit'"><i class="bx bx-edit"></i> Edit</x-button>
            <x-button variant="secondary" :href="'/admin/' . ($pembayaran->pemesanan_id ? 'pemesanan/' . $pembayaran->pemesanan_id . '/' : '') . 'pembayaran'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="md:col-span-2">
                <ul class="space-y-1.5 text-sm text-stone-700">
                    <li><span class="text-stone-500">Pemesanan:</span> {{ $pembayaran->pemesanan->user->name ?? '-' }} &mdash; {{ $pembayaran->pemesanan->paket->nama_paket ?? '-' }}</li>
                    <li><span class="text-stone-500">Jumlah Pembayaran:</span> Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</li>
                    <li><span class="text-stone-500">Metode Pembayaran:</span> {{ $pembayaran->metode_pembayaran }}</li>
                    <li><span class="text-stone-500">Tanggal Pembayaran:</span> {{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</li>
                    <li class="flex items-center gap-2">
                        <span class="text-stone-500">Status Pembayaran:</span>
                        <x-badge :variant="$pembayaran->status_pembayaran == 'diterima' ? 'success' : ($pembayaran->status_pembayaran == 'ditolak' ? 'danger' : 'warning')">{{ $pembayaran->status_pembayaran }}</x-badge>
                    </li>
                    <li><span class="text-stone-500">Keterangan:</span> {{ $pembayaran->keterangan ?? '-' }}</li>
                </ul>
            </div>
            <div>
                <h4 class="font-display mb-2 text-sm font-semibold text-maroon-900">Bukti Pembayaran</h4>
                @if ($pembayaran->bukti_pembayaran)
                    @if (str_ends_with(strtolower($pembayaran->bukti_pembayaran), '.pdf'))
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-md bg-maroon-50 px-3 py-1.5 text-xs font-medium text-maroon-700 hover:bg-maroon-100"><i class="bx bx-file"></i> Lihat Bukti (PDF)</a>
                    @else
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full rounded-lg border border-cream-200 object-cover">
                        </a>
                    @endif
                @else
                    <p class="text-sm text-stone-500">Bukti pembayaran belum tersedia</p>
                @endif
            </div>
        </div>
    </x-card>
@endsection
