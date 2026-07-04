@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/jemaah/' . $jemaah->id . '/bus/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari penumpang...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Penumpang</th>
                    <th class="px-4 py-3">Nomor Kursi</th>
                    <th class="px-4 py-3">Nomor Rombongan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($busJemaahs as $penumpang)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penumpang->jemaah->nama_lengkap }}</td>
                        <td class="px-4 py-3">{{ $penumpang->nomor_kursi }}</td>
                        <td class="px-4 py-3">{{ $penumpang->bus->nomor_rombongan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/bus/{{ $penumpang->bus_id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">List Penumpang</a>
                                <a href="/admin/bus-jemaah/{{ $penumpang->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/bus-jemaah/' . $penumpang->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
