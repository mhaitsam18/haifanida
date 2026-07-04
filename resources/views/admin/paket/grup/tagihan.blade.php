@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title" />

    <x-card>
        <div class="flex flex-wrap justify-between gap-8">
            <div>
                <img src="/assets/img/logos/logo.png" alt="Logo" class="h-20">
                <p class="mt-3 font-semibold text-stone-800">PT. Haifa Nida Wisata Karawang</p>
                <p class="mt-1 text-sm text-stone-500">Jl. RA. Kartini, No.1,<br>Kel. Karangpawitan, Kec. Karawang Barat.<br>Kab. Karawang, Jawa Barat</p>
                <h5 class="mt-6 text-sm font-semibold uppercase tracking-wide text-stone-400">Tagihan Untuk :</h5>
                <p class="mt-1 text-sm text-stone-700">
                    Sdr/i, {{ $pemesanan->user->name }}<br>
                    {{ $pemesanan->user->member->alamat ?? null }}
                </p>
            </div>
            <div class="text-right">
                <h4 class="font-display text-xl font-bold uppercase text-maroon-900">Faktur</h4>
                <p class="mt-1 text-sm text-stone-500"># INV-{{ $pemesanan->id }}</p>
                <p class="mt-6 text-sm text-stone-500">Total Tagihan</p>
                <p class="font-display text-2xl font-semibold text-maroon-800">Rp.{{ number_format($balance, 2, ',', '.') }}</p>
                <p class="mt-3 text-sm text-stone-500">Tanggal Faktur: <span class="text-stone-800">{{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</span></p>
                <p class="text-sm text-stone-500">Tanggal Jatuh Tempo: <span class="text-stone-800">{{ Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') }}</span></p>
            </div>
        </div>

        <div class="mt-8 overflow-x-auto rounded-xl border border-cream-200">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 text-right">Jumlah</th>
                        <th class="px-4 py-3 text-right">Biaya Satuan</th>
                        <th class="px-4 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @php $total = 0; @endphp
                    @foreach ($tagihans as $tagihan)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $tagihan['deskripsi'] }}</td>
                            <td class="px-4 py-3 text-right">{{ $tagihan['jumlah'] . ' ' . $tagihan['satuan'] }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($tagihan['biaya_satuan'], 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">Rp.{{ number_format($tagihan['total'], 2, ',', '.') }}</td>
                        </tr>
                        @php $total += $tagihan['total']; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <div class="w-full md:w-1/2">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-cream-200">
                        <tr>
                            <td class="py-2 text-stone-600">Sub Total</td>
                            <td class="py-2 text-right text-stone-800">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-stone-600">TAX (11%)</td>
                            @php $tax = ($total * 11) / 100; @endphp
                            <td class="py-2 text-right text-stone-800">Rp.{{ number_format($tax, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold text-stone-800">Total</td>
                            @php $total += $tax; @endphp
                            <td class="py-2 text-right font-semibold text-stone-800">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-stone-600">Pembayaran dilakukan</td>
                            <td class="py-2 text-right text-red-600">(-) Rp.{{ number_format($pembayaran, 2, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-cream-100">
                            <td class="px-2 py-2.5 font-semibold text-maroon-900">Balance / Sisa Tagihan yang harus dibayarkan</td>
                            @php $total -= $pembayaran; @endphp
                            <td class="px-2 py-2.5 text-right font-semibold text-maroon-900">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap justify-end gap-2">
            <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            <x-button variant="outline"><i class="bx bx-printer"></i> Cetak</x-button>
            <x-button><i class="bx bx-send"></i> Kirim Tagihan</x-button>
        </div>
    </x-card>
@endsection
