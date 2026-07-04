@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($paket ? 'paket/' . $paket->id . '/' : '') . 'pemesanan/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($paket)
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari pemesanan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Pemesan</th>
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Jenis Paket</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tanggal Pemesanan</th>
                    <th class="px-4 py-3">Tanggal Keberangkatan</th>
                    <th class="px-4 py-3">Jumlah Orang</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Metode Pembayaran</th>
                    <th class="px-4 py-3">Pelunasan</th>
                    <th class="px-4 py-3">Tenggat Pelunasan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesanans as $pemesanan)
                    @php
                        $statusVariant = match (true) {
                            $pemesanan->status == 'Tertunda' => 'warning',
                            in_array($pemesanan->status, ['diterima', 'dikonfirmasi']) => 'success',
                            in_array($pemesanan->status, ['ditolak', 'dibatalkan']) => 'danger',
                            default => 'neutral',
                        };
                    @endphp
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $pemesanan->user->name }}</td>
                        <td class="px-4 py-3"><a href="/admin/paket/{{ $pemesanan->paket_id }}" class="text-maroon-700 hover:underline">{{ $pemesanan->paket->nama_paket }}</a></td>
                        <td class="px-4 py-3">{{ $pemesanan->paket->jenis_paket }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$statusVariant">{{ $pemesanan->status }}</x-badge></td>
                        <td class="px-4 py-3">{{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->tanggal_berangkat ? Carbon::parse($pemesanan->tanggal_berangkat)->isoFormat('LL') : '-' }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->jumlah_orang }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($pemesanan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $pemesanan->metode_pembayaran }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$pemesanan->is_pembayaran_lunas ? 'success' : 'warning'">{{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}</x-badge></td>
                        <td class="px-4 py-3">{{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') : '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/pemesanan/{{ $pemesanan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <a href="/admin/pemesanan/{{ $pemesanan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/pemesanan/' . $pemesanan->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
