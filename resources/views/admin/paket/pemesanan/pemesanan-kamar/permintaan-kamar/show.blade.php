@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button variant="secondary" :href="'/admin/' . ($permintaanKamar->pemesanan_kamar_id ? 'pemesanan-kamar/' . $permintaanKamar->pemesanan_kamar_id . '/' : '') . 'permintaan-kamar'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card>
        <ul class="space-y-1.5 text-sm text-stone-700">
            <li><span class="text-stone-500">Permintaan:</span> {{ $permintaanKamar->permintaan }}</li>
            <li><span class="text-stone-500">Tambahan Harga:</span> Rp.{{ number_format($permintaanKamar->harga, 2, ',', '.') }}</li>
            <li><span class="text-stone-500">Keterangan:</span> {{ $permintaanKamar->keterangan ?? '-' }}</li>
        </ul>
    </x-card>
@endsection
