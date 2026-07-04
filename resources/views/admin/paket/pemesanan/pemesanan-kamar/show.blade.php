@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($pemesananKamar ? 'pemesanan-kamar/' . $pemesananKamar->id . '/' : '') . 'permintaan-kamar/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($pemesananKamar)
                <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesananKamar->pemesanan_id . '/pemesanan-kamar'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <ul class="grid gap-1.5 text-sm text-stone-700 sm:grid-cols-2">
            <li><span class="text-stone-500">Tipe Kamar:</span> {{ $pemesananKamar->tipe_kamar }}</li>
            <li><span class="text-stone-500">Jumlah Pengisi:</span> {{ $pemesananKamar->jumlah_pengisi }}</li>
            <li><span class="text-stone-500">Harga:</span> Rp.{{ number_format($pemesananKamar->harga, 2, ',', '.') }}</li>
            <li><span class="text-stone-500">Keterangan:</span> {{ $pemesananKamar->keterangan ?? '-' }}</li>
        </ul>
    </x-card>

    <x-data-table searchPlaceholder="Cari permintaan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Permintaan</th>
                    <th class="px-4 py-3">Tambahan Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @forelse ($pemesananKamar->permintaans as $permintaan)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $permintaan->permintaan }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($permintaan->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $permintaan->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/permintaan-kamar/{{ $permintaan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/permintaan-kamar/' . $permintaan->id" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-stone-500">Permintaan kamar belum tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-data-table>
@endsection
