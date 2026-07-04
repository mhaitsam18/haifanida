@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/pemesanan-ekstra/' . $pemesananEkstra->id . '/edit'"><i class="bx bx-edit"></i> Edit</x-button>
            <x-button variant="secondary" :href="'/admin/' . ($pemesananEkstra->pemesanan_id ? 'pemesanan/' . $pemesananEkstra->pemesanan_id . '/' : '') . 'pemesanan-ekstra'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card>
        <ul class="space-y-1.5 text-sm text-stone-700">
            <li><span class="text-stone-500">Pemesanan:</span> {{ $pemesananEkstra->pemesanan->user->name ?? '-' }} &mdash; {{ $pemesananEkstra->pemesanan->paket->nama_paket ?? '-' }}</li>
            <li><span class="text-stone-500">Ekstra / Tambahan:</span> {{ $pemesananEkstra->ekstra }}</li>
            <li><span class="text-stone-500">Jumlah:</span> {{ $pemesananEkstra->jumlah }}</li>
            <li><span class="text-stone-500">Total Harga:</span> Rp.{{ number_format($pemesananEkstra->total_harga, 2, ',', '.') }}</li>
            <li><span class="text-stone-500">Keterangan:</span> {{ $pemesananEkstra->keterangan ?? '-' }}</li>
        </ul>
    </x-card>
@endsection
