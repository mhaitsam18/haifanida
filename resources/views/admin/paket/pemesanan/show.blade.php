@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $statusVariant = match (true) {
            $pemesanan->status == 'Tertunda' => 'warning',
            in_array($pemesanan->status, ['diterima', 'dikonfirmasi']) => 'success',
            in_array($pemesanan->status, ['ditolak', 'dibatalkan']) => 'danger',
            default => 'neutral',
        };
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="/admin/paket/{{ $pemesanan->paket_id }}/jemaah?pemesanan_id={{ $pemesanan->id }}" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-group"></i> Lihat Jema'ah</a>
            <a href="/admin/pemesanan/{{ $pemesanan->id }}/tagihan" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-file"></i> Lihat Tagihan</a>
            <x-button variant="secondary" :href="'/admin/paket/' . $pemesanan->paket_id . '/pemesanan'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <div class="flex flex-col gap-6 md:flex-row md:items-start">
            <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" class="h-40 w-full shrink-0 rounded-lg object-cover md:w-56" alt="pemesanan">
            <div class="flex-1">
                <div class="mb-3 flex items-center gap-2">
                    <h5 class="font-display text-base font-semibold text-maroon-900">Detail Pemesanan</h5>
                    <x-badge :variant="$statusVariant">{{ $pemesanan->status }}</x-badge>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <ul class="space-y-1.5 text-sm text-stone-700">
                        <li><span class="text-stone-500">Nama Paket:</span> {{ $pemesanan->paket->nama_paket }}</li>
                        <li><span class="text-stone-500">Tanggal Pemesanan:</span> {{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</li>
                        <li><span class="text-stone-500">Jumlah Pesanan:</span> {{ $pemesanan->jumlah_orang }} pax</li>
                        <li><span class="text-stone-500">Total Harga:</span> Rp.{{ number_format($pemesanan->total_harga, 2, ',', '.') }}</li>
                    </ul>
                    <ul class="space-y-1.5 text-sm text-stone-700">
                        <li><span class="text-stone-500">Tanggal Pelunasan:</span> {{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') : '-' }}</li>
                        <li><span class="text-stone-500">Pembayaran:</span> {{ $pemesanan->metode_pembayaran }}</li>
                        <li class="flex items-center gap-2">
                            <span class="text-stone-500">Status Pelunasan:</span>
                            <x-badge :variant="$pemesanan->is_pembayaran_lunas ? 'success' : 'warning'">{{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}</x-badge>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-card>

    <x-card class="mb-6">
        <div class="mb-3 flex items-center justify-between">
            <h4 class="font-display text-sm font-semibold text-maroon-900">Pemesanan Kamar</h4>
            <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/pemesanan/' . $pemesanan->id . '/pemesanan-kamar/create'"><i class="bx bx-plus"></i> Tambah Pemesanan Kamar</x-button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Tipe Kamar</th>
                        <th class="px-3 py-2">Jumlah Pengisi</th>
                        <th class="px-3 py-2">Harga</th>
                        <th class="px-3 py-2">Keterangan</th>
                        <th class="px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($pemesanan->pemesananKamars as $kamar)
                        <tr>
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $kamar->tipe_kamar }}</td>
                            <td class="px-3 py-2">{{ $kamar->jumlah_pengisi }}</td>
                            <td class="px-3 py-2">Rp.{{ number_format($kamar->harga, 2, ',', '.') }}</td>
                            <td class="px-3 py-2">{{ $kamar->keterangan }}</td>
                            <td class="px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/pemesanan-kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Permintaan</a>
                                    <a href="/admin/pemesanan-kamar/{{ $kamar->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                    <x-delete-form :action="'/admin/pemesanan-kamar/' . $kamar->id" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-2 text-stone-500">Pemesanan kamar belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <x-card class="mb-6">
        <div class="mb-3 flex items-center justify-between">
            <h4 class="font-display text-sm font-semibold text-maroon-900">Pemesanan Ekstra</h4>
            <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/pemesanan/' . $pemesanan->id . '/pemesanan-ekstra/create'"><i class="bx bx-plus"></i> Tambah Pemesanan Ekstra</x-button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Ekstra / Tambahan</th>
                        <th class="px-3 py-2">Jumlah</th>
                        <th class="px-3 py-2">Total Harga</th>
                        <th class="px-3 py-2">Keterangan</th>
                        <th class="px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($pemesanan->pemesananEkstras as $ekstra)
                        <tr>
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $ekstra->ekstra }}</td>
                            <td class="px-3 py-2">{{ $ekstra->jumlah }}</td>
                            <td class="px-3 py-2">Rp.{{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                            <td class="px-3 py-2">{{ $ekstra->keterangan }}</td>
                            <td class="px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                    <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                    <x-delete-form :action="'/admin/pemesanan-ekstra/' . $ekstra->id" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-2 text-stone-500">Pemesanan ekstra belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <x-card>
        <div class="mb-3 flex items-center justify-between">
            <h4 class="font-display text-sm font-semibold text-maroon-900">Riwayat Pembayaran</h4>
            <x-button class="!px-3 !py-1.5 !text-xs" :href="'/admin/pemesanan/' . $pemesanan->id . '/pembayaran/create'"><i class="bx bx-plus"></i> Tambah Riwayat Pembayaran</x-button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Jumlah Pembayaran</th>
                        <th class="px-3 py-2">Metode Pembayaran</th>
                        <th class="px-3 py-2">Tanggal Pembayaran</th>
                        <th class="px-3 py-2">Bukti Pembayaran</th>
                        <th class="px-3 py-2">Status Pembayaran</th>
                        <th class="px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @forelse ($pemesanan->pembayarans as $pembayaran)
                        <tr>
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                            <td class="px-3 py-2">{{ $pembayaran->metode_pembayaran }}</td>
                            <td class="px-3 py-2">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</td>
                            <td class="px-3 py-2">
                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-maroon-700 hover:underline">Lihat Bukti</a>
                            </td>
                            <td class="px-3 py-2">
                                <x-badge :variant="$pembayaran->status_pembayaran == 'diterima' ? 'success' : ($pembayaran->status_pembayaran == 'ditolak' ? 'danger' : 'warning')">{{ $pembayaran->status_pembayaran }}</x-badge>
                            </td>
                            <td class="px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/pembayaran/{{ $pembayaran->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                    <a href="/admin/pembayaran/{{ $pembayaran->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                    <x-delete-form :action="'/admin/pembayaran/' . $pembayaran->id" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-2 text-stone-500">Riwayat pembayaran belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
@endsection
