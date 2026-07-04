@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/jemaah/' . $jemaah->id . '/kamar/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Kamar</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Kota</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kamarJemaahs as $tamu)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $tamu->kamar->nomor_kamar }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->kapasitas }}</td>
                        <td class="px-4 py-3">{{ $tamu->kamar->paketHotel->hotel->kota }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/kamar/{{ $tamu->kamar_id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Anggota Kamar</a>
                                <a href="/admin/kamar-jemaah/{{ $tamu->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/kamar-jemaah/' . $tamu->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
