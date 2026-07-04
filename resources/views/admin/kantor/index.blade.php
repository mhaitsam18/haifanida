@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/kantor/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari kantor...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Nama Kantor</th>
                    <th class="px-4 py-3">Nama Ketua</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Provinsi</th>
                    <th class="px-4 py-3">Kabupaten</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kantors as $kantor)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ ucfirst($kantor->jenis_kantor) }}</x-badge></td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kantor->nama_kantor }}</td>
                        <td class="px-4 py-3">{{ $kantor->nama_ketua }}</td>
                        <td class="px-4 py-3">{{ $kantor->kontak_kantor }}</td>
                        <td class="px-4 py-3">{{ $kantor->kabupaten->provinsi->provinsi ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $kantor->kabupaten->kabupaten ?? '-' }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $kantor->alamat_kantor }}</td>
                        <td class="px-4 py-3">
                            @if ($kantor->foto_kantor)
                                <img src="{{ asset('storage/' . $kantor->foto_kantor) }}" alt="Foto Kantor" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/kantor/{{ $kantor->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/kantor/' . $kantor->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
