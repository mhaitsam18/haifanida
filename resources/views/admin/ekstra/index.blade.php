@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/ekstra/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari ekstra...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Ekstra</th>
                    <th class="px-4 py-3">Harga Bawaan</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($ekstras as $ekstra)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $ekstra->nama_ekstra }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $ekstra->jenis_ekstra }}</x-badge></td>
                        <td class="px-4 py-3 text-stone-500">{{ $ekstra->deskripsi }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/ekstra/{{ $ekstra->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/ekstra/' . $ekstra->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
