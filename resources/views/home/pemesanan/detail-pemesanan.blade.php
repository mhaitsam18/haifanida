@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $statusVariant = match (true) {
            $pemesanan->status == 'Tertunda' => 'neutral',
            in_array($pemesanan->status, ['diterima', 'dikonfirmasi']) => 'success',
            in_array($pemesanan->status, ['ditolak', 'dibatalkan']) => 'danger',
            default => 'neutral',
        };
    @endphp

    <section class="py-10">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">{{ $title }}</h2>
                <x-button variant="secondary" :href="$pemesanan->paket->tanggal_selesai >= Carbon::now() ? route('member.daftar-keberangkatan') : route('member.riwayat-perjalanan')">
                    <i class="bx bx-arrow-back"></i> Kembali
                </x-button>
            </div>

            <div class="mb-6 flex flex-wrap items-center gap-4 rounded-2xl border border-cream-200 bg-cream-50 p-5">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-maroon-100 text-2xl text-maroon-700">
                    <i class="bx bx-headphone"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-stone-800">Butuh bantuan atau ingin mengubah pesanan Anda?</p>
                    <p class="text-sm text-stone-500">Hubungi admin kami untuk bantuan cepat dan mudah</p>
                </div>
                <a href="https://wa.me/6282299198002?text=Halo%20Admin,%20saya%20ingin%20menanyakan%20atau%20mengubah%20pemesanan%20(ID:%20{{ $pemesanan->id }})"
                    target="_blank" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                    <i class="bx bxl-whatsapp text-lg"></i> Hubungi Admin
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <div class="rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div class="flex items-center justify-between border-b border-cream-200 p-5">
                    <h4 class="font-medium text-stone-700">Detail Pemesanan</h4>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-stone-500">Status Pemesanan:</span>
                        <x-badge :variant="$statusVariant">{{ ucfirst($pemesanan->status) }}</x-badge>
                    </div>
                </div>

                <div class="p-5 md:p-6">
                    <div class="grid gap-6 md:grid-cols-4">
                        <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" alt="{{ $pemesanan->paket->nama_paket }}" class="aspect-square w-full rounded-xl object-cover md:col-span-1">

                        <div class="md:col-span-3 grid gap-6 sm:grid-cols-2">
                            <div>
                                <h6 class="mb-2 text-xs font-semibold uppercase tracking-wide text-stone-400">Informasi Paket</h6>
                                <ul class="space-y-1.5 text-sm text-stone-700">
                                    <li><span class="font-medium">Nama Paket:</span> {{ $pemesanan->paket->nama_paket }}</li>
                                    <li><span class="font-medium">Tanggal Pemesanan:</span> {{ Carbon::parse($pemesanan->tanggal_pesan)->format('d/m/Y') }}</li>
                                    <li><span class="font-medium">Jumlah Pesanan:</span> {{ $pemesanan->jumlah_orang }} pax</li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="mb-2 text-xs font-semibold uppercase tracking-wide text-stone-400">Informasi Pembayaran</h6>
                                <ul class="space-y-1.5 text-sm text-stone-700">
                                    <li><span class="font-medium">Tanggal Pelunasan:</span> {{ $pemesanan->tanggal_pelunasan ? Carbon::parse($pemesanan->tanggal_pelunasan)->format('d/m/Y') : '-' }}</li>
                                    <li><span class="font-medium">Metode Pembayaran:</span> {{ $pemesanan->metode_pembayaran ?: '-' }}</li>
                                    <li class="flex items-center gap-2">
                                        <span class="font-medium">Status Pelunasan:</span>
                                        <x-badge :variant="$pemesanan->is_pembayaran_lunas ? 'success' : 'warning'">
                                            {{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}
                                        </x-badge>
                                    </li>
                                </ul>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @if (in_array($pemesanan->status, ['dikonfirmasi', 'diterima']))
                                        <x-button :href="route('pemesanan.jemaah.list', $pemesanan->id)">
                                            <i class="bx bx-group"></i> Data Jema'ah
                                        </x-button>
                                    @else
                                        <button type="button" onclick="showJemaahInfo()" class="inline-flex items-center gap-2 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                                            <i class="bx bx-group"></i> Data Jema'ah
                                        </button>
                                    @endif
                                    <x-button variant="secondary" :href="route('member.tagihan', $pemesanan->id)" class="bg-emerald-100! text-emerald-800! hover:bg-emerald-200!">
                                        <i class="bx bx-receipt"></i> Lihat Tagihan
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h5 class="font-display mb-3 flex items-center gap-2 font-semibold text-maroon-900">
                            <i class="bx bx-building-house"></i> Pemesanan Kamar
                        </h5>
                        <div class="overflow-x-auto rounded-xl border border-cream-200">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Tipe Kamar</th>
                                        <th class="px-4 py-3">Jumlah Pengisi</th>
                                        <th class="px-4 py-3">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cream-200">
                                    @if ($pemesanan->pemesananKamars->count() > 0)
                                        @foreach ($pemesanan->pemesananKamars as $kamar)
                                            <tr>
                                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-3">{{ $kamar->tipe_kamar }}</td>
                                                <td class="px-4 py-3">{{ $kamar->jumlah_pengisi }}</td>
                                                <td class="px-4 py-3">Rp {{ number_format($kamar->harga, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="px-4 py-10 text-center text-stone-500">
                                                <i class="bx bx-info-circle text-2xl"></i>
                                                <p class="mt-1">Belum ada pemesanan kamar</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h5 class="font-display mb-3 flex items-center gap-2 font-semibold text-maroon-900">
                            <i class="bx bx-plus-circle"></i> Pemesanan Ekstra
                        </h5>
                        <div class="overflow-x-auto rounded-xl border border-cream-200">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Ekstra</th>
                                        <th class="px-4 py-3">Jumlah</th>
                                        <th class="px-4 py-3">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cream-200">
                                    @forelse ($pemesanan->pemesananEkstras as $index => $pemesananEkstra)
                                        <tr>
                                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3">{{ $pemesananEkstra->ekstra }}</td>
                                            <td class="px-4 py-3">{{ $pemesananEkstra->jumlah }}</td>
                                            <td class="px-4 py-3">Rp {{ number_format($pemesananEkstra->total_harga, 2, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-10 text-center text-stone-500">
                                                <i class="bx bx-info-circle text-2xl"></i>
                                                <p class="mt-1">Tidak ada pemesanan ekstra</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="mb-3 flex items-center justify-between">
                            <h5 class="font-display flex items-center gap-2 font-semibold text-maroon-900">
                                <i class="bx bx-credit-card"></i> Pembayaran
                            </h5>
                            <x-button :href="route('pembayaran.create', $pemesanan->id)">
                                <i class="bx bx-plus"></i> Tambah Pembayaran
                            </x-button>
                        </div>
                        <div class="overflow-x-auto rounded-xl border border-cream-200">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Jumlah</th>
                                        <th class="px-4 py-3">Metode</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                        <th class="px-4 py-3">Bukti</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cream-200">
                                    @if ($pemesanan->pembayarans->count() > 0)
                                        @foreach ($pemesanan->pembayarans as $pembayaran)
                                            <tr>
                                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-3">Rp {{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                                                <td class="px-4 py-3">{{ $pembayaran->metode_pembayaran }}</td>
                                                <td class="px-4 py-3">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y') }}</td>
                                                <td class="px-4 py-3">
                                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank"
                                                        class="inline-flex items-center gap-1 rounded-lg border border-cream-300 px-2.5 py-1 text-xs font-medium text-stone-700 hover:bg-cream-100">
                                                        <i class="bx bx-file"></i> Lihat Bukti
                                                    </a>
                                                </td>
                                                <td class="px-4 py-3">
                                                    @if ($pembayaran->status_pembayaran == 'diterima')
                                                        <x-badge variant="success">Diterima</x-badge>
                                                    @elseif ($pembayaran->status_pembayaran == 'ditolak')
                                                        <x-badge variant="danger">Ditolak</x-badge>
                                                    @else
                                                        <x-badge variant="warning">Tertunda</x-badge>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="px-4 py-10 text-center text-stone-500">
                                                <i class="bx bx-info-circle text-2xl"></i>
                                                <p class="mt-1">Belum ada riwayat pembayaran</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 rounded-xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
                        <h4 class="mb-1.5 font-semibold"><i class="bx bx-info-circle"></i> Status Pembayaran</h4>
                        <ul class="list-disc space-y-1 pl-5">
                            <li><strong>Tertunda:</strong> Pembayaran sedang menunggu verifikasi</li>
                            <li><strong>Diterima:</strong> Pembayaran telah diverifikasi dan diterima</li>
                            <li><strong>Ditolak:</strong> Pembayaran tidak memenuhi kriteria</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function showJemaahInfo() {
            alert('Data jemaah dapat diisi setelah status pemesanan Dikonfirmasi.\nHarap menunggu konfirmasi dari admin atau menghubungi admin untuk bantuan lebih lanjut.');
        }
    </script>
@endsection
