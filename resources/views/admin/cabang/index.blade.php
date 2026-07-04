@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/cabang/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari cabang...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Cabang</th>
                    <th class="px-4 py-3">Perwakilan Induk</th>
                    <th class="px-4 py-3">Nama Ketua</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Surat Izin</th>
                    <th class="px-4 py-3">Kabupaten / Kota</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($cabangs as $cabang)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $cabang->nama_kantor }}</td>
                        <td class="px-4 py-3">{{ $cabang->indukKantor->nama_kantor ?? 'Pusat' }}</td>
                        <td class="px-4 py-3">{{ $cabang->nama_ketua }}</td>
                        <td class="px-4 py-3">{{ $cabang->kontak_kantor }}</td>
                        <td class="px-4 py-3">{{ $cabang->surat_izin ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $cabang->kabupaten->kabupaten ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/cabang/{{ $cabang->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/cabang/' . $cabang->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
