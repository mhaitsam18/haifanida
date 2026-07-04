@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/berkas/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari berkas...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Berkas</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($berkass as $berkas)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $berkas->nama_berkas }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/berkas/{{ $berkas->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/berkas/' . $berkas->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
