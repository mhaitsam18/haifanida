@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pembayaran/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($pemesanan)
                <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari pembayaran...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jumlah Pembayaran</th>
                    <th class="px-4 py-3">Metode Pembayaran</th>
                    <th class="px-4 py-3">Tanggal Pembayaran</th>
                    <th class="px-4 py-3">Bukti Pembayaran</th>
                    <th class="px-4 py-3">Status Pembayaran</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pembayarans as $pembayaran)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $pembayaran->metode_pembayaran }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-maroon-700 hover:underline">Lihat Bukti</a>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :variant="$pembayaran->status_pembayaran == 'diterima' ? 'success' : ($pembayaran->status_pembayaran == 'ditolak' ? 'danger' : 'warning')">{{ $pembayaran->status_pembayaran }}</x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                @if ($pembayaran->status_pembayaran === 'tertunda')
                                    <form action="{{ route('admin.pembayaran.verify', $pembayaran->id) }}" method="post" x-data
                                        @submit.prevent="if (confirm('Verifikasi pembayaran ini?')) $el.submit()">
                                        @csrf
                                        <button type="submit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Verifikasi</button>
                                    </form>
                                    <form action="{{ route('admin.pembayaran.reject', $pembayaran->id) }}" method="post" x-data
                                        @submit.prevent="if (confirm('Tolak pembayaran ini?')) $el.submit()">
                                        @csrf
                                        <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100">Tolak</button>
                                    </form>
                                @endif
                                <a href="/admin/pembayaran/{{ $pembayaran->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <a href="/admin/pembayaran/{{ $pembayaran->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/pembayaran/' . $pembayaran->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
