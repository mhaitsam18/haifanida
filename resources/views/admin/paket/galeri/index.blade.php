@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/paket/' . $paket->id . '/galeri/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari galeri...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($galeries as $galeri)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $galeri->jenis }}</x-badge></td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $galeri->nama }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $galeri->deskripsi }}</td>
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $galeri->file_path) }}" alt="{{ $galeri->nama }}" class="h-16 w-24 rounded-lg object-cover"></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/galeri/{{ $galeri->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/galeri/' . $galeri->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
