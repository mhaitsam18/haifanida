@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pemesanan-ekstra/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($pemesanan)
                <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari pemesanan ekstra...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Ekstra / Tambahan</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesananEkstras as $ekstra)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $ekstra->ekstra }}</td>
                        <td class="px-4 py-3">{{ $ekstra->jumlah }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $ekstra->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/pemesanan-ekstra/' . $ekstra->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
