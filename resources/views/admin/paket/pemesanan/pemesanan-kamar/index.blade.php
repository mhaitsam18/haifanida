@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pemesanan-kamar/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($pemesanan)
                <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari pemesanan kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Jumlah Pengisi</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesananKamars as $kamar)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->jumlah_pengisi }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($kamar->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $kamar->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/pemesanan-kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Permintaan</a>
                                <a href="/admin/pemesanan-kamar/{{ $kamar->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/pemesanan-kamar/' . $kamar->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
